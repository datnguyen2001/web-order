<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\EcommercePlatformModel;
use App\Models\ProductImageTaobaoModel;
use App\Models\ProductTaobaoModel;
use App\Models\WalletsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaobaoHomeController extends Controller
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

        $products = ProductTaobaoModel::whereHas('productValues.productAttributes')
            ->with(['productValues.productAttributes'])
            ->get()
            ->sortBy(function ($product) {
                $minPrice = $product->productValues->flatMap(function ($productValue) {
                    return $productValue->productAttributes->pluck('price');
                })->min();
                return $minPrice;
            });

        $hotDealProducts = $products->shuffle()->take(12);

        $hotDealProducts->transform(function ($product) {
            $product->src = ProductImageTaobaoModel::where('product_id', $product->id)->orderBy('id')->first()->src ?? null;
            $product->price = floatval($product->productValues->flatMap(function ($productValue) {
                return $productValue->productAttributes->pluck('price');
            })->min() ?? 0);
            return $product;
        });

        $randomProducts = ProductTaobaoModel::with(['productImages', 'productValues'])
            ->whereNotNull('price')
            ->inRandomOrder()
            ->paginate(24);

        foreach ($randomProducts as $product) {
            $product->src = optional($product->productImages->first())->src;

            $minPrice = $product->productValues->flatMap(function ($productValue) {
                return $productValue->productAttributes->pluck('price');
            })->min();

            $product->price = floatval($minPrice ?? $product->price);
        }

        return view('web.home_taobao.index',compact('banner','eCommerce','wallet','hotDealProducts','randomProducts'));
    }

    public function search()
    {
        return view('web.search_taobao.index');
    }

    public function dealHot()
    {
        $listData = ProductTaobaoModel::whereHas('productValues.productAttributes')
            ->with(['productValues.productAttributes'])
            ->leftJoin('product_values_taobaos', 'product_taobaos.id', '=', 'product_values_taobaos.product_id')
            ->leftJoin('product_attributes_taobaos', 'product_values_taobaos.id', '=', 'product_attributes_taobaos.product_value_id')
            ->select('product_taobaos.*')
            ->selectRaw('COALESCE(MIN(CAST(product_attributes_taobaos.price AS DECIMAL(10,2))), product_taobaos.price) as lowest_price')
            ->groupBy('product_taobaos.id')
            ->orderBy('lowest_price', 'asc')
            ->paginate(25);

        $listData->getCollection()->transform(function ($product) {
            $product->src = ProductImageTaobaoModel::where('product_id', $product->id)->first()->src ?? null;
            $product->price = floatval($product->lowest_price);
            return $product;
        });

        $nameCate = 'Deal Hot';

        return view('web.search_taobao.more',compact('listData','nameCate'));
    }

    public function recommendedYou()
    {
        $listData = ProductTaobaoModel::with(['productImages', 'productValues'])
            ->whereNotNull('price')
            ->inRandomOrder()
            ->paginate(25);

        foreach ($listData as $product) {
            $product->src = optional($product->productImages->first())->src;

            $minPrice = $product->productValues->flatMap(function ($productValue) {
                return $productValue->productAttributes->pluck('price');
            })->min();

            $product->price = floatval($minPrice ?? $product->price);
        }
        $nameCate = 'Đề xuất cho bạn';

        return view('web.search_taobao.more',compact('listData','nameCate'));
    }
}
