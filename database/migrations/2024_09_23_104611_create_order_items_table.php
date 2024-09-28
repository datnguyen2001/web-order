<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->text('product_name')->nullable();
            $table->text('product_value')->nullable();
            $table->text('product_attribute')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('product_image')->nullable();
            $table->text('product_value_image')->nullable();
            $table->decimal('chinese_price', 20, 2)->nullable();
            $table->decimal('vietnamese_price', 20, 2)->nullable();
            $table->decimal('total_chinese_price', 20, 2)->nullable();
            $table->decimal('total_vietnamese_price', 20, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
