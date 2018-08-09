<?php

use Illuminate\Database\Seeder;

class ProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->insert([
            'product_id' => 1,
            'name'       =>  'imagen1',
            'path'=>'images/videogames/XboxOne_GearsofWarBundle_1.jpg',
            'thumbnail_path'=>'images/videogames/XboxOne_GearsofWarBundle_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 1,
            'name'       =>  'imagen2',
            'path'=>'images/videogames/XboxOne_GearsofWarBundle_1.jpg',
            'thumbnail_path'=>'images/videogames/XboxOne_GearsofWarBundle_1.jpg',
            'featured'=>0
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'name'       =>  'imagen3',
            'path'=>'images/cameras/1.jpg',
            'thumbnail_path'=>'images/cameras/1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'name'       =>  'imagen4',
            'path'=>'images/cameras/2.jpg',
            'thumbnail_path'=>'images/cameras/2.jpg',
            'featured'=>0
        ]);

        DB::table('product_images')->insert([
            'product_id' => 3,
            'name'       =>  'imagen5',
            'path'=>'images/computer/HD1.jpg',
            'thumbnail_path'=>'images/computer/HD1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 3,
            'name'       =>  'imagen6',
            'path'=>'images/computer/HD2.jpg',
            'thumbnail_path'=>'images/computer/HD2.jpg',
            'featured'=>0
        ]);

        DB::table('product_images')->insert([
            'product_id' => 4,
            'name'       =>  'imagen7',
            'path'=>'images/computer/mouse1.jpg',
            'thumbnail_path'=>'images/computer/mouse1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 4,
            'name'       =>  'imagen8',
            'path'=>'images/computer/mouse2.jpg',
            'thumbnail_path'=>'images/computer/mouse2.jpg',
            'featured'=>0
        ]);

        DB::table('product_images')->insert([
            'product_id' => 5,
            'name'       =>  'imagen9',
            'path'=>'images/TV/Samsung_Curved_65_4.jpg',
            'thumbnail_path'=>'images/TV/Samsung_Curved_65_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 5,
            'name'       =>  'imagen10',
            'path'=>'images/TV/Samsung_Curved_65_3.jpg',
            'thumbnail_path'=>'images/TV/Samsung_Curved_65_3.jpg',
            'featured'=>0
        ]);

        //Nuevos productos
        DB::table('product_images')->insert([
            'product_id' => 6,
            'name'       =>  'imagen11',
            'path'=>'images/TV/Samsung_Curved_65_5.jpg',
            'thumbnail_path'=>'images/TV/Samsung_Curved_65_5.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 7,
            'name'       =>  'imagen12',
            'path'=>'images/videogames/PS4_Consolee_Black_1.jpg',
            'thumbnail_path'=>'images/videogames/PS4_Consolee_Black_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 8,
            'name'       =>  'imagen13',
            'path'=>'images/cameras/Canon_Digital_DSLR_Camera_2.jpg',
            'thumbnail_path'=>'images/cameras/Canon_Digital_DSLR_Camera_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 9,
            'name'       =>  'imagen14',
            'path'=>'images/CyberPower_1.jpg',
            'thumbnail_path'=>'images/CyberPower_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 10,
            'name'       =>  'imagen15',
            'path'=>'images/phones/Blacberry_32GB_1.jpg',
            'thumbnail_path'=>'images/phones/Blacberry_32GB_1.jpg',
            'featured'=>1
        ]);

        
    }
}
