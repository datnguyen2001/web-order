<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductAttributesModel;
use App\Models\ProductImagesModel;
use App\Models\ProductModel;
use App\Models\ProductValuesModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category($status,Request $request)
    {
        $name = null;
        $slug = null;
        $cate = CategoryModel::where('slug', $status)->select('id', 'name', 'slug')->first();
        $dataCategory = CategoryModel::where('parent_id',$cate->id)->select('id', 'name', 'slug')->get();
        $cate_2 = [];
        $cate_3 = [];
        foreach ($dataCategory as $item){
            $cate_2[] = $item->id;
            $item->categoryThree = CategoryModel::where('child_id',$item->id)->select('id', 'name', 'slug')->get();
            foreach ($item->categoryThree as $value){
                $cate_3[] = $value->id;
            }
        }
        $name_category = $cate->name;
        $minPrice = intval($request->input('min_price', 0));
        $maxPrice = intval($request->input('max_price', PHP_INT_MAX));
        $listData = ProductModel::where(function ($query) use ($cate_2, $cate_3) {
            $query->whereIn('category_id', $cate_2)
                ->orWhereIn('category_id', $cate_3);
        })->whereBetween('price', [$minPrice, $maxPrice])
            ->paginate(24);

        foreach ($listData as $key => $pro){
            $productValue = ProductValuesModel::where('product_id',$pro->id)->pluck('id');
            $pro->src = ProductImagesModel::where('product_id',$pro->id)->first()->src;
            if ($productValue){
                $attribute = ProductAttributesModel::whereIn('product_value_id',$productValue)->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC')->select('id','price')->first();
                if ($attribute){
                    $pro->price = floatval($attribute->price);
                }else{
                    $pro->price = floatval($pro->price);
                }
            }
        }

        return view('web.category.index',compact('cate','dataCategory','listData','status','name','slug','name_category'));
    }

    public function categoryTwo($status,$name,Request $request)
    {
        $slug = null;
        $cate = CategoryModel::where('slug', $status)->select('id', 'name', 'slug')->first();
        $dataCategory = CategoryModel::where('parent_id',$cate->id)->select('id', 'name', 'slug')->get();
        $cate_2 = CategoryModel::where('slug', $name)->first();
        $cate_3 = [];
        foreach ($dataCategory as $item){
            $item->categoryThree = CategoryModel::where('child_id',$item->id)->select('id', 'name', 'slug')->get();
            foreach ($item->categoryThree as $value){
                $cate_3[] = $value->id;
            }
        }
        $name_category = $cate_2->name;
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', PHP_INT_MAX);

        $listData = ProductModel::where(function ($query) use ($cate_2, $cate_3) {
            $query->where('category_id', $cate_2->id)
                ->orWhereIn('category_id', $cate_3);
        })->whereBetween('price', [$minPrice, $maxPrice])
            ->paginate(24);

        foreach ($listData as $pro){
            $productValue = ProductValuesModel::where('product_id',$pro->id)->pluck('id');
            $pro->src = ProductImagesModel::where('product_id',$pro->id)->first()->src;
            if ($productValue){
                $attribute = ProductAttributesModel::whereIn('product_value_id',$productValue)->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC')->select('id','price')->first();
                if ($attribute){
                    $pro->price = $attribute->price;
                }
            }
        }

        return view('web.category.index',compact('cate','dataCategory','listData','status','name','slug','name_category'));
    }

    public function categoryThree($status,$name,$slug,Request $request)
    {
        $cate = CategoryModel::where('slug', $status)->select('id', 'name', 'slug')->first();
        $dataCategory = CategoryModel::where('parent_id',$cate->id)->select('id', 'name', 'slug')->get();
        $cate_2 = [];
        $cate_3 = CategoryModel::where('slug', $slug)->first();
        foreach ($dataCategory as $item){
            $cate_2[] = $item->id;
            $item->categoryThree = CategoryModel::where('child_id',$item->id)->select('id', 'name', 'slug')->get();
        }
        $name_category = $cate_3->name;
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', PHP_INT_MAX);
        $listData = ProductModel::where('category_id',$cate_3->id)->select('id', 'name', 'slug','price','sold')
            ->whereBetween('price', [$minPrice, $maxPrice])->paginate(24);
        foreach ($listData as $pro){
            $productValue = ProductValuesModel::where('product_id',$pro->id)->pluck('id');
            $pro->src = ProductImagesModel::where('product_id',$pro->id)->first()->src;
            if ($productValue){
                $attribute = ProductAttributesModel::whereIn('product_value_id',$productValue)->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC')->select('id','price')->first();
                if ($attribute){
                    $pro->price = $attribute->price;
                }
            }
        }

        return view('web.category.index',compact('cate','dataCategory','listData','status','name','slug','name_category'));
    }

}
