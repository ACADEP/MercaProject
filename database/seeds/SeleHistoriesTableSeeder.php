<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SeleHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sele_histories')->insert([
            'user_id'       => 1,
            'sale_id'       => 1,
            'product_id'    => 4,
            'client'        => 'John',
            'date'          => Carbon::now()->subDay(2),
            'amount'        =>1,
            'total'         => 200
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 1,
            'sale_id'       => 1,
            'product_id'    => 39,
            'client'        => 'John',
            'date'          => Carbon::now()->subDay(5),
            'amount'        =>1,
            'total'         => 1000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 2,
            'product_id'    => 40,
            'client'        => 'samula4544',
            'date'          => '2018-10-03',
            'amount'        =>1,
            'total'         => 500
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 2,
            'product_id'    => 9,
            'client'        => 'samula4544',
            'date'          => '2018-10-03',
            'amount'        =>1,
            'total'         => 2000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 2,
            'product_id'    => 46,
            'client'        => 'samula4544',
            'date'          => '2018-10-03',
            'amount'        =>1,
            'total'         => 2500
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 2,
            'product_id'    => 3,
            'client'        => 'samula4544',
            'date'          => '2018-10-03',
            'amount'        =>1,
            'total'         => 3000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 3,
            'product_id'    => 17,
            'client'        => 'jonces',
            'date'          => '2018-11-03',
            'amount'        =>1,
            'total'         => 1000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 3,
            'product_id'    => 21,
            'client'        => 'jonces',
            'date'          => '2018-11-03',
            'amount'        =>1,
            'total'         => 1000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 3,
            'product_id'    => 20,
            'client'        => 'jonces',
            'date'          => '2018-11-03',
            'amount'        =>1,
            'total'         => 5000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 4,
            'product_id'    => 4,
            'client'        => 'Luis_Bernardo',
            'date'          => '2018-12-03',
            'amount'        =>1,
            'total'         => 200
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 4,
            'product_id'    => 40,
            'client'        => 'Luis_Bernardo',
            'date'          => '2018-12-03',
            'amount'        =>1,
            'total'         => 500
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 6,
            'sale_id'       => 4,
            'product_id'    => 49,
            'client'        => 'Luis_Bernardo',
            'date'          => '2018-12-03',
            'amount'        =>1,
            'total'         => 1000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 1,
            'sale_id'       => 5,
            'product_id'    => 40,
            'client'        => 'John',
            'date'          => Carbon::now()->subDay(2),
            'amount'        =>1,
            'total'         => 500
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 1,
            'sale_id'       => 5,
            'product_id'    => 3,
            'client'        => 'John',
            'date'          => Carbon::now()->subDay(2),
            'amount'        =>1,
            'total'         => 3000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 5,
            'sale_id'       => 6,
            'product_id'    => 36,
            'client'        => 'samula4544',
            'date'          => '2018-10-03',
            'amount'        =>1,
            'total'         => 8000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 5,
            'sale_id'       => 6,
            'product_id'    => 9,
            'client'        => 'samula4544',
            'date'          => '2018-10-03',
            'amount'        =>1,
            'total'         => 2000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 5,
            'sale_id'       => 7,
            'product_id'    => 39,
            'client'        => 'jonces',
            'date'          => '2018-11-03',
            'amount'        =>1,
            'total'         => 1000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 5,
            'sale_id'       => 7,
            'product_id'    => 49,
            'client'        => 'jonces',
            'date'          => '2018-11-03',
            'amount'        =>1,
            'total'         => 1000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 5,
            'sale_id'       => 7,
            'product_id'    => 3,
            'client'        => 'jonces',
            'date'          => '2018-11-03',
            'amount'        =>1,
            'total'         => 3000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 5,
            'sale_id'       => 7,
            'product_id'    => 9,
            'client'        => 'jonces',
            'date'          => '2018-11-03',
            'amount'        =>1,
            'total'         => 2000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 5,
            'sale_id'       => 7,
            'product_id'    => 29,
            'client'        => 'jonces',
            'date'          => '2018-11-03',
            'amount'        =>1,
            'total'         => 5000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 5,
            'sale_id'       => 8,
            'product_id'    => 1,
            'client'        => 'Luis_Bernardo',
            'date'          => '2018-12-03',
            'amount'        =>1,
            'total'         => 10000
        ]);


    }
}
