<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\ProductAttributesModel;
use App\Models\ProductImagesModel;
use App\Models\ProductModel;
use App\Models\ProductValuesModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detailProduct($slug)
    {
        $productAttribute=[];
        $data = ProductModel::where('slug',$slug)->first();
        $productImg = ProductImagesModel::where('product_id',$data->id)->get();
        $productValue = ProductValuesModel::where('product_id',$data->id)->get();
        if (count($productValue)>0){
            $productAttribute = ProductAttributesModel::where('product_value_id',$productValue[0]->id)->get();
        }
        $SimilarProducts = ProductModel::where('id','!=',$data->id)->inRandomOrder()->take(10)->get();
        foreach ($SimilarProducts as $pro){
            $value = ProductValuesModel::where('product_id',$pro->id)->first();
            $pro->src = ProductImagesModel::where('product_id',$pro->id)->first()->src;
            if ($value){
                $attribute = ProductAttributesModel::where('product_value_id',$value->id)->first();
                if ($attribute){
                    $pro->price = $attribute->price;
                }else{
                    $pro->price = floatval($pro->price);
                }
            }
        }

        return view('web.product.index',compact('data','productImg','productValue','productAttribute','SimilarProducts'));
    }
}
