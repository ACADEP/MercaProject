<?php

use Illuminate\Database\Seeder;

class BrandTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'Brand_name' => 'HP',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Epson',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Microsoft',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Seagate',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Logitech',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Samsung',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Sony',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Dell',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Acer',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Kodack',
        ]);

    }
}
