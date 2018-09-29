<?php

use Illuminate\Database\Seeder;

class CustomerHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_histories')->insert([
            'sale_id'           => 1,
            'product_id'        => 1,
            'product_name'      => 'Camara',
            'product_price'     => 9000,
            'amount'            => 1
        ]);

        DB::table('customer_histories')->insert([
            'sale_id'           => 1,
            'product_id'        => 2,
            'product_name'      => 'USB',
            'product_price'     => 1000,
            'amount'            => 1
        ]);

        DB::table('customer_histories')->insert([
            'sale_id'           => 2,
            'product_id'        => 3,
            'product_name'      => 'USB',
            'product_price'     => 100,
            'amount'            => 1
        ]);

        DB::table('customer_histories')->insert([
            'sale_id'           => 3,
            'product_id'        => 4,
            'product_name'      => 'Celular',
            'product_price'     => 1000,
            'amount'            => 1
        ]);

        DB::table('customer_histories')->insert([
            'sale_id'           => 3,
            'product_id'        => 5,
            'product_name'      => 'Bocinas',
            'product_price'     => 500,
            'amount'            => 1
        ]);
    }
}
