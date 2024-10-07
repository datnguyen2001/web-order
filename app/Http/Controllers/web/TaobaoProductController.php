<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\ProductAttributeTaobaoModel;
use App\Models\ProductImageTaobaoModel;
use App\Models\ProductTaobaoModel;
use App\Models\ProductValueTaobaoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaobaoProductController extends Controller
{
    public function detailProduct($slug)
    {
        $productAttribute = [];
        $data = ProductTaobaoModel::where('slug', $slug)
            ->join('product_images_taobaos', function($join) {
                $join->on('product_taobaos.id', '=', 'product_images_taobaos.product_id')
                    ->whereRaw('product_images_taobaos.id = (SELECT MIN(id) FROM product_images_taobaos WHERE product_images_taobaos.product_id = product_taobaos.id)');
            })->select(
                'product_taobaos.*',
                'product_images_taobaos.src as src'
            )->first();
        $productImg = ProductImageTaobaoModel::where('product_id', $data->id)->get();
        $productValue = ProductValueTaobaoModel::where('product_id', $data->id)->get();
        if (count($productValue) > 0) {
            $productAttribute = DB::table('product_attributes_taobaos')
                ->join('product_values_taobaos', 'product_attributes_taobaos.product_value_id', '=', 'product_values_taobaos.id')
                ->join('product_taobaos', 'product_values_taobaos.product_id', '=', 'product_taobaos.id')
                ->join('product_images_taobaos', function($join) {
                    $join->on('product_taobaos.id', '=', 'product_images_taobaos.product_id')
                        ->whereRaw('product_images_taobaos.id = (SELECT MIN(id) FROM product_images_taobaos WHERE product_images_taobaos.product_id = product_taobaos.id)');
                })
                ->where('product_attributes_taobaos.product_value_id', $productValue[0]->id)
                ->select(
                    'product_attributes_taobaos.*',
                    'product_values_taobaos.name as product_value_name',
                    'product_values_taobaos.product_id as product_id',
                    'product_values_taobaos.src as product_value_src',
                    'product_taobaos.name as product_name',
                    'product_images_taobaos.src as product_image'
                )
                ->get();
        }
        $SimilarProducts = ProductTaobaoModel::where('id', '!=', $data->id)->inRandomOrder()->take(10)->get();
        foreach ($SimilarProducts as $pro) {
            $value = ProductValueTaobaoModel::where('product_id', $pro->id)->pluck('id');
            $pro->src = ProductImageTaobaoModel::where('product_id', $pro->id)->first()->src;
            if ($value) {
                $attribute = ProductAttributeTaobaoModel::whereIn('product_value_id', $value)->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC')->first();
                if ($attribute) {
                    $pro->price = $attribute->price;
                } else {
                    $pro->price = floatval($pro->price);
                }
            }
        }

        return view('web.product_taobao.index', compact('data', 'productImg', 'productValue', 'productAttribute', 'SimilarProducts'));
    }

    public function getAttribute($valueID)
    {
        try {
            $productAttribute = DB::table('product_attributes_taobaos')
                ->join('product_values_taobaos', 'product_attributes_taobaos.product_value_id', '=', 'product_values_taobaos.id')
                ->join('product_taobaos', 'product_values_taobaos.product_id', '=', 'product_taobaos.id')
                ->join('product_images_taobaos', function($join) {
                    $join->on('product_taobaos.id', '=', 'product_images_taobaos.product_id')
                        ->whereRaw('product_images_taobaos.id = (SELECT MIN(id) FROM product_images_taobaos WHERE product_images_taobaos.product_id = product_taobaos.id)');
                })
                ->where('product_attributes_taobaos.product_value_id', $valueID)
                ->select(
                    'product_attributes_taobaos.*',
                    'product_values_taobaos.name as product_value_name',
                    'product_values_taobaos.product_id as product_id',
                    'product_values_taobaos.src as product_value_src',
                    'product_taobaos.name as product_name',
                    'product_images_taobaos.src as product_image'
                )
                ->get();

            return response()->json(['message' => 'Lấy dữ liệu thành công', 'data' => $productAttribute]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => false]);
        }
    }
}
