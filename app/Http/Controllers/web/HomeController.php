<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        return view('web.home.index');
    }

    public function category()
    {
        return view('web.category.index');
    }
    public function search()
    {
        return view('web.search.index');
    }
    public function more()
    {
        return view('web.search.more');
    }
    public function detailProduct()
    {
        return view('web.product.index');
    }

    public function cart()
    {
        return view('web.cart.index');
    }

    public function confirmApplication()
    {
        return view('web.pay.index');
    }
    public function Payment()
    {
        return view('web.pay.payment');
    }
    public function profile()
    {
        return view('web.profile.index');
    }

}
