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
    public function category($status)
    {
        $name = null;
        $slug = null;
        $cate = CategoryModel::where('slug', $status)->first();
        $dataCategory = CategoryModel::where('parent_id',$cate->id)->get();
        $cate_2 = [];
        $cate_3 = [];
        foreach ($dataCategory as $item){
            $cate_2[] = $item->id;
            $item->categoryThree = CategoryModel::where('child_id',$item->id)->get();
            foreach ($item->categoryThree as $value){
                $cate_3[] = $value->id;
            }
        }
        $name_category = $cate->name;
        $listData = ProductModel::whereIn('category_id',$cate_2)->orWhereIn('category_id',$cate_3)->paginate(24);
        foreach ($listData as $pro){
            $productValue = ProductValuesModel::where('product_id',$pro->id)->first();
            $pro->src = ProductImagesModel::where('product_id',$pro->id)->first()->src;
            if ($productValue){
                $attribute = ProductAttributesModel::where('product_value_id',$productValue->id)->first();
                if ($attribute){
                    $pro->price = $attribute->price;
                }
            }
        }

        return view('web.category.index',compact('cate','dataCategory','listData','status','name','slug','name_category'));
    }

    public function categoryTwo($status,$name)
    {
        $slug = null;
        $cate = CategoryModel::where('slug', $status)->first();
        $dataCategory = CategoryModel::where('parent_id',$cate->id)->get();
        $cate_2 = CategoryModel::where('slug', $name)->first();
        $cate_3 = [];
        foreach ($dataCategory as $item){
            $item->categoryThree = CategoryModel::where('child_id',$item->id)->get();
            foreach ($item->categoryThree as $value){
                $cate_3[] = $value->id;
            }
        }
        $name_category = $cate_2->name;
        $listData = ProductModel::where('category_id',$cate_2->id)->orWhereIn('category_id',$cate_3)->paginate(24);
        foreach ($listData as $pro){
            $productValue = ProductValuesModel::where('product_id',$pro->id)->first();
            $pro->src = ProductImagesModel::where('product_id',$pro->id)->first()->src;
            if ($productValue){
                $attribute = ProductAttributesModel::where('product_value_id',$productValue->id)->first();
                if ($attribute){
                    $pro->price = $attribute->price;
                }
            }
        }

        return view('web.category.index',compact('cate','dataCategory','listData','status','name','slug','name_category'));
    }

    public function categoryThree($status,$name,$slug)
    {
        $cate = CategoryModel::where('slug', $status)->first();
        $dataCategory = CategoryModel::where('parent_id',$cate->id)->get();
        $cate_2 = [];
        $cate_3 = CategoryModel::where('slug', $slug)->first();
        foreach ($dataCategory as $item){
            $cate_2[] = $item->id;
            $item->categoryThree = CategoryModel::where('child_id',$item->id)->get();
        }
        $name_category = $cate_3->name;
        $listData = ProductModel::whereIn('category_id',$cate_2)->orWhere('category_id',$cate_3->id)->paginate(24);
        foreach ($listData as $pro){
            $productValue = ProductValuesModel::where('product_id',$pro->id)->first();
            $pro->src = ProductImagesModel::where('product_id',$pro->id)->first()->src;
            if ($productValue){
                $attribute = ProductAttributesModel::where('product_value_id',$productValue->id)->first();
                if ($attribute){
                    $pro->price = $attribute->price;
                }
            }
        }

        return view('web.category.index',compact('cate','dataCategory','listData','status','name','slug','name_category'));
    }

}
