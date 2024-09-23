<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            $cartItems = $request->input('cartItems');

            foreach ($cartItems as $item) {
                // Check if the same product with the same attributes already exists
                $existingCartItem = DB::table('carts')
                    ->where('user_id', auth()->id())
                    ->where('product_name', $item['product_name'])
                    ->where('product_value', $item['value_name'])
                    ->where('product_attribute', $item['attribute_name'])
                    ->first();

                if ($existingCartItem) {
                    // If the product exists, update the quantity
                    DB::table('carts')
                        ->where('id', $existingCartItem->id)
                        ->update([
                            'quantity' => $existingCartItem->quantity + $item['quantity'],
                            'updated_at' => now(),
                        ]);
                } else {
                    // If the product doesn't exist, insert a new record
                    DB::table('carts')->insert([
                        'user_id' => auth()->id(),
                        'product_name' => $item['product_name'],
                        'product_value' => $item['value_name'],
                        'product_attribute' => $item['attribute_name'],
                        'quantity' => $item['quantity'],
                        'product_image' => $item['product_image'],
                        'product_value_image' => $item['product_value_image'],
                        'chinese_price' => $item['chinese_price'],
                        'vietnamese_price' => $item['vietnamese_price'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            return response()->json(['message' => 'Thêm vào giỏ hàng thành công', 'status' => true]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => false]);
        }
    }


    public function deleteAttribute(Request $request)
    {
        $productName = $request->input('product_name');
        $productValue = $request->input('product_value');
        $productAttribute = $request->input('product_attribute');

        DB::table('carts')
            ->where('product_name', $productName)
            ->where('product_value', $productValue)
            ->where('product_attribute', $productAttribute)
            ->delete();

        return response()->json(['success' => true]);
    }

    public function deleteProduct(Request $request)
    {
        $productName = $request->input('product_name');

        DB::table('carts')
            ->where('product_name', $productName)
            ->delete();

        return response()->json(['success' => true]);
    }

    public function deleteCart(Request $request)
    {
        $userId = $request->input('user_id');

        DB::table('carts')
            ->where('user_id', $userId)
            ->delete();

        return response()->json(['success' => true]);
    }

    public function checkAddress()
    {
        $addressExists = AddressModel::where('user_id', Auth::id())->exists();

        return response()->json([
            'address_exists' => $addressExists
        ]);
    }

    public function updateStatus(Request $request)
    {
        $userId = Auth::id();

        try {
            // First, mark all products as not selected (is_buying_selected = false)
            DB::table('carts')
                ->where('user_id', $userId)
                ->update(['is_buying_selected' => false]);

            DB::table('carts')
                    ->where('user_id', $userId)
                    ->whereIn('id', $request->product_ids)
                    ->update(['is_buying_selected' => true]);

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

}
