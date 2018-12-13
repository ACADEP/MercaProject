<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            'name'          => 'Mercadata',
            'banner'        => 'imagen1',
            'path'          => '/images/Shops/mercadata.png',
            'thumbnail_path'=> '/images/Shops/mercadata.png',
        ]);

        DB::table('shops')->insert([
            'name'          => 'Apple',
            'banner'        => 'imagen2',
            'path'          => '/images/Shops/apple_store.jpeg',
            'thumbnail_path'=> '/images/Shops/apple_store.jpeg',
        ]);
        
        DB::table('shops')->insert([
            'name'          => 'Microsoft',
            'banner'        => 'imagen3',
            'path'          => '/images/Shops/microsoft.png',
            'thumbnail_path'=> '/images/Shops/microsoft.png',
        ]);

        // DB::table('shops')->insert([
        //     'name'          => 'Microsistemas Californianos',
        //     'banner'        => 'imagen4',
        //     'path'          => '/images/Shops/microsistemas_californianos.png',
        //     'thumbnail_path'=> '/images/Shops/microsistemas_californianos.png',
        // ]);

        // DB::table('shops')->insert([
        //     'name'          => 'Pc Green',
        //     'banner'        => 'imagen5',
        //     'path'          => '/images/Shops/pc_green.png',
        //     'thumbnail_path'=> '/images/Shops/pc_green.png',
        // ]);

        // DB::table('shops')->insert([
        //     'name'          => 'Todo Pc',
        //     'banner'        => 'imagen6',
        //     'path'          => '/images/Shops/todo_pc.png',
        //     'thumbnail_path'=> '/images/Shops/todo_pc.png',
        // ]);

        // DB::table('shops')->insert([
        //     'name'          => 'Exacto',
        //     'banner'        => 'imagen7',
        //     'path'          => '/images/Shops/exacto.jpg',
        //     'thumbnail_path'=> '/images/Shops/exacto.jpg',
        // ]);

        DB::table('shops')->insert([
            'name'          => 'Lenovo',
            'banner'        => 'imagen4',
            'path'          => '/images/Shops/lenovo.png',
            'thumbnail_path'=> '/images/Shops/lenovo.png',
        ]);

        DB::table('shops')->insert([
            'name'          => 'Hp',
            'banner'        => 'imagen5',
            'path'          => '/images/Shops/hp_logo2.png',
            'thumbnail_path'=> '/images/Shops/hp_logo2.png',
        ]);

        DB::table('shops')->insert([
            'name'          => 'Acer',
            'banner'        => 'imagen6',
            'path'          => '/images/Shops/acer.png',
            'thumbnail_path'=> '/images/Shops/acer.png',
        ]);

        DB::table('shops')->insert([
            'name'          => 'Samsung',
            'banner'        => 'imagen7',
            'path'          => '/images/Shops/Samsung_logo.png',
            'thumbnail_path'=> '/images/Shops/Samsung_logo.png',
        ]);


    }
}
