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
            'name'          => 'Apple',
            'banner'        => 'imagen1',
            'path'          => 'images/shops/apple_store.jpeg',
            'thumbnail_path'=> 'images/shops/apple_store.jpeg',
        ]);
        
        DB::table('shops')->insert([
            'name'          => 'Microsoft',
            'banner'        => 'imagen2',
            'path'          => 'images/shops/microsoft.png',
            'thumbnail_path'=> 'images/shops/microsoft.png',
        ]);

        DB::table('shops')->insert([
            'name'          => 'Microsistemas Californianos',
            'banner'        => 'imagen3',
            'path'          => 'images/shops/microsistemas_californianos.png',
            'thumbnail_path'=> 'images/shops/microsistemas_californianos.png',
        ]);

        DB::table('shops')->insert([
            'name'          => 'Pc Green',
            'banner'        => 'imagen4',
            'path'          => 'images/shops/pc_green.png',
            'thumbnail_path'=> 'images/shops/pc_green.png',
        ]);

        DB::table('shops')->insert([
            'name'          => 'Todo Pc',
            'banner'        => 'imagen5',
            'path'          => 'images/shops/todo_pc.png',
            'thumbnail_path'=> 'images/shops/todo_pc.png',
        ]);

        DB::table('shops')->insert([
            'name'          => 'Exacto',
            'banner'        => 'imagen6',
            'path'          => 'images/shops/exacto.png',
            'thumbnail_path'=> 'images/shops/exacto.png',
        ]);

    }
}
