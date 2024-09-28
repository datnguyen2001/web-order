<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\Cart;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProvinceModel;
use App\Models\WalletsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
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
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $orderCode = '';
        for ($i = 0; $i < 9; $i++) {
            $orderCode .= $characters[rand(0, strlen($characters) - 1)];
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
                'payment_currency' => $request->input('payment_currency'),
                'deposit' => $request->input('deposit'),
                'deposit_money' => $request->input('deposit_money'),
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

        if (!empty($productNames)) {
            $decodedProductNames = [];
            foreach ($productNames as $productNameJson) {
                $decodedProductNames = array_merge($decodedProductNames, json_decode($productNameJson, true));
            }
            Cart::whereIn('product_name', $decodedProductNames)->delete();
        }

        return response()->json(['status' => 'success', 'message' => 'Cart items deleted successfully.']);
    }

    public function updateDoneWalletTransfer(Request $request)
    {
        $totalPayment = $request->input('total_payment');

        $currentWalletMoney = WalletsModel::where('user_id', Auth::id())->first();
        $walletBalance = $currentWalletMoney->vietnamese_money - $totalPayment;

        return response()->json(['status' => 'success', 'message' => 'Thanh toán thành công.']);
    }
    public function createOrderAPI(Request $request)
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImtpZCI6IjcwRHdFdWxrOU5oQTJkSGNZQUJSVGJFV1AyYURneXpKaV9tekdYV1U1WXcifQ.eyJpc3MiOiJodHRwczovL29pZGMtdm5zLmdvYml6ZGV2LmNvbSIsImF1ZCI6InRlc3QiLCJqdGkiOiI3YzJlYTM1ZC0zMzUyLTQ2NTUtODU5Ni00ZDMxYmE0NGQxNzUiLCJpYXQiOjE3MDE4MzM0NDEsImV4cCI6MTg1OTUxMzQ0MSwiYWdlbmN5X2lkIjozLCJhZ2VuY3lfY29kZSI6Im5oYXBoYW5nIiwicGFydG5lcl9pZCI6MSwicGFydG5lcl9jb2RlIjoieGxvZ2lzdGljcyIsInNjb3BlIjoiY3JlYXRvcjo1MCIsInN1YiI6IjUwIn0.qp_GoegjY8HNIlZgt8jHRoNhlV0onxc9GY7pHOBMO-Ckgoqzmy17znMlJo_BItQygZCqY9QeHzDGdUYfVEcMG0R4ujHmB67gJ7IHp06ujy0hw_Hve2viBkeqXoFlinxFKXfoT5_JhKJHWuplHrQrOhD570VyNgwwQD8cTJJSf2lF0vT8ZB0SuX4m-yCQ5RBZvDhF7FWTg7rrhChsisQ0FhdjKfxuOudj1u2GKe6w3sL6-uMKShpFZesH3gaG5XovMUUaX9JR3ZAKZyGJCJ6b019551vFdhJhk_ptF47nyxU3xvY5LLNvujFchXfXgCjQKXDCKd8LjEfL-vnO1GYpXA';

        $data = [
            "code" => $request->input('code', 'haiye123123'),
            "customer_name" => $request->input('customer_name', 'Son Trinh'),
            "customer_phone" => $request->input('customer_phone', '0900900800'),
            "customer_username" => $request->input('customer_username', 'alohauser12'),
            "destination_warehouse_code" => $request->input('destination_warehouse_code', 'CNGZ'),
            "distribute_warehouse_code" => $request->input('distribute_warehouse_code', 'CNGZ'),
            "items" => $request->input('items', [
                [
                    "brands" => [
                        "original" => "thay đổi",
                        "translate" => "thay đổi"
                    ],
                    "code_item" => "CODE1",
                    "customer_note" => "SP Test",
                    "manifest_original_name" => "SP Test",
                    "manifest_translated_name" => "SP Test",
                    "materials" => [
                        "original" => "thay đổi",
                        "translate" => "thay đổi"
                    ],
                    "merchant_code" => "SP Test",
                    "merchant_contact" => "SP Test",
                    "merchant_name" => "SP Test",
                    "order_quantity" => 1,
                    "original_name" => "SP Test",
                    "product_image" => "SP Test",
                    "purchase_quantity" => 1,
                    "received_quantity" => 1,
                    "sku" => "SP Test",
                    "staff_note" => "SP Test",
                    "total_amount" => 2000000,
                    "translated_name" => "SP Test",
                    "unit" => "chiếc",
                    "unit_price" => 100000,
                    "unit_price_origin" => 200,
                    "url" => "http://google.com",
                    "variant_properties" => [
                        [
                            "id" => "1627207:28320",
                            "name" => "Màu sắc",
                            "originalName" => "Màu sắc",
                            "originalValue" => "白色",
                            "value" => "白色"
                        ]
                    ]
                ],
                [
                    "brands" => [
                        "original" => "thay đổi",
                        "translate" => "thay đổi"
                    ],
                    "code_item" => "CODE2",
                    "customer_note" => "SP Test",
                    "manifest_original_name" => "SP Test",
                    "manifest_translated_name" => "SP Test",
                    "materials" => [
                        "original" => "thay đổi",
                        "translate" => "thay đổi"
                    ],
                    "merchant_code" => "SP Test",
                    "merchant_contact" => "SP Test",
                    "merchant_name" => "SP Test",
                    "order_quantity" => 5,
                    "original_name" => "SP Test 2",
                    "product_image" => "SP Test",
                    "purchase_quantity" => 6,
                    "received_quantity" => 3,
                    "sku" => "SP Test",
                    "staff_note" => "SP Test",
                    "total_amount" => 3000000,
                    "translated_name" => "SP Test",
                    "unit" => "chiếc",
                    "unit_price" => 150000,
                    "unit_price_origin" => 150,
                    "url" => "http://google.com",
                    "variant_properties" => [
                        [
                            "id" => "1627207:28320",
                            "name" => "Màu sắc",
                            "originalName" => "Màu sắc",
                            "originalValue" => "白色",
                            "value" => "白色"
                        ]
                    ]
                ]
            ]),
            "properties" => $request->input('properties', [4, 3]),
            "receiver_address" => $request->input('receiver_address', 'dia chi nhan hang'),
            "receiver_city_code" => $request->input('receiver_city_code', '48'),
            "receiver_country_code" => $request->input('receiver_country_code', 'vietnam'),
            "receiver_district_code" => $request->input('receiver_district_code', '491'),
            "receiver_name" => $request->input('receiver_name', 'Dong Vi'),
            "receiver_note" => $request->input('receiver_note', 'note nhe'),
            "receiver_phone" => $request->input('receiver_phone', '0988999000'),
            "receiver_ward_code" => $request->input('receiver_ward_code', '20203'),
            "services" => $request->input('services', [1, 2]),
            "tracking_numbers" => $request->input('tracking_numbers', ['aloha0412', 'aloha1407'])
        ];
        $response = Http::withToken($token)->post('https://m6-agency-api.vns.gobizdev.com/orders', $data);

        if ($response->successful()) {
            return response()->json(['message' => 'Tạo đơn hàng thành công', 'data' => $response->json()], 200);
        } else {
            return response()->json(['error' => 'Tạo đơn hàng thất bại, vui lòng thử lại', 'details' => $response->body()], $response->status());
        }
    }
}
