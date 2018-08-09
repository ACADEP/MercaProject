<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_name' => 'Xbox One - Turtle Beach X-40 Headset',
            'product_qty'        =>  30,
            'product_sku' => 1,
            'price'=> 10000,
            'reduced_price'=>1000,
            'cat_id'=>2,
            'brand_id'=>2,
            'featured'=>1,
            'description'=>'Consola xbox de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Camara digital',
            'product_qty'        =>  30,
            'product_sku' => 2,
            'price'=> 5000,
            'reduced_price'=>1000,
            'cat_id'=>6,
            'brand_id'=>10,
            'featured'=>1,
            'description'=>'Camara de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Disco duro 500GB',
            'product_qty'        =>  30,
            'product_sku' => 3,
            'price'=> 3000,
            'reduced_price'=>500,
            'cat_id'=>5,
            'brand_id'=>4,
            'featured'=>1,
            'description'=>'Disco duro de estado solido'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Mouse Optico',
            'product_qty'        =>  30,
            'product_sku' => 4,
            'price'=> 200,
            'reduced_price'=>100,
            'cat_id'=>4,
            'brand_id'=>5,
            'featured'=>1,
            'description'=>'Mouse optico de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Television LCD',
            'product_qty'        =>  30,
            'product_sku' => 5,
            'price'=> 10000,
            'reduced_price'=>1000,
            'cat_id'=>10,
            'brand_id'=>6,
            'featured'=>1,
            'description'=>'Televison LCD para la sala'
        ]);

        // Nuevos productos
        DB::table('products')->insert([
            'product_name' => 'Television Curved',
            'product_qty'        =>  10,
            'product_sku' => 6,
            'price'=> 10000,
            'reduced_price'=>0,
            'cat_id'=>10,
            'brand_id'=>6,
            'featured'=>0,
            'description'=>'Televison de ultima generacion LCD para la sala'
        ]);

        DB::table('products')->insert([
            'product_name' => 'PS4 SLIM',
            'product_qty'        =>  15,
            'product_sku' => 7,
            'price'=> 10000,
            'reduced_price'=>0,
            'cat_id'=>2,
            'brand_id'=>7,
            'featured'=>0,
            'description'=>'Consola PS4 de ultima generacion'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Camara para fotografo',
            'product_qty' =>  5,
            'product_sku' => 8,
            'price'=> 5000,
            'reduced_price'=>0,
            'cat_id'=>6,
            'brand_id'=>10,
            'featured'=>0,
            'description'=>'Camara de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'PC Gamer',
            'product_qty'        =>  5,
            'product_sku' => 9,
            'price'=> 20000,
            'reduced_price'=>0,
            'cat_id'=>1,
            'brand_id'=>3,
            'featured'=>0,
            'description'=>'Computadora para tus juegos favoritos'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Smartphone',
            'product_qty'        =>  5,
            'product_sku' => 10,
            'price'=> 5000,
            'reduced_price'=>0,
            'cat_id'=>11,
            'brand_id'=>7,
            'featured'=>0,
            'description'=>'Celular inteligente'
        ]);



        

        

    }
}
