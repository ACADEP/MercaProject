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
            'banner'        => 'imagen1',
            'path'          => '/images/Brands/hp_logo.png',
            'thumbnail_path'=> '/images/Brands/hp_logo.png',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Epson',
            'banner'        => 'imagen2',
            'path'          => '/images/Brands/epson_logo.png',
            'thumbnail_path'=> '/images/Brands/epson_logo.png',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Microsoft',
            'banner'        => 'imagen3',
            'path'          => '/images/Brands/microsoft_logo.png',
            'thumbnail_path'=> '/images/Brands/microsoft_logo.png',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Seagate',
            'banner'        => 'imagen4',
            'path'          => '/images/Brands/Seagate_logo.png',
            'thumbnail_path'=> '/images/Brands/Seagate_logo.png',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Logitech',
            'banner'        => 'imagen5',
            'path'          => '/images/Brands/Logitech_logo.png',
            'thumbnail_path'=> '/images/Brands/Logitech_logo.png',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Samsung',
            'banner'        => 'imagen6',
            'path'          => '/images/Brands/Samsung_logo.png',
            'thumbnail_path'=> '/images/Brands/Samsung_logo.png',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Sony',
            'banner'        => 'imagen7',
            'path'          => '/images/Brands/Sony_logo2.jpg',
            'thumbnail_path'=> '/images/Brands/Sony_logo2.jpg',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Dell',
            'banner'        => 'imagen8',
            'path'          => '/images/Brands/Dell_logo.png',
            'thumbnail_path'=> '/images/Brands/Dell_logo.png',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Acer',
            'banner'        => 'imagen9',
            'path'          => '/images/Brands/Acer_logo.jpg',
            'thumbnail_path'=> '/images/Brands/Acer_logo.jpg',
        ]);

        DB::table('brands')->insert([
            'Brand_name' => 'Kodack',
            'banner'        => 'imagen10',
            'path'          => '/images/Brands/Kodack_logo.png',
            'thumbnail_path'=> '/images/Brands/Kodack_logo.png',
        ]);

    }
}
