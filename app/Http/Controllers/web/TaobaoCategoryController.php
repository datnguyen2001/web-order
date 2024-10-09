<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryTaobaoModel;
use App\Models\ProductAttributeTaobaoModel;
use App\Models\ProductImageTaobaoModel;
use App\Models\ProductTaobaoModel;
use App\Models\ProductValueTaobaoModel;
use Illuminate\Http\Request;

class TaobaoCategoryController extends Controller
{
    public function category($status,Request $request)
    {
        $name = null;
        $slug = null;
        $cate = CategoryTaobaoModel::where('slug', $status)->select('id', 'name', 'slug')->first();
        $dataCategory = CategoryTaobaoModel::where('parent_id',$cate->id)->select('id', 'name', 'slug')->get();
        $cate_2 = [];
        $cate_3 = [];
        foreach ($dataCategory as $item){
            $cate_2[] = $item->id;
            $item->categoryThree = CategoryTaobaoModel::where('child_id',$item->id)->select('id', 'name', 'slug')->get();
            foreach ($item->categoryThree as $value){
                $cate_3[] = $value->id;
            }
        }
        $name_category = $cate->name;
        $minPrice = intval($request->input('min_price', 0));
        $maxPrice = intval($request->input('max_price', PHP_INT_MAX));
        $listData = ProductTaobaoModel::where(function ($query) use ($cate_2, $cate_3) {
            $query->whereIn('category_id', $cate_2)
                ->orWhereIn('category_id', $cate_3);
        })->whereBetween('price', [$minPrice, $maxPrice])
            ->paginate(24);

        foreach ($listData as $key => $pro){
            $productValue = ProductValueTaobaoModel::where('product_id',$pro->id)->pluck('id');
            $pro->src = ProductImageTaobaoModel::where('product_id',$pro->id)->first()->src;
            if ($productValue){
                $attribute = ProductAttributeTaobaoModel::whereIn('product_value_id',$productValue)->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC')->select('id','price')->first();
                if ($attribute){
                    $pro->price = floatval($attribute->price);
                }else{
                    $pro->price = floatval($pro->price);
                }
            }
        }
        $activeHeader=2;

        return view('web.category_taobao.index',compact('cate','dataCategory','listData','status','name','slug','name_category','activeHeader'));
    }

    public function categoryTwo($status,$name,Request $request)
    {
        $slug = null;
        $cate = CategoryTaobaoModel::where('slug', $status)->select('id', 'name', 'slug')->first();
        $dataCategory = CategoryTaobaoModel::where('parent_id',$cate->id)->select('id', 'name', 'slug')->get();
        $cate_2 = CategoryTaobaoModel::where('slug', $name)->first();
        $cate_3 = [];
        foreach ($dataCategory as $item){
            $item->categoryThree = CategoryTaobaoModel::where('child_id',$item->id)->select('id', 'name', 'slug')->get();
            foreach ($item->categoryThree as $value){
                $cate_3[] = $value->id;
            }
        }
        $name_category = $cate_2->name;
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', PHP_INT_MAX);

        $listData = ProductTaobaoModel::where(function ($query) use ($cate_2, $cate_3) {
            $query->where('category_id', $cate_2->id)
                ->orWhereIn('category_id', $cate_3);
        })->whereBetween('price', [$minPrice, $maxPrice])
            ->paginate(24);

        foreach ($listData as $pro){
            $productValue = ProductValueTaobaoModel::where('product_id',$pro->id)->pluck('id');
            $pro->src = ProductImageTaobaoModel::where('product_id',$pro->id)->first()->src;
            if ($productValue){
                $attribute = ProductAttributeTaobaoModel::whereIn('product_value_id',$productValue)->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC')->select('id','price')->first();
                if ($attribute){
                    $pro->price = $attribute->price;
                }
            }
        }
        $activeHeader = 2;

        return view('web.category_taobao.index',compact('cate','dataCategory','listData','status','name','slug','name_category','activeHeader'));
    }

    public function categoryThree($status,$name,$slug,Request $request)
    {
        $cate = CategoryTaobaoModel::where('slug', $status)->select('id', 'name', 'slug')->first();
        $dataCategory = CategoryTaobaoModel::where('parent_id',$cate->id)->select('id', 'name', 'slug')->get();
        $cate_2 = [];
        $cate_3 = CategoryTaobaoModel::where('slug', $slug)->first();
        foreach ($dataCategory as $item){
            $cate_2[] = $item->id;
            $item->categoryThree = CategoryTaobaoModel::where('child_id',$item->id)->select('id', 'name', 'slug')->get();
        }
        $name_category = $cate_3->name;
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', PHP_INT_MAX);
        $listData = ProductTaobaoModel::where('category_id',$cate_3->id)->select('id', 'name', 'slug','price','sold')
            ->whereBetween('price', [$minPrice, $maxPrice])->paginate(24);
        foreach ($listData as $pro){
            $productValue = ProductValueTaobaoModel::where('product_id',$pro->id)->pluck('id');
            $pro->src = ProductImageTaobaoModel::where('product_id',$pro->id)->first()->src;
            if ($productValue){
                $attribute = ProductAttributeTaobaoModel::whereIn('product_value_id',$productValue)->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC')->select('id','price')->first();
                if ($attribute){
                    $pro->price = $attribute->price;
                }
            }
        }
        $activeHeader = 2;

        return view('web.category_taobao.index',compact('cate','dataCategory','listData','status','name','slug','name_category','activeHeader'));
    }
}
