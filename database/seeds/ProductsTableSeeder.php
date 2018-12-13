<?php

use Carbon\Carbon;
use App\Product;
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
            'product_qty' =>  30,
            'product_sku' => 1,
            'price'=> 10000,
            'reduced_price'=>1000,
            'shop_id'=>1,
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
            'shop_id'=>1,
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
            'shop_id'=>1,
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
            'shop_id'=>1,
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
            'reduced_price'=>2000,
            'shop_id'=>1,
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
            'shop_id'=>1,
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
            'shop_id'=>1,
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
            'shop_id'=>1,
            'cat_id'=>6,
            'brand_id'=>10,
            'featured'=>0,
            'description'=>'Camara de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'PC Gamer',
            'product_qty'        =>  5,
            'product_sku' => 9,
            'price'=> 2000,
            'reduced_price'=>0,
            'shop_id'=>1,
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
            'shop_id'=>1,
            'cat_id'=>11,
            'brand_id'=>7,
            'featured'=>0,
            'description'=>'Celular inteligente'
        ]);
        
        DB::table('products')->insert([
            'product_name' => 'Xbox 360 - Halo 4',
            'product_qty'        =>  30,
            'product_sku' => 11,
            'price'=> 1000,
            'reduced_price'=>800,
            'shop_id'=>2,
            'cat_id'=>2,
            'brand_id'=>3,
            'featured'=>1,
            'description'=>'Consola xbox de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Ps4 God of war 4',
            'product_qty'        =>  30,
            'product_sku' => 12,
            'price'=> 8000,
            'reduced_price'=>3000,
            'shop_id'=>2,
            'cat_id'=>2,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Consola ps4 de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Laptop Hp 500 Gb Ram 4 Gb',
            'product_qty'        =>  30,
            'product_sku' => 13,
            'price'=> 10000,
            'reduced_price'=>4000,
            'shop_id'=>2,
            'cat_id'=>1,
            'brand_id'=>1,
            'featured'=>1,
            'description'=>'Laptop hp de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Xperia Z5',
            'product_qty'        =>  30,
            'product_sku' => 14,
            'price'=> 10000,
            'reduced_price'=>1200,
            'shop_id'=>2,
            'cat_id'=>11,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Smartphone de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Bocinas Philis',
            'product_qty'        =>  30,
            'product_sku' => 15,
            'price'=> 10000,
            'reduced_price'=>3000,
            'shop_id'=>2,
            'cat_id'=>8,
            'brand_id'=>6,
            'featured'=>1,
            'description'=>'Bocinas de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'PS4 Uncharted',
            'product_qty'        =>  30,
            'product_sku' => 16,
            'price'=> 9000,
            'reduced_price'=>1000,
            'shop_id'=>2,
            'cat_id'=>2,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Consola ps4 de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'PS4 Controller Black',
            'product_qty'        =>  30,
            'product_sku' => 17,
            'price'=> 1000,
            'reduced_price'=>100,
            'shop_id'=>2,
            'cat_id'=>4,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Control ps4 de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Halo 5',
            'product_qty'        =>  30,
            'product_sku' => 18,
            'price'=> 10000,
            'reduced_price'=>2000,
            'shop_id'=>2,
            'cat_id'=>2,
            'brand_id'=>3,
            'featured'=>1,
            'description'=>'Juego hp de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Xbox One Control',
            'product_qty'        =>  30,
            'product_sku' => 19,
            'price'=> 10000,
            'reduced_price'=>3000,
            'shop_id'=>2,
            'cat_id'=>4,
            'brand_id'=>3,
            'featured'=>1,
            'description'=>'Control de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'PC Fallout 4',
            'product_qty'        =>  30,
            'product_sku' => 20,
            'price'=> 5000,
            'reduced_price'=>1000,
            'shop_id'=>2,
            'cat_id'=>2,
            'brand_id'=>3,
            'featured'=>1,
            'description'=>'Juego de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Tom Clancy',
            'product_qty'        =>  30,
            'product_sku' => 21,
            'price'=> 1000,
            'reduced_price'=>100,
            'shop_id'=>3,
            'cat_id'=>2,
            'brand_id'=>3,
            'featured'=>1,
            'description'=>'Juego de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Tv LG Oled',
            'product_qty'        =>  30,
            'product_sku' => 22,
            'price'=> 10000,
            'reduced_price'=>1000,
            'shop_id'=>3,
            'cat_id'=>10,
            'brand_id'=>6,
            'featured'=>1,
            'description'=>'Tv de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Sony 4K',
            'product_qty'        =>  30,
            'product_sku' => 23,
            'price'=> 11000,
            'reduced_price'=>1000,
            'shop_id'=>3,
            'cat_id'=>10,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Tv de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Samsung Smart Tv',
            'product_qty'        =>  30,
            'product_sku' => 24,
            'price'=> 13000,
            'reduced_price'=>1000,
            'shop_id'=>3,
            'cat_id'=>10,
            'brand_id'=>6,
            'featured'=>1,
            'description'=>'Tv de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Tv LG Led',
            'product_qty'        =>  30,
            'product_sku' => 25,
            'price'=> 8000,
            'reduced_price'=>1000,
            'shop_id'=>3,
            'cat_id'=>10,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Tv de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Tv LG Curved',
            'product_qty'        =>  30,
            'product_sku' => 26,
            'price'=> 15000,
            'reduced_price'=>2000,
            'shop_id'=>3,
            'cat_id'=>10,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Tv de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Samsung 4K',
            'product_qty'        =>  30,
            'product_sku' => 27,
            'price'=> 15000,
            'reduced_price'=>2000,
            'shop_id'=>3,
            'cat_id'=>10,
            'brand_id'=>6,
            'featured'=>1,
            'description'=>'Tv de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'iPhone 6 16 GB',
            'product_qty'        =>  30,
            'product_sku' => 28,
            'price'=> 16000,
            'reduced_price'=>3000,
            'shop_id'=>3,
            'cat_id'=>11,
            'brand_id'=>9,
            'featured'=>1,
            'description'=>'iPhone 6 de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Blacberry 32GB',
            'product_qty'        =>  30,
            'product_sku' => 29,
            'price'=> 5000,
            'reduced_price'=>1000,
            'shop_id'=>4,
            'cat_id'=>11,
            'brand_id'=>5,
            'featured'=>1,
            'description'=>'Blacberry 32GB de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Samsung Galaxy Edge 16GB',
            'product_qty'        =>  30,
            'product_sku' => 30,
            'price'=> 12000,
            'reduced_price'=>3000,
            'shop_id'=>4,
            'cat_id'=>11,
            'brand_id'=>6,
            'featured'=>1,
            'description'=>'Samsung Galaxy de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Apple MacBook Pro',
            'product_qty'        =>  30,
            'product_sku' => 31,
            'price'=> 13000,
            'reduced_price'=>4000,
            'shop_id'=>4,
            'cat_id'=>1,
            'brand_id'=>5,
            'featured'=>1,
            'description'=>'MacBook de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Apple iPad Air',
            'product_qty'        =>  30,
            'product_sku' => 32,
            'price'=> 12000,
            'reduced_price'=>3000,
            'shop_id'=>4,
            'cat_id'=>1,
            'brand_id'=>5,
            'featured'=>1,
            'description'=>'iPad de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Laptop Asus',
            'product_qty'        =>  30,
            'product_sku' => 33,
            'price'=> 18000,
            'reduced_price'=>5000,
            'shop_id'=>4,
            'cat_id'=>1,
            'brand_id'=>8,
            'featured'=>1,
            'description'=>'Laptop asus de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'CyberPower Gamer Ultra PC',
            'product_qty'        =>  30,
            'product_sku' => 34,
            'price'=> 17000,
            'reduced_price'=>3500,
            'shop_id'=>4,
            'cat_id'=>1,
            'brand_id'=>5,
            'featured'=>1,
            'description'=>'CyberPower Gamer Ultra PC de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'DELL Inspirion Deskop',
            'product_qty'        =>  30,
            'product_sku' => 35,
            'price'=> 16000,
            'reduced_price'=>2000,
            'shop_id'=>4,
            'cat_id'=>1,
            'brand_id'=>8,
            'featured'=>1,
            'description'=>'Dell de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'DELL Monitor',
            'product_qty'        =>  30,
            'product_sku' => 36,
            'price'=> 8000,
            'reduced_price'=>1000,
            'shop_id'=>5,
            'cat_id'=>1,
            'brand_id'=>8,
            'featured'=>1,
            'description'=>'Dell de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'DELL XPS Desktop',
            'product_qty'        =>  30,
            'product_sku' => 37,
            'price'=> 9000,
            'reduced_price'=>1000,
            'shop_id'=>5,
            'cat_id'=>1,
            'brand_id'=>8,
            'featured'=>1,
            'description'=>'Dell de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'HP Pavilion 23',
            'product_qty'        =>  30,
            'product_sku' => 38,
            'price'=> 14000,
            'reduced_price'=>3000,
            'shop_id'=>5,
            'cat_id'=>1,
            'brand_id'=>1,
            'featured'=>1,
            'description'=>'Hp de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Hard Disk 500GB',
            'product_qty'        =>  30,
            'product_sku' => 39,
            'price'=> 1000,
            'reduced_price'=>200,
            'shop_id'=>5,
            'cat_id'=>5,
            'brand_id'=>4,
            'featured'=>1,
            'description'=>'Hard Disk de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Mouse Logitech',
            'product_qty'        =>  30,
            'product_sku' => 40,
            'price'=> 500,
            'reduced_price'=>100,
            'shop_id'=>5,
            'cat_id'=>4,
            'brand_id'=>5,
            'featured'=>1,
            'description'=>'Mouse de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Beats Earphones Red',
            'product_qty'        =>  30,
            'product_sku' => 41,
            'price'=> 15000,
            'reduced_price'=>3000,
            'shop_id'=>6,
            'cat_id'=>8,
            'brand_id'=>5,
            'featured'=>1,
            'description'=>'Beats de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Astro a40 Wired PS4',
            'product_qty'        =>  30,
            'product_sku' => 42,
            'price'=> 10000,
            'reduced_price'=>1500,
            'shop_id'=>6,
            'cat_id'=>8,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Astro de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Astro headset xbox one',
            'product_qty'        =>  30,
            'product_sku' => 43,
            'price'=> 10000,
            'reduced_price'=>1500,
            'shop_id'=>6,
            'cat_id'=>8,
            'brand_id'=>3,
            'featured'=>1,
            'description'=>'Astro de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Beats PowerBeats Earphones',
            'product_qty'        =>  30,
            'product_sku' => 44,
            'price'=> 12000,
            'reduced_price'=>1500,
            'shop_id'=>6,
            'cat_id'=>8,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Beats de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Bose QuietComfort Headphones',
            'product_qty'        =>  30,
            'product_sku' => 45,
            'price'=> 13000,
            'reduced_price'=>2500,
            'shop_id'=>6,
            'cat_id'=>8,
            'brand_id'=>4,
            'featured'=>1,
            'description'=>'Bose QuietComfort de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'PS4 Headset',
            'product_qty'        =>  30,
            'product_sku' => 46,
            'price'=> 2500,
            'reduced_price'=>1500,
            'shop_id'=>7,
            'cat_id'=>8,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'PS4 Headset de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Turtle Beach XO-7 Headset',
            'product_qty'        =>  30,
            'product_sku' => 47,
            'price'=> 11000,
            'reduced_price'=>900,
            'shop_id'=>7,
            'cat_id'=>8,
            'brand_id'=>2,
            'featured'=>1,
            'description'=>'Turtle Beach de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'turtle beaches star wars',
            'product_qty'        =>  30,
            'product_sku' => 48,
            'price'=> 15000,
            'reduced_price'=>3500,
            'shop_id'=>7,
            'cat_id'=>8,
            'brand_id'=>8,
            'featured'=>1,
            'description'=>'turtle beaches de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Xbox one microfono',
            'product_qty'        =>  30,
            'product_sku' => 49,
            'price'=> 1000,
            'reduced_price'=>700,
            'shop_id'=>7,
            'cat_id'=>8,
            'brand_id'=>3,
            'featured'=>1,
            'description'=>'Xbox one microfono de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Camara Canon Digital DSLR',
            'product_qty'        =>  30,
            'product_sku' => 50,
            'price'=> 5000,
            'reduced_price'=>2000,
            'shop_id'=>7,
            'cat_id'=>6,
            'brand_id'=>5,
            'featured'=>1,
            'description'=>'Camara de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Camara Canon PointandShoot',
            'product_qty'        =>  30,
            'product_sku' => 51,
            'price'=> 7000,
            'reduced_price'=>2500,
            'shop_id'=>7,
            'cat_id'=>6,
            'brand_id'=>8,
            'featured'=>1,
            'description'=>'Camara de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Camara GoPro Hero4 Black',
            'product_qty'        =>  30,
            'product_sku' => 52,
            'price'=> 7000,
            'reduced_price'=>2500,
            'shop_id'=>7,
            'cat_id'=>6,
            'brand_id'=>2,
            'featured'=>1,
            'description'=>'Camara de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Camara Nikon DSLR',
            'product_qty'        =>  30,
            'product_sku' => 53,
            'price'=> 8000,
            'reduced_price'=>1500,
            'shop_id'=>1,
            'cat_id'=>6,
            'brand_id'=>9,
            'featured'=>1,
            'description'=>'Camara de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Camara Sony Alpha Mirrorless',
            'product_qty'        =>  30,
            'product_sku' => 54,
            'price'=> 7000,
            'reduced_price'=>500,
            'shop_id'=>1,
            'cat_id'=>6,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Camara de buena calidad'
        ]);

        /* *************************************************************************************************************** */
        /* *************************************************************************************************************** */
        /* *************************************************************************************************************** */
        /* *************************************************************************************************************** */
        /* *************************************************************************************************************** */

        DB::table('products')->insert([
            'product_name' => 'Ipod Classic',
            'product_qty'        =>  30,
            'product_sku' => 55,
            'price'=> 9000,
            'reduced_price'=>1500,
            'shop_id'=>1,
            'cat_id'=>6,
            'brand_id'=>8,
            'featured'=>1,
            'description'=>'Ipod Classic de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Huawei p20 pro',
            'product_qty'        =>  30,
            'product_sku' => 56,
            'price'=> 17000,
            'reduced_price'=>0,
            'shop_id'=>2,
            'cat_id'=>11,
            'brand_id'=>7,
            'featured'=>0,
            'description'=>'Huawei p20 PRO de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Samsung galaxy note 9',
            'product_qty'        =>  30,
            'product_sku' => 57,
            'price'=> 19000,
            'reduced_price'=>0,
            'shop_id'=>3,
            'cat_id'=>11,
            'brand_id'=>6,
            'featured'=>0,
            'description'=>'Samsung galaxy note 9 de buena calidad'
        ]);
        
        DB::table('products')->insert([
            'product_name' => 'Sony xperia xz2',
            'product_qty'        =>  30,
            'product_sku' => 58,
            'price'=> 17000,
            'reduced_price'=>0,
            'shop_id'=>4,
            'cat_id'=>11,
            'brand_id'=>7,
            'featured'=>0,
            'description'=>'Sony xperia xz2 de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Huawei mate 20 pro',
            'product_qty'        =>  30,
            'product_sku' => 59,
            'price'=> 19000,
            'reduced_price'=>0,
            'shop_id'=>5,
            'cat_id'=>11,
            'brand_id'=>7,
            'featured'=>0,
            'description'=>'Huawei mate 20 pro de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Iphone x',
            'product_qty'        =>  30,
            'product_sku' => 60,
            'price'=> 20000,
            'reduced_price'=>0,
            'shop_id'=>6,
            'cat_id'=>11,
            'brand_id'=>6,
            'featured'=>0,
            'description'=>'Iphone x de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Dell Alienware m15',
            'product_qty'        =>  30,
            'product_sku' => 61,
            'price'=> 22000,
            'reduced_price'=>3500,
            'shop_id'=>7,
            'cat_id'=>1,
            'brand_id'=>8,
            'featured'=>1,
            'description'=>'Dell Alienware m15 de buena calidad'
        ]);
        
        DB::table('products')->insert([
            'product_name' => 'Macbook air 13',
            'product_qty'        =>  30,
            'product_sku' => 62,
            'price'=> 17000,
            'reduced_price'=>500,
            'shop_id'=>1,
            'cat_id'=>1,
            'brand_id'=>4,
            'featured'=>1,
            'description'=>'Macbook air 13 de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Samsung galaxy tab 10',
            'product_qty'        =>  30,
            'product_sku' => 63,
            'price'=> 9000,
            'reduced_price'=>1500,
            'shop_id'=>2,
            'cat_id'=>1,
            'brand_id'=>6,
            'featured'=>1,
            'description'=>'Samsung galaxy tab 10 de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Apple iPad Pro - Tablet',
            'product_qty'        =>  30,
            'product_sku' => 64,
            'price'=> 17000,
            'reduced_price'=>3500,
            'shop_id'=>3,
            'cat_id'=>1,
            'brand_id'=>8,
            'featured'=>1,
            'description'=>'Apple iPad Pro - Tablet de buena calidad'
        ]);

        DB::table('products')->insert([
            'product_name' => 'Acer Nitro 15.6',
            'product_qty'        =>  30,
            'product_sku' => 65,
            'price'=> 12000,
            'reduced_price'=>500,
            'shop_id'=>4,
            'cat_id'=>1,
            'brand_id'=>9,
            'featured'=>1,
            'description'=>'Acer Nitro 15.6 de buena calidad'
        ]);
        
        DB::table('products')->insert([
            'product_name' => 'Asus ROG Zephyrus S Ultra',
            'product_qty'        =>  30,
            'product_sku' => 66,
            'price'=> 19000,
            'reduced_price'=>2500,
            'shop_id'=>5,
            'cat_id'=>1,
            'brand_id'=>6,
            'featured'=>1,
            'description'=>'Asus ROG Zephyrus S Ultra de buena calidad'
        ]);


        $products=Product::all();
        foreach($products as $product)
        {
            $product->company_id=1;
            $product->save();
        }




        DB::table('products')->insert([
            'company_id' => '2',
            'product_name' => 'Nintendo 2DS',
            'product_qty'        =>  30,
            'product_sku' => 67,
            'price'=> 3000,
            'reduced_price'=>500,
            'shop_id'=>6,
            'cat_id'=>2,
            'brand_id'=>1,
            'featured'=>0,
            'description'=>'Camara de buena calidad'
        ]);

        DB::table('products')->insert([
            'company_id' => '2',
            'product_name' => 'Super Smash Bros. - Nintendo 3DS',
            'product_qty'        =>  30,
            'product_sku' => 68,
            'price'=> 900,
            'reduced_price'=>200,
            'shop_id'=>7,
            'cat_id'=>2,
            'brand_id'=>5,
            'featured'=>1,
            'description'=>'Super Smash Bros de buena calidad'
        ]);

        DB::table('products')->insert([
            'company_id' => '2',
            'product_name' => 'Pokémon Ultra Moon - Nintendo 3DS',
            'product_qty'        =>  30,
            'product_sku' => 69,
            'price'=> 800,
            'reduced_price'=>100,
            'shop_id'=>1,
            'cat_id'=>2,
            'brand_id'=>7,
            'featured'=>1,
            'description'=>'Pokémon Ultra Moon de buena calidad'
        ]);
        
        DB::table('products')->insert([
            'company_id' => '2',
            'product_name' => 'Mario Kart 7 - Nintendo 3DS',
            'product_qty'        =>  30,
            'product_sku' => 70,
            'price'=> 500,
            'reduced_price'=>0,
            'shop_id'=>2,
            'cat_id'=>2,
            'brand_id'=>9,
            'featured'=>0,
            'description'=>'Mario Kart 7 de buena calidad'
        ]);



    }
}
