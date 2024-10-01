<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('warehouses')->insert([
            [
                'warehouse_id' => 1,
                'name' => 'Bằng Tường',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'warehouse_id' => 5,
                'name' => 'Quảng Châu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
