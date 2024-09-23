<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\Cart;
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
        return view('web.pay.index',compact('address','province','listAddress', 'selectedProducts'));
    }

    public function Payment()
    {
        return view('web.pay.payment');
    }
}
