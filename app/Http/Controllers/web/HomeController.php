<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\Cart;
use App\Models\EcommercePlatformModel;
use App\Models\PostModel;
use App\Models\ProductImagesModel;
use App\Models\ProductImageTaobaoModel;
use App\Models\ProductModel;
use App\Models\ProductTaobaoModel;
use App\Models\SettingModel;
use App\Models\WalletsModel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function homeMain()
    {
        $banner = BannerModel::where('display',1)->get();
        $eCommerce = EcommercePlatformModel::where('display',1)->get();
        $user = Auth::user();
        $wallet = null;
        if ($user){
            $wallet = WalletsModel::where('user_id',$user->id)->first();
        }

        //Product 1688
        $products = ProductModel::whereHas('productValues.productAttributes')
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
            $product->src = ProductImagesModel::where('product_id', $product->id)->orderBy('id')->first()->src ?? null;
            $product->price = floatval($product->productValues->flatMap(function ($productValue) {
                return $productValue->productAttributes->pluck('price');
            })->min() ?? 0);
            return $product;
        });

        //Product TaoBao
        $productsTaobao = ProductTaobaoModel::whereHas('productValues.productAttributes')
            ->with(['productValues.productAttributes'])
            ->get()
            ->sortBy(function ($product) {
                $minPrice = $product->productValues->flatMap(function ($productValue) {
                    return $productValue->productAttributes->pluck('price');
                })->min();
                return $minPrice;
            });
        $hotDealProductsTaobao = $productsTaobao->shuffle()->take(12);
        $hotDealProductsTaobao->transform(function ($product) {
            $product->src = ProductImageTaobaoModel::where('product_id', $product->id)->orderBy('id')->first()->src ?? null;
            $product->price = floatval($product->productValues->flatMap(function ($productValue) {
                return $productValue->productAttributes->pluck('price');
            })->min() ?? 0);
            return $product;
        });
        $activeHeader = false;

        return view('web.home.index-main',compact('banner','eCommerce','wallet', 'hotDealProducts', 'hotDealProductsTaobao','activeHeader'));
    }

    public function home()
    {
        $banner = BannerModel::where('display',1)->get();
        $eCommerce = EcommercePlatformModel::where('display',1)->get();
        $user = Auth::user();
        $wallet = null;
        if ($user){
            $wallet = WalletsModel::where('user_id',$user->id)->first();
        }

        $products = ProductModel::whereHas('productValues.productAttributes')
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
            $product->src = ProductImagesModel::where('product_id', $product->id)->orderBy('id')->first()->src ?? null;
            $product->price = floatval($product->productValues->flatMap(function ($productValue) {
                    return $productValue->productAttributes->pluck('price');
                })->min() ?? 0);
            return $product;
        });

        $randomProducts = ProductModel::with(['productImages', 'productValues'])
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
        $activeHeader = 1;

        return view('web.home.index',compact('banner','eCommerce','wallet','hotDealProducts','randomProducts','activeHeader'));
    }


    public function search()
    {
        $activeHeader = 1;
        return view('web.search.index',compact('activeHeader'));
    }

    public function dealHot()
    {
        $listData = ProductModel::whereHas('productValues.productAttributes')
        ->with(['productValues.productAttributes'])
            ->leftJoin('product_values', 'products.id', '=', 'product_values.product_id')
            ->leftJoin('product_attributes', 'product_values.id', '=', 'product_attributes.product_value_id')
            ->select('products.*')
            ->selectRaw('COALESCE(MIN(CAST(product_attributes.price AS DECIMAL(10,2))), products.price) as lowest_price')
            ->groupBy('products.id')
            ->orderBy('lowest_price', 'asc')
            ->paginate(25);

        $listData->getCollection()->transform(function ($product) {
            $product->src = ProductImagesModel::where('product_id', $product->id)->first()->src ?? null;
            $product->price = floatval($product->lowest_price);
            return $product;
        });

        $nameCate = 'Deal Hot';
        $activeHeader = 1;

        return view('web.search.more',compact('listData','nameCate','activeHeader'));
    }

    public function recommendedYou()
    {
        $listData = ProductModel::with(['productImages', 'productValues'])
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
        $activeHeader = 1;

        return view('web.search.more',compact('listData','nameCate','activeHeader'));
    }

    public function confirmApplication()
    {
        $activeHeader = 1;

        return view('web.pay.index',compact('activeHeader'));
    }
    public function Payment()
    {
        $activeHeader = 1;

        return view('web.pay.payment',compact('activeHeader'));
    }

    public function about()
    {
        $data = SettingModel::select('about_shop')->first();
        $activeHeader = false;

        return view('web.about.index',compact('data','activeHeader'));
    }

    public function post($slug)
    {
        $data = PostModel::where('slug',$slug)->first();
        $activeHeader=false;

        return view('web.post.index',compact('data','activeHeader'));
    }
}
