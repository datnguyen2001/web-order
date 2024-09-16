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
        Schema::create('wallet_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('transaction_code');
            $table->integer('amount');
            $table->integer('old_balance');
            $table->integer('new_balance');
            $table->integer('wallet_type')->default(1)->comment('1 là tiền việt, 2 là tiền trung');
            $table->longText('description')->nullable();
            $table->integer('type')->default(1)->comment('1 là nạp, 2 là thanh toán');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_histories');
    }
};
