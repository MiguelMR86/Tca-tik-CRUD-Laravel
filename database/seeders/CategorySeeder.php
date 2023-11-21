<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'categoryId' => 'SmartPhone',
            ],
            [
                'categoryId'=> 'SmartTV',
            ],
            [
                'categoryId'=> 'SmartWatch',
            ],
            [
                'categoryId'=> 'Camera',
            ],
            [
                'categoryId'=> 'Headphones',
            ],
            [
                'categoryId'=> 'Laptop',
            ]
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'categoryId' => $category['categoryId'],
            ]);
        }
    }
}
