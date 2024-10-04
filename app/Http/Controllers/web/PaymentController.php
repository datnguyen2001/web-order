<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\Cart;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProvinceModel;
use App\Models\SettingModel;
use App\Models\User;
use App\Models\WalletsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index(Request $request,$status)
    {
        $titlePage = 'Quản lý đơn hàng';
        $page_menu = 'order';
        $page_sub = 'order';
        $listData = OrderModel::query()
            ->join('address', 'orders.address_id', '=', 'address.id')
            ->join('province', 'address.province_id', '=', 'province.province_id')
            ->join('district', 'address.district_id', '=', 'district.district_id')
            ->join('wards', 'address.ward_id', '=', 'wards.wards_id')
            ->select(
                'orders.*',
                'address.name',
                'address.phone',
                'address.detail_address',
                'province.name as province_name',
                'district.name as district_name',
                'wards.name as ward_name'
            );

        $key_search = $request->get('search');
        if ($status !== 'all') {
            $listData = $listData->where('orders.status_id', $status);
        }
        if (isset($key_search)) {
            $listData = $listData->where('order_code', 'LIKE', '%' . $key_search . '%');
        }
        $listData = $listData->orderBy('created_at', 'desc')->paginate(10);
        foreach ($listData as $item){
            $item->name_status = $this->nameStatus($item->status_id);
        }

        return view('admin.order.index',compact('listData','titlePage','page_menu','page_sub','status'));
    }

    public function nameStatus($status_id){
        $statusNames = [
            '0' => 'Chờ Xác nhận thanh toán',
            '1' => 'Đã ký gửi',
            '2' => 'Chờ duyệt',
            '3' => 'Người bán giao',
            '4' => 'Hàng về kho trung quốc',
            '5' => 'Vận chuyển quốc tế',
            '6' => 'Chờ giao',
            '7' => 'Đang giao',
            '8' => 'Đã nhận hàng',
            '9' => 'Đã hủy',
            '10' => 'Thất lạc',
            '11' => 'Không nhận hàng',
        ];

        return isset($statusNames[$status_id]) ? $statusNames[$status_id] : 'Không xác định';

    }

    public function cart()
    {
        $province = ProvinceModel::all();

        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        //Delete Order with type = null when access to cart page
        $orders = OrderModel::where('user_id', Auth::id())
            ->whereNull('payment_type')
            ->get();
        $orderIds = $orders->pluck('id');
        OrderItemModel::whereIn('order_id', $orderIds)->delete();
        OrderModel::whereIn('id', $orderIds)->delete();

        return view('web.cart.index',compact('province', 'cartItems'));
    }

    public function confirmApplication()
    {
        $address = AddressModel::with(['province', 'district', 'ward'])
            ->where('user_id', Auth::id())
            ->where('is_default', 1)
            ->first();

        $listAddress = AddressModel::with(['province', 'district', 'ward'])
            ->where('user_id', Auth::id())
            ->get();

        $province = ProvinceModel::all();

        $selectedProducts = Cart::where('user_id', Auth::id())
            ->where('is_buying_selected', true)
            ->get();

        //Delete Order with type = null when access to confirm payment page
        $orders = OrderModel::where('user_id', Auth::id())
            ->whereNull('payment_type')
            ->get();
        $orderIds = $orders->pluck('id');
        OrderItemModel::whereIn('order_id', $orderIds)->delete();
        OrderModel::whereIn('id', $orderIds)->delete();

        return view('web.pay.index',compact('address','province','listAddress', 'selectedProducts'));
    }

    public function Payment()
    {
        $userID = Auth::id();

        $payments = OrderModel::where('user_id', $userID)
            ->where('payment_type', null)
            ->leftJoin('order_items', function ($join) {
                $join->on('orders.id', '=', 'order_items.order_id')
                    ->whereRaw('order_items.id = (SELECT MIN(id) FROM order_items WHERE order_items.order_id = orders.id)');
            })
            ->leftJoin(DB::raw('(SELECT order_id, SUM(quantity) as total_quantity FROM order_items GROUP BY order_id) as oi'), 'orders.id', '=', 'oi.order_id')
            ->select(
                'orders.id',
                'orders.order_code',
                'orders.total_payment_vietnamese',
                'orders.total_payment_chinese',
                'orders.deposit_money',
                'orders.payment_currency',
                'order_items.product_image',
                'oi.total_quantity'
            )
            ->groupBy(
                'orders.id',
                'orders.order_code',
                'orders.total_payment_vietnamese',
                'orders.total_payment_chinese',
                'orders.deposit_money',
                'orders.payment_currency',
                'oi.total_quantity',
                'order_items.product_image'
            )
            ->get();

        $payments->each(function ($payment) {
            $payment->product_names = OrderItemModel::where('order_id', $payment->id)
                ->pluck('product_name')->toArray();
        });

        $currentWalletMoney = WalletsModel::where('user_id', $userID)->first();

        return view('web.pay.payment', compact('payments', 'currentWalletMoney'));
    }

    public function createOrder(Request $request)
    {
        $userID = Auth::id();
        $datePart = date('dmy');
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomPart = '';
        for ($i = 0; $i < 6; $i++) {
            $randomPart .= $characters[rand(0, strlen($characters) - 1)];
        }
        $orderCode = $datePart . '_' . $randomPart;
        $setting = SettingModel::first();
        $paymentCurrency = $request->input('payment_currency');
        $depositMoney = $request->input('deposit_money');
        if($paymentCurrency === '1'){
            $depositMoney = $depositMoney * $setting->exchange_rate;
        }

        try {
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userID,
                'order_code' => $orderCode,
                'address_id' => $request->input('address_id'),
                'note' => $request->input('note'),
                'goods_money_chinese' => $request->input('goods_money_chinese'),
                'goods_money_vietnamese' => $request->input('goods_money_vietnamese'),
                'china_domestic_shipping_fee_chinese' => $request->input('china_domestic_shipping_fee_chinese'),
                'china_domestic_shipping_fee_vietnamese' => $request->input('china_domestic_shipping_fee_vietnamese'),
                'discount_chinese' => $request->input('discount_chinese'),
                'discount_vietnamese' => $request->input('discount_vietnamese'),
                'international_shipping_fee_chinese' => $request->input('international_shipping_fee_chinese'),
                'international_shipping_fee_vietnamese' => $request->input('international_shipping_fee_vietnamese'),
                'vietnam_domestic_shipping_fee_chinese' => $request->input('vietnam_domestic_shipping_fee_chinese'),
                'vietnam_domestic_shipping_fee_vietnamese' => $request->input('vietnam_domestic_shipping_fee_vietnamese'),
                'insurance_fee_chinese' => $request->input('insurance_fee_chinese'),
                'insurance_fee_vietnamese' => $request->input('insurance_fee_vietnamese'),
                'partial_payment_fee_chinese' => $request->input('partial_payment_fee_chinese'),
                'partial_payment_fee_vietnamese' => $request->input('partial_payment_fee_vietnamese'),
                'tally_fee_chinese' => $request->input('tally_fee_chinese'),
                'tally_fee_vietnamese' => $request->input('tally_fee_vietnamese'),
                'total_payment_chinese' => $request->input('total_payment_chinese'),
                'total_payment_vietnamese' => $request->input('total_payment_vietnamese'),
                'payment_currency' => $paymentCurrency,
                'deposit' => $request->input('deposit'),
                'deposit_money' => $depositMoney,
                'payment_type' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $selectedProducts = json_decode($request->input('selected_product'), true);

            foreach ($selectedProducts as $product) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_name' => $product['product_name'],
                    'product_value' => $product['product_value'],
                    'product_attribute' => $product['product_attribute'],
                    'quantity' => $product['quantity'],
                    'product_image' => $product['product_image'],
                    'product_value_image' => $product['product_value_image'],
                    'chinese_price' => $product['chinese_price'],
                    'vietnamese_price' => $product['vietnamese_price'],
                    'total_chinese_price' => $product['chinese_price'] * $product['quantity'],
                    'total_vietnamese_price' => $product['vietnamese_price'] * $product['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->route('pay')->with(['success' => 'Tạo thành công, vui lòng tiếp tục']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Có lỗi xảy ra, vui lòng thử lại']);
        }
    }

    public function updateDoneBankTransfer(Request $request)
    {
        $productNames = $request->input('product_names');
        $orderID = $request->input('order_id');
        $order = OrderModel::where('id', $orderID)->first();
        if ($order) {
            $order->payment_type = 2; //payment_type = 2 (thanh toan CK)
            $order->status_id = 0;
            $order->save();
        }

        if (!empty($productNames)) {
            $decodedProductNames = [];
            foreach ($productNames as $productNameJson) {
                $decodedProductNames = array_merge($decodedProductNames, json_decode($productNameJson, true));
            }
            Cart::whereIn('product_name', $decodedProductNames)->delete();
        }

        return response()->json(['status' => 'success', 'message' => 'Cart items deleted successfully.']);
    }

    public function statusOrder($order_id, $status_id)
    {
        try {
            $order = OrderModel::find($order_id);
            if ($order) {
                if ($status_id == 2){
                    $address = AddressModel::with('province', 'district', 'ward')->find($order->address_id);
                    $user = User::find($order->user_id);
                    $order_item = OrderItemModel::where('order_id',$order->id)->get();
                    $data = $this->createOrderAPI($order,$address,$user,$order_item);
                    if($data){
                        $order->status_id = $status_id;
                        $order->save();
                        toastr()->success('Xác nhận đơn hàng thành công');
                    }else{
                        toastr()->error('Xác nhận đơn hàng thất bại');
                    }
                }else{
                    toastr()->success('Hủy đơn hàng thành công');
                }

                return \redirect()->route('admin.order.index');
            }
        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    public function statusOrderWallet($order_id, $status_id)
    {
        try {
            $order = OrderModel::find($order_id);
            if ($order) {
                $address = AddressModel::with('province', 'district', 'ward')->find($order->address_id);
                $user = User::find($order->user_id);
                $order_item = OrderItemModel::where('order_id',$order->id)->get();
                $data = $this->createOrderAPI($order,$address,$user,$order_item);

                if($data){
                    $order->status_id = $status_id;
                    $order->save();
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Order status updated and processed successfully.',
                    'data' => $data
                ], 200);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while updating the order status.',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function updateDoneWalletTransfer(Request $request)
    {
        try {
            $orderID = $request->input('order_id');
            $order = OrderModel::where('id', $orderID)->first();
            if ($order) {
                $order->payment_type = 1; //payment_type = 1 (thanh toan vi)
                $order->status_id = 2;
                $order->save();
            }

            $paymentCurrency = $request->input('payment_currency');
            if ($paymentCurrency === '1'){
                $totalPaymentDepositVN = $request->input('total_payment_deposit_vn');
                $currentWalletMoney = WalletsModel::where('user_id', Auth::id())->first();
                $walletBalanceVN = $currentWalletMoney->vietnamese_money - $totalPaymentDepositVN;

                $currentWalletMoney->vietnamese_money = $walletBalanceVN;
                $currentWalletMoney->save();
            }else if($paymentCurrency === '2'){
                $totalPaymentDepositCN = $request->input('total_payment_deposit_cn');
                $currentWalletMoney = WalletsModel::where('user_id', Auth::id())->first();
                $walletBalanceCN = $currentWalletMoney->middle_money - $totalPaymentDepositCN;

                $currentWalletMoney->middle_money = $walletBalanceCN;
                $currentWalletMoney->save();
            }

            // Handle product names and delete from the cart
            $productNames = $request->input('product_names');
            if (!empty($productNames)) {
                $decodedProductNames = [];
                foreach ($productNames as $productNameJson) {
                    $decodedProductNames = array_merge($decodedProductNames, json_decode($productNameJson, true));
                }

                if (!empty($decodedProductNames)) {
                    Cart::whereIn('product_name', $decodedProductNames)->delete();
                }
            }

            return response()->json(['status' => 'success', 'message' => 'Thanh toán thành công.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Có lỗi xảy ra, vui lòng thử lại.'], 500);
        }
    }

    public function createOrderAPI($order,$address,$user,$order_items)
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImtpZCI6IjcwRHdFdWxrOU5oQTJkSGNZQUJSVGJFV1AyYURneXpKaV9tekdYV1U1WXcifQ.eyJpc3MiOiJodHRwczovL29pZGMtdm5zLmdvYml6ZGV2LmNvbSIsImF1ZCI6InRlc3QiLCJqdGkiOiI3YzJlYTM1ZC0zMzUyLTQ2NTUtODU5Ni00ZDMxYmE0NGQxNzUiLCJpYXQiOjE3MDE4MzM0NDEsImV4cCI6MTg1OTUxMzQ0MSwiYWdlbmN5X2lkIjozLCJhZ2VuY3lfY29kZSI6Im5oYXBoYW5nIiwicGFydG5lcl9pZCI6MSwicGFydG5lcl9jb2RlIjoieGxvZ2lzdGljcyIsInNjb3BlIjoiY3JlYXRvcjo1MCIsInN1YiI6IjUwIn0.qp_GoegjY8HNIlZgt8jHRoNhlV0onxc9GY7pHOBMO-Ckgoqzmy17znMlJo_BItQygZCqY9QeHzDGdUYfVEcMG0R4ujHmB67gJ7IHp06ujy0hw_Hve2viBkeqXoFlinxFKXfoT5_JhKJHWuplHrQrOhD570VyNgwwQD8cTJJSf2lF0vT8ZB0SuX4m-yCQ5RBZvDhF7FWTg7rrhChsisQ0FhdjKfxuOudj1u2GKe6w3sL6-uMKShpFZesH3gaG5XovMUUaX9JR3ZAKZyGJCJ6b019551vFdhJhk_ptF47nyxU3xvY5LLNvujFchXfXgCjQKXDCKd8LjEfL-vnO1GYpXA';

        $items = [];
        foreach ($order_items as $item) {
            $items[] = [
                "brands" => [
                    "original" => "Thay đổi",
                    "translate" => "Thay đổi"
                ],
                "code_item" => $item->product_name ?? "Không có",
                "customer_note" => $order->note ?? "Không có",
                "manifest_original_name" => $item->product_name ?? "Không có",
                "manifest_translated_name" => $item->product_name ?? "Không có",
                "materials" => [
                    "original" => "Thay đổi",
                    "translate" => "Thay đổi"
                ],
                "merchant_code" => "ILVietNam",
                "merchant_contact" => "0123456789",
                "merchant_name" => "Donny",
                "order_quantity" => $item->quantity ?? 1,
                "original_name" => $item->product_name ?? "Không có",
                "product_image" => $item->product_image ?? "Không có",
                "purchase_quantity" => $item->quantity ?? 1,
                "received_quantity" => $item->quantity ?? 1,
                "sku" => $item->product_name ?? "Không có",
                "staff_note" => "Không có",
                "total_amount" => $item->total_vietnamese_price ?? 100000,
                "translated_name" => $item->product_name ?? "Không có",
                "unit" => "chiếc",
                "unit_price" => $item->vietnamese_price,
                "unit_price_origin" => $item->vietnamese_price,
                "url" => $item->url ?? "http://google.com",
                "variant_properties" => [
                    [
                        "id" => $item->id,
                        "name" => $item->product_value,
                        "originalName" => $item->product_value,
                        "originalValue" => $item->product_attribute,
                        "value" => $item->product_attribute
                    ]
                ]
            ];
        }

        $data = [
            "code" => $order->order_code,
            "customer_name" => $user->full_name,
            "customer_phone" => $user->phone,
            "customer_username" => $user->full_name,
            "destination_warehouse_code" => 'CNGZ',
            "distribute_warehouse_code" => 'CNGZ',
            "items" => $items,
            "properties" => [4, 3],
            "receiver_address" => $address->detail_address.', '.$address->ward->name.', '.$address->district->name.', '.$address->province->name,
            "receiver_city_code" => $address->province_id,
            "receiver_country_code" => 'vietnam',
            "receiver_district_code" => $address->district_id,
            "receiver_name" => $address->name,
            "receiver_note" => $order->note,
            "receiver_phone" => $address->phone,
            "receiver_ward_code" => $address->ward_id,
            "services" => [1, 2],
            "tracking_numbers" => ['aloha0412', 'aloha1407']
        ];
        $response = Http::withToken($token)->post('https://m6-agency-api.vns.gobizdev.com/orders', $data);

        if ($response->successful()) {
            return true;
        } else {
            return false;
        }
    }

}
