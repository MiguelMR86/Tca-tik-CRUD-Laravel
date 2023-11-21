<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'name' => 'Guanxe'
            ],
            [
                'name' => 'OnlineCanarias'
            ],
            [
                'name' => 'Amazon'
            ],
            [
                'name' => 'PcComponentes'
            ]
        ];

        foreach ($stores as $store) {
            DB::table('stores')->insert([
                'name' => $store['name'],
            ]);
        }
    }
}
