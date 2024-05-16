<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Product 1',
            'description' => 'Description for product 1',
            'price' => 10.99,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => 'Product 2',
            'description' => 'Description for product 2',
            'price' => 15.99,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
