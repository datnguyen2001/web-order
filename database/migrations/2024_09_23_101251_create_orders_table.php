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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->string('order_code')->nullable()->comment('Mã đơn hàng');
            $table->boolean('is_tally')->default(false)->comment('Kiểm hàng');
            $table->longText('note')->nullable()->comment('Ghi chú');
            $table->float('goods_money_chinese')->nullable()->comment('Tiền hàng trung');
            $table->float('goods_money_vietnamese')->nullable()->comment('Tiền hàng việt');
            $table->float('china_domestic_shipping_fee_chinese')->nullable()->comment('Phí vận chuyển nội địa TQ tiền trung');
            $table->float('china_domestic_shipping_fee_vietnamese')->nullable()->comment('Phí vận chuyển nội địa TQ tiền việt');
            $table->float('discount_chinese')->nullable()->comment('Giảm giá tiền trung');
            $table->float('discount_vietnamese')->nullable()->comment('Giảm giá tiền việt');
            $table->float('international_shipping_fee_chinese')->nullable()->comment('Phí vận chuyển quốc tế tiền trung');
            $table->float('international_shipping_fee_vietnamese')->nullable()->comment('Phí vận chuyển quốc tế tiền việt');
            $table->float('vietnam_domestic_shipping_fee_chinese')->nullable()->comment('Phí vận chuyển nội địa Việt Nam tiền trung');
            $table->float('vietnam_domestic_shipping_fee_vietnamese')->nullable()->comment('Phí vận chuyển nội địa Việt Nam tiền việt');
            $table->float('insurance_fee_chinese')->nullable()->comment('Phí dịch vụ đảm bảo hàng hoá tiền trung');
            $table->float('insurance_fee_vietnamese')->nullable()->comment('Phí dịch vụ đảm bảo hàng hoá tiền việt');
            $table->float('partial_payment_fee_chinese')->nullable()->comment('Tiền phí trả thêm với cọc (45% phí 1%, 70% phí 0,3%, 100% phí 0) tiền trung');
            $table->float('partial_payment_fee_vietnamese')->nullable()->comment('Tiền phí trả thêm với cọc (45% phí 1%, 70% phí 0,3%, 100% phí 0) tiền việt');
            $table->float('tally_fee_chinese')->nullable()->comment('Tiền kiểm hàng tiền trung');
            $table->float('tally_fee_vietnamese')->nullable()->comment('Tiền kiểm hàng tiền việt');
            $table->integer('payment_currency')->default(1)->comment('Tiền tệ thanh toán (1: VND, 2:CNY)');
            $table->string('deposit')->nullable()->comment('Đặt cọc trước vốn hàng hóa (%)');
            $table->float('deposit_money')->nullable()->comment('Số tiền đặt cọc');
            $table->integer('payment_type')->nullable()->comment('Phương Thức Thanh Toán (1: Ví, 2: Chuyển khoản)');
            $table->float('total_payment_chinese')->nullable()->comment('Tổng Chi Phí TQ');
            $table->float('total_payment_vietnamese')->nullable()->comment('Tổng Chi Phí VN');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
