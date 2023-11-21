<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Redmi Note 12 Pro Xiaomi',
                'price' => 499,99,
                'observations' => '6.6 inches, 8GB RAM, 128GB ROM, 108MP camera',
                'categoryId' => 'SmartPhone',
            ],
            [
                'name' => 'SmartTV-A2 Xiaomi',
                'price' => 579,00,
                'observations' => 'LED 4K UHD, 55 inches',
                'categoryId' => 'SmartTV',
            ],
            [
                'name' => 'AppleWatch-6',
                'price' => 1500,00,
                'observations' => 'GPS, 44mm, 32GB, 1.57 inches, 1.29 inches, 1.07 inches, 47.1g',
                'categoryId'=> 'SmartWatch',
            ],
            [
                'name' => 'iPhone-14 Apple',
                'price' => 999,99,
                'observations' => '5G, 128GB, 8GB RAM, 6.1 inches, 12MP camera',
                'categoryId'=> 'SmartPhone',
            ],
            [
                'name' => 'Instax Polaroid',
                'price' => 79,00,
                'observations' => 'Pack of 20 photos, 2 batteries, tripod',
                'categoryId'=> 'Camera',
            ],
            [
                'name' => 'Reflex-EOS Canon',
                'price' => 450,75,
                'observations' => '24.1MP, 4K, 3 inches, 1.040.000 pixels, 1.070g',
                'categoryId'=> 'Camera',
            ],
            [
                'name' => 'Tune JBL',
                'price' => 123,43,
                'observations' => '40h of battery, Bluetooth, 2h of charge, USB-C charging,',
                'categoryId'=> 'Headphones',
            ],
            [
                'name' => 'Studio-J4 JBL',
                'price' => 99,99,
                'observations' => '24h of battery, Bluetooth, 1h of charge, USB-C charging,',
                'categoryId'=> 'Headphones',
            ],
            [
                'name' => 'Pad-10 Lenovo',
                'price' => 555,00,
                'observations' => '15.6 inches, 16GB RAM, 256GB SSD, 1.8kg',
                'categoryId'=> 'Laptop',
            ],
            [
                'name' => 'Aspire-5 Acer',
                'price' => 399,00,
                'observations' => '15.6 inches, 8GB RAM, 256GB SSD, 1.9kg',
                'categoryId'=> 'Laptop',
            ]
        ];
        
        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'price' => $product['price'],
                'observations' => $product['observations'],
                'categoryId' => $product['categoryId'],
            ]);
        }
    }
}
