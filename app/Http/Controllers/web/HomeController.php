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
        return view('web.home.index-main',compact('banner','eCommerce','wallet', 'hotDealProducts', 'hotDealProductsTaobao'));
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

        return view('web.home.index',compact('banner','eCommerce','wallet','hotDealProducts','randomProducts'));
    }


    public function search()
    {
        return view('web.search.index');
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

        return view('web.search.more',compact('listData','nameCate'));
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

        return view('web.search.more',compact('listData','nameCate'));
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
        $data = SettingModel::select('about_shop')->first();
        return view('web.about.index',compact('data'));
    }

    public function post($slug)
    {
        $data = PostModel::where('slug',$slug)->first();
        return view('web.post.index',compact('data'));
    }
}
