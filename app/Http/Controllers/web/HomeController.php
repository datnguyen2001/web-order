<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\EcommercePlatformModel;
use App\Models\PostModel;
use App\Models\SettingModel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $banner = BannerModel::where('display',1)->get();
        $eCommerce = EcommercePlatformModel::where('display',1)->get();
        return view('web.home.index',compact('banner','eCommerce'));
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
    public function order()
    {
        return view('web.profile.order');
    }
    public function wallet()
    {
        return view('web.wallet.index');
    }
    public function about()
    {
        $data = SettingModel::first();
        return view('web.about.index',compact('data'));
    }
    public function post($slug)
    {
        $data = PostModel::where('slug',$slug)->first();
        return view('web.post.index',compact('data'));
    }
}
