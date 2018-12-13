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
            'product_id'        => 4,
            'product_name'      => 'Mouse Optico',
            'product_price'     => 200,
            'amount'            => 1
        ]);

        DB::table('customer_histories')->insert([
            'sale_id'           => 1,
            'product_id'        => 39,
            'product_name'      => 'Hard Disk 500GB',
            'product_price'     => 1000,
            'amount'            => 1
        ]);

        DB::table('customer_histories')->insert([
            'sale_id'           => 2,
            'product_id'        => 40,
            'product_name'      => 'Mouse Logitech',
            'product_price'     => 500,
            'amount'            => 1
        ]);

        DB::table('customer_histories')->insert([
            'sale_id'           => 2,
            'product_id'        => 9,
            'product_name'      => 'PC Gamer',
            'product_price'     => 2000,
            'amount'            => 1
        ]);

        DB::table('customer_histories')->insert([
            'sale_id'           => 2,
            'product_id'        => 46,
            'product_name'      => 'PS4 Headset',
            'product_price'     => 2500,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 2,
            'product_id'        => 3,
            'product_name'      => 'Disco duro 500GB',
            'product_price'     => 3000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 3,
            'product_id'        => 17,
            'product_name'      => 'PS4 Controller Black',
            'product_price'     => 1000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 3,
            'product_id'        => 21,
            'product_name'      => 'Tom Clancy',
            'product_price'     => 1000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 3,
            'product_id'        => 20,
            'product_name'      => 'PC Fallout 4',
            'product_price'     => 5000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 4,
            'product_id'        => 4,
            'product_name'      => 'Mouse Optico',
            'product_price'     => 200,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 4,
            'product_id'        => 40,
            'product_name'      => 'Mouse Logitech',
            'product_price'     => 500,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 4,
            'product_id'        => 49,
            'product_name'      => 'Xbox one microfono',
            'product_price'     => 1000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 5,
            'product_id'        => 40,
            'product_name'      => 'Mouse Logitech',
            'product_price'     => 500,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 5,
            'product_id'        => 3,
            'product_name'      => 'Disco duro 500GB',
            'product_price'     => 3000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 6,
            'product_id'        => 36,
            'product_name'      => 'DELL Monitor',
            'product_price'     => 8000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 6,
            'product_id'        => 9,
            'product_name'      => 'PC Gamer',
            'product_price'     => 2000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 7,
            'product_id'        => 39,
            'product_name'      => 'Hard Disk 500GB',
            'product_price'     => 1000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 7,
            'product_id'        => 49,
            'product_name'      => 'Xbox one microfono',
            'product_price'     => 1000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 7,
            'product_id'        => 3,
            'product_name'      => 'Disco duro 500GB',
            'product_price'     => 3000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 7,
            'product_id'        => 9,
            'product_name'      => 'PC Gamer',
            'product_price'     => 2000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 7,
            'product_id'        => 29,
            'product_name'      => 'Blacberry 32GB',
            'product_price'     => 5000,
            'amount'            => 1
        ]);
        DB::table('customer_histories')->insert([
            'sale_id'           => 8,
            'product_id'        => 1,
            'product_name'      => 'Xbox One - Turtle Beach X-40 Headset',
            'product_price'     => 10000,
            'amount'            => 1
        ]);


    }
}
