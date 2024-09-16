<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
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
