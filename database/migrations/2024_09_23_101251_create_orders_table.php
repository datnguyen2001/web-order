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
            $table->decimal('goods_money_chinese', 20, 2)->nullable()->comment('Tiền hàng trung');
            $table->decimal('goods_money_vietnamese', 20, 2)->nullable()->comment('Tiền hàng việt');
            $table->decimal('china_domestic_shipping_fee_chinese', 20, 2)->nullable()->comment('Phí vận chuyển nội địa TQ tiền trung');
            $table->decimal('china_domestic_shipping_fee_vietnamese', 20, 2)->nullable()->comment('Phí vận chuyển nội địa TQ tiền việt');
            $table->decimal('discount_chinese', 20, 2)->nullable()->comment('Giảm giá tiền trung');
            $table->decimal('discount_vietnamese', 20, 2)->nullable()->comment('Giảm giá tiền việt');
            $table->decimal('international_shipping_fee_chinese', 20, 2)->nullable()->comment('Phí vận chuyển quốc tế tiền trung');
            $table->decimal('international_shipping_fee_vietnamese', 20, 2)->nullable()->comment('Phí vận chuyển quốc tế tiền việt');
            $table->decimal('vietnam_domestic_shipping_fee_chinese', 20, 2)->nullable()->comment('Phí vận chuyển nội địa Việt Nam tiền trung');
            $table->decimal('vietnam_domestic_shipping_fee_vietnamese', 20, 2)->nullable()->comment('Phí vận chuyển nội địa Việt Nam tiền việt');
            $table->decimal('insurance_fee_chinese', 20, 2)->nullable()->comment('Phí dịch vụ đảm bảo hàng hoá tiền trung');
            $table->decimal('insurance_fee_vietnamese', 20, 2)->nullable()->comment('Phí dịch vụ đảm bảo hàng hoá tiền việt');
            $table->decimal('partial_payment_fee_chinese', 20, 2)->nullable()->comment('Tiền phí trả thêm với cọc (45% phí 1%, 70% phí 0,3%, 100% phí 0) tiền trung');
            $table->decimal('partial_payment_fee_vietnamese', 20, 2)->nullable()->comment('Tiền phí trả thêm với cọc (45% phí 1%, 70% phí 0,3%, 100% phí 0) tiền việt');
            $table->decimal('tally_fee_chinese', 20, 2)->nullable()->comment('Tiền kiểm hàng tiền trung');
            $table->decimal('tally_fee_vietnamese', 20, 2)->nullable()->comment('Tiền kiểm hàng tiền việt');
            $table->integer('payment_currency')->default(1)->comment('Tiền tệ thanh toán (1: VND, 2:CNY)');
            $table->string('deposit')->nullable()->comment('Đặt cọc trước vốn hàng hóa (%)');
            $table->decimal('deposit_money', 20, 2)->nullable()->comment('Số tiền đặt cọc');
            $table->integer('payment_type')->nullable()->comment('Phương Thức Thanh Toán (1: Ví, 2: Chuyển khoản)');
            $table->decimal('total_payment_chinese', 20, 2)->nullable()->comment('Tổng Chi Phí TQ');
            $table->decimal('total_payment_vietnamese', 20, 2)->nullable()->comment('Tổng Chi Phí VN');
            $table->unsignedBigInteger('status_id')->default(2);
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
