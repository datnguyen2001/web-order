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
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->float('exchange_rate')->default(0);
            $table->float('insurance_fee')->default(0);
            $table->float('partial_payment_key_1')->default(0);
            $table->float('partial_payment_fee_1')->default(0);
            $table->float('partial_payment_key_2')->default(0);
            $table->float('partial_payment_fee_2')->default(0);
            $table->float('tally_fee')->default(0);
            $table->longText('about_shop')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('img_qr')->nullable();
            $table->longText('content_footer_one')->nullable();
            $table->longText('content_footer_two')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
