<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            "ACCEPTED",
            "PENDING",
            "MERCHANT_DELIVERING",
            "PUTAWAY",
            "TRANSPORTING",
            "READY_FOR_DELIVERY",
            "DELIVERING",
            "DELIVERED",
            "CANCELLED",
            "MIA",
            "DELIVERY_CANCELLED"
        ];

        $data = [];
        foreach($statuses as $status){
            $data[] = [
                'name' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('statuses')->insert($data);
    }
}
