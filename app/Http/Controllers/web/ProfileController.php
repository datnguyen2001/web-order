<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\User;
use App\Models\WalletHistoriesModel;
use App\Models\WalletsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $data = Auth::user();

        return view('web.profile.index',compact('data'));
    }

    public function saveProfile(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->full_name=$request->get('full_name');
        $user->date_of_birth=$request->get('date_of_birth');
        $user->gender=$request->get('gender');
        $user->save();
        toastr()->success('Cập nhật thông tin thành công');

        return redirect()->route('profile');
    }
    public function changeAvatar(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $file = $request->file('avatar');
        $imagePath = Storage::url($file->store('user', 'public'));
        $user->avatar=$imagePath;
        $user->save();

        return response()->json(['success'=>true,'msg'=>'Ảnh đại diện đã được cập nhật']);
    }

    public function order()
    {
        return view('web.profile.order');
    }

    public function getOrder(Request $request,$status){
        try{
            $query = OrderModel::query();
            if ($status != 'all'){
                $query = $query->where('status_id',$status);
            }

            if ($request->has('order_code') && !empty($request->order_code)) {
                $query->where('order_code', 'like', '%' . $request->order_code . '%');
            }

            if ($request->has('order_date') && !empty($request->order_date)) {
                $query->whereDate('created_at', $request->order_date);
            }
            $listData = $query->where('user_id',Auth::id())->with('orderItems')->orderBy('created_at','desc')->get();

            return response()->json(['message'=>'Lấy thông tin thành công','data'=>$listData,'status'=>true]);
        }catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage(),'status'=>false]);
        }
    }

    public function cancelOrder($order_code){
        try{
            $data = OrderModel::where('order_code',$order_code)->first();
            $data->status_id = 9;
            $data->save();
            toastr()->success('Hủy đơn hàng thành công');
            return back();
        }catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function detailOrder($id)
    {
        $data = OrderModel::with(['orderItems', 'shippingAddress','shippingAddress.province','shippingAddress.district','shippingAddress.ward'])->where('id', $id)->first();
        $data->statusName = self::getStatusNames()[$data->status_id] ?? 'Đang cập nhật';
        $loopIndex = 1;
        $groupedItems = $data->orderItems->groupBy('product_name')->map(function ($items) use (&$loopIndex) {
            $quantity = $items->sum('quantity');
            $price_chinese = $items->sum('total_chinese_price');
            $price_vietnamese = $items->sum('total_vietnamese_price');

            $attributes = $items->map(function ($item) {
                return [
                    'quantity' => $item->quantity,
                    'attribute_name' => $item->product_attribute,
                    'value_name' => $item->product_value,
                    'price_chinese' => $item->chinese_price,
                    'price_vietnamese' => $item->vietnamese_price,
                    'total_chinese_price'=>$item->total_chinese_price,
                    'total_vietnamese_price'=>$item->total_vietnamese_price,
                    'image' => $item['product_value_image']
                ];
            });

            return [
                'index' => $loopIndex++,
                'quantity' => $quantity,
                'product_name' => $items[0]->product_name,
                'attributes' => $attributes,
                'price_chinese' => $price_chinese,
                'price_vietnamese' => $price_vietnamese,
                'image' => $items[0]->product_image
            ];
        });

        return view('web.profile.detail-order',compact('data','groupedItems'));
    }

    public static function getStatusNames()
    {
        return [
            1 => 'Đã ký gửi',
            2 => 'Chờ duyệt',
            3 => 'Người bán giao',
            4 => 'Hàng về kho trung quốc',
            5 => 'Vận chuyển quốc tế',
            6 => 'Chờ giao',
            7 => 'Đang giao',
            8 => 'Đã nhận hàng',
            9 => 'Đã hủy',
            10 => 'Thất lạc',
            11 => 'Không nhận hàng',
        ];
    }

    public function wallet(Request $request,$name)
    {
        $transactionCode = $request->input('transaction_code');
        if ($name == 'vi'){
            $walletType = 1;
        }else{
            $walletType = 2;
        }
        $user = Auth::user();
        $wallet = WalletsModel::where('user_id',$user->id)->first();
        $query = WalletHistoriesModel::where('user_id', $user->id)
            ->where('wallet_type', $walletType);
        if ($transactionCode) {
            $query->where('transaction_code', 'like', '%' . $transactionCode . '%');
        }

        if ($request->filled('date_range')) {
            $dates = explode(' - ', $request->input('date_range'));
            $start_date = $dates[0];
            $end_date = $dates[1];
            $query->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date);
        }

        $listData = $query->orderBy('created_at', 'desc')->paginate(30);

        return view('web.wallet.index',compact('wallet','listData','user','walletType','name'));
    }
}
