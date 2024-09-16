<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\EcommercePlatformModel;
use App\Models\PostModel;
use App\Models\SettingModel;
use App\Models\WalletHistoriesModel;
use App\Models\WalletsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $banner = BannerModel::where('display',1)->get();
        $eCommerce = EcommercePlatformModel::where('display',1)->get();
        $user = Auth::user();
        $wallet = null;
        if ($user){
            $wallet = WalletsModel::where('user_id',$user->id)->first();
        }


        return view('web.home.index',compact('banner','eCommerce','wallet'));
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
