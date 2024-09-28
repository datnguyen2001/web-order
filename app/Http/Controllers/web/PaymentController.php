<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\Cart;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProvinceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('web.pay.payment', compact('payments'));
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

    public function index(Request $request)
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
            )
            ->where('orders.status_id', 0);

        $key_search = $request->get('search');
        if (isset($key_search)) {
            $listData = $listData->where('order_code', 'LIKE', '%' . $key_search . '%');
        }
        $listData = $listData->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.order.index',compact('listData','titlePage','page_menu','page_sub'));
    }

    public function statusOrder($order_id, $status_id)
    {
        try {
            $order = OrderModel::find($order_id);
            if ($order) {
                $order->status_id = $status_id;
                $order->save();
                if ($status_id == 2){
                    toastr()->success('Xác nhận đơn hàng thành công');
                }else{
                    toastr()->success('Hủy đơn hàng thành công');
                }

                return \redirect()->route('admin.order.index');
            }
        } catch (\Exception $exception) {
            dd($exception);
        }
    }

}
