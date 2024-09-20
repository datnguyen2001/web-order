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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('product_name')->nullable();
            $table->text('product_value')->nullable();
            $table->text('product_attribute')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('product_image')->nullable();
            $table->text('product_value_image')->nullable();
            $table->string('chinese_price')->nullable();
            $table->string('vietnamese_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
