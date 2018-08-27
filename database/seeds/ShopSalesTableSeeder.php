<?php

use Illuminate\Database\Seeder;

class ShopSalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_solds')->insert([
            'shop_id'       => 1,
            'product_id'    => 1,
            'sold'          => 55,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 1,
            'product_id'    => 5,
            'sold'          => 23,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 1,
            'product_id'    => 8,
            'sold'          => 25,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 1,
            'product_id'    => 9,
            'sold'          => 35,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 1,
            'product_id'    => 1,
            'sold'          => 5,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 1,
            'product_id'    => 1,
            'sold'          => 15,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 3,
            'product_id'    => 12,
            'sold'          => 55,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 3,
            'product_id'    => 13,
            'sold'          => 5,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 3,
            'product_id'    => 1,
            'sold'          => 23,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 3,
            'product_id'    => 17,
            'sold'          => 65,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 5,
            'product_id'    => 1,
            'sold'          => 55,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 5,
            'product_id'    => 23,
            'sold'          => 8,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 5,
            'product_id'    => 4,
            'sold'          => 55,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 5,
            'product_id'    => 1,
            'sold'          => 55,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 5,
            'product_id'    => 6,
            'sold'          => 20,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 4,
            'product_id'    => 1,
            'sold'          => 55,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 4,
            'product_id'    => 3,
            'sold'          => 5,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 4,
            'product_id'    => 4,
            'sold'          => 5,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 4,
            'product_id'    => 3,
            'sold'          => 5,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 6,
            'product_id'    => 1,
            'sold'          => 55,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 6,
            'product_id'    => 3,
            'sold'          => 55,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 6,
            'product_id'    => 4,
            'sold'          => 55,
        ]);

        DB::table('shop_solds')->insert([
            'shop_id'       => 6,
            'product_id'    => 1,
            'sold'          => 55,
        ]);

        
    }
}
