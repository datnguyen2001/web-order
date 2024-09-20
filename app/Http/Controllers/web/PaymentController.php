<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\ProvinceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function cart()
    {
        $province = ProvinceModel::all();

        return view('web.cart.index',compact('province'));
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

        return view('web.pay.index',compact('address','province','listAddress'));
    }

    public function Payment()
    {
        return view('web.pay.payment');
    }
}
