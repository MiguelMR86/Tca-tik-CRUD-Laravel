<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductHasXSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productStores = [
            [
                'storeId' => 1,
                'productId' => 1,
                'stock' => 10,
            ],
            [
                'storeId' => 1,
                'productId' => 2,
                'stock' => 4,
            ],
            [
                'storeId' => 1,
                'productId' => 3,
                'stock' => 0,
            ],
            [
                'storeId' => 2,
                'productId' => 1,
                'stock' => 1,
            ],
            [
                'storeId' => 2,
                'productId' => 2,
                'stock' => 12,
            ],
            [
                'storeId' => 2,
                'productId' => 4,
                'stock' => 5,
            ],
            [
                'storeId' => 3,
                'productId' => 5,
                'stock' => 3,
            ],
            [
                'storeId' => 3,
                'productId' => 6,
                'stock' => 6,
            ],
            [
                'storeId' => 4,
                'productId' => 7,
                'stock' => 0,
            ],
            [
                'storeId' => 4,
                'productId' => 8,
                'stock' => 7,
            ],
            [
                'storeId' => 4,
                'productId' => 9,
                'stock' => 8,
            ],
        ];

        foreach($productStores as $productStore) {
            DB::table('product_has_x_e_s')->insert([
                'storeId' => $productStore['storeId'],
                'productId' => $productStore['productId'],
                'stock' => $productStore['stock'],
            ]);
        }
    }
}
