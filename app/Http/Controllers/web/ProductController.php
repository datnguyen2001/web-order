<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\ProductAttributesModel;
use App\Models\ProductImagesModel;
use App\Models\ProductModel;
use App\Models\ProductValuesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function detailProduct($slug)
    {
        $productAttribute = [];
        $data = ProductModel::where('slug', $slug)
            ->join('product_images', function($join) {
                $join->on('products.id', '=', 'product_images.product_id')
                    ->whereRaw('product_images.id = (SELECT MIN(id) FROM product_images WHERE product_images.product_id = products.id)');
            })->select(
                'products.*',
                'product_images.src as src'
            )->first();
        $productImg = ProductImagesModel::where('product_id', $data->id)->get();
        $productValue = ProductValuesModel::where('product_id', $data->id)->get();
        if (count($productValue) > 0) {
            $productAttribute = DB::table('product_attributes')
                ->join('product_values', 'product_attributes.product_value_id', '=', 'product_values.id')
                ->join('products', 'product_values.product_id', '=', 'products.id')
                ->join('product_images', function($join) {
                    $join->on('products.id', '=', 'product_images.product_id')
                        ->whereRaw('product_images.id = (SELECT MIN(id) FROM product_images WHERE product_images.product_id = products.id)');
                })
                ->where('product_attributes.product_value_id', $productValue[0]->id)
                ->select(
                    'product_attributes.*',
                    'product_values.name as product_value_name',
                    'product_values.product_id as product_id',
                    'product_values.src as product_value_src',
                    'products.name as product_name',
                    'product_images.src as product_image'
                )
                ->get();
        }
        $SimilarProducts = ProductModel::where('id', '!=', $data->id)->inRandomOrder()->take(10)->get();
        foreach ($SimilarProducts as $pro) {
            $value = ProductValuesModel::where('product_id', $pro->id)->pluck('id');
            $pro->src = ProductImagesModel::where('product_id', $pro->id)->first()->src;
            if ($value) {
                $attribute = ProductAttributesModel::whereIn('product_value_id', $value)->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC')->first();
                if ($attribute) {
                    $pro->price = $attribute->price;
                } else {
                    $pro->price = floatval($pro->price);
                }
            }
        }
        $activeHeader = 1;

        return view('web.product.index', compact('data', 'productImg', 'productValue', 'productAttribute', 'SimilarProducts','activeHeader'));
    }

    public function getAttribute($valueID)
    {
        try {
            $productAttribute = DB::table('product_attributes')
                ->join('product_values', 'product_attributes.product_value_id', '=', 'product_values.id')
                ->join('products', 'product_values.product_id', '=', 'products.id')
                ->join('product_images', function($join) {
                    $join->on('products.id', '=', 'product_images.product_id')
                        ->whereRaw('product_images.id = (SELECT MIN(id) FROM product_images WHERE product_images.product_id = products.id)');
                })
                ->where('product_attributes.product_value_id', $valueID)
                ->select(
                    'product_attributes.*',
                    'product_values.name as product_value_name',
                    'product_values.product_id as product_id',
                    'product_values.src as product_value_src',
                    'products.name as product_name',
                    'product_images.src as product_image'
                )
                ->get();

            return response()->json(['message' => 'Lấy dữ liệu thành công', 'data' => $productAttribute]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => false]);
        }
    }

    public function search1688(Request $request)
    {
        $searchQuery = $request->get('keySearch');
        $minPrice = intval($request->input('min_price', 0));
        $maxPrice = intval($request->input('max_price', PHP_INT_MAX));

        $listData = ProductModel::with(['productImages', 'productValues'])
            ->whereNotNull('price')
            ->when($searchQuery, function ($query, $searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%');
            })->whereBetween('price', [$minPrice, $maxPrice])
            ->paginate(24);

        foreach ($listData as $product) {
            $product->src = optional($product->productImages->first())->src;

            $minPrice = $product->productValues->flatMap(function ($productValue) {
                return $productValue->productAttributes->pluck('price');
            })->min();

            $product->price = floatval($minPrice ?? $product->price);
        }
        $activeHeader = 1;

        return view('web.search.index', compact('listData', 'searchQuery','activeHeader'));
    }

}
