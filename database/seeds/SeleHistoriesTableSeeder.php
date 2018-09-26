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
            'user_id'       => 7,
            'product_id'    => 1,
            'client'        => 'Jonatan',
            'date'          => Carbon::now()->subDay(2),
            'amount'        =>2,
            'total'         => 20000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 7,
            'product_id'    => 2,
            'client'        => 'Manuel',
            'date'          => Carbon::now()->subDay(5),
            'amount'        =>5,
            'total'         => 25000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 7,
            'product_id'    => 3,
            'client'        => 'Jose Luis',
            'date'          => Carbon::now()->subDay(7),
            'amount'        =>4,
            'total'         => 12000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 7,
            'product_id'    => 4,
            'client'        => 'Sebastian',
            'date'          => Carbon::now()->subDay(6),
            'amount'        =>3,
            'total'         => 600
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 7,
            'product_id'    => 5,
            'client'        => 'Alejandra',
            'date'          => Carbon::now()->subDay(3),
            'amount'        =>1,
            'total'         => 10000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 7,
            'product_id'    => 4,
            'client'        => 'Roberto',
            'date'          => Carbon::now()->subDay(9),
            'amount'        =>1,
            'total'         => 100
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 7,
            'product_id'    => 5,
            'client'        => 'Hector',
            'date'          => Carbon::now()->subDay(13),
            'amount'        =>1,
            'total'         => 10000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 7,
            'product_id'    => 6,
            'client'        => 'Yoselin',
            'date'          => Carbon::now()->subDay(15),
            'amount'        =>1,
            'total'         => 10000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 7,
            'product_id'    => 7,
            'client'        => 'Gonzalo',
            'date'          => Carbon::now(),
            'amount'        =>1,
            'total'         => 10000
        ]);
        DB::table('sele_histories')->insert([
            'user_id'       => 7,
            'product_id'    => 8,
            'client'        => 'Karla',
            'date'          => Carbon::now()->subDay(23),
            'amount'        =>1,
            'total'         => 5000
        ]);
        
    }
}
