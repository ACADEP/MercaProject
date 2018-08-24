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

        /* -------*/
        DB::table('product_images')->insert([
            'product_id' => 11,
            'name'       =>  'imagen16',
            'path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'thumbnail_path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 12,
            'name'       =>  'imagen17',
            'path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'thumbnail_path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 13,
            'name'       =>  'imagen18',
            'path'=>'images/computer/laptop_hp_500_gb.jpg',
            'thumbnail_path'=>'images/computer/laptop_hp_500_gb.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 14,
            'name'       =>  'imagen19',
            'path'=>'images/phones/xperia_z5.jpg',
            'thumbnail_path'=>'images/phones/xperia_z5.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 15,
            'name'       =>  'imagen20',
            'path'=>'images/audio/bocina_philips.jpg',
            'thumbnail_path'=>'images/audio/bocina_philips.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 16,
            'name'       =>  'imagen21',
            'path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'thumbnail_path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 17,
            'name'       =>  'imagen22',
            'path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'thumbnail_path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 18,
            'name'       =>  'imagen23',
            'path'=>'images/computer/laptop_hp_500_gb.jpg',
            'thumbnail_path'=>'images/computer/laptop_hp_500_gb.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 19,
            'name'       =>  'imagen24',
            'path'=>'images/phones/xperia_z5.jpg',
            'thumbnail_path'=>'images/phones/xperia_z5.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 20,
            'name'       =>  'imagen25',
            'path'=>'images/audio/bocina_philips.jpg',
            'thumbnail_path'=>'images/audio/bocina_philips.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 21,
            'name'       =>  'imagen26',
            'path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'thumbnail_path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 22,
            'name'       =>  'imagen27',
            'path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'thumbnail_path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 23,
            'name'       =>  'imagen28',
            'path'=>'images/computer/laptop_hp_500_gb.jpg',
            'thumbnail_path'=>'images/computer/laptop_hp_500_gb.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 24,
            'name'       =>  'imagen29',
            'path'=>'images/phones/xperia_z5.jpg',
            'thumbnail_path'=>'images/phones/xperia_z5.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 25,
            'name'       =>  'imagen30',
            'path'=>'images/audio/bocina_philips.jpg',
            'thumbnail_path'=>'images/audio/bocina_philips.jpg',
            'featured'=>1
        ]);
        
        DB::table('product_images')->insert([
            'product_id' => 26,
            'name'       =>  'imagen31',
            'path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'thumbnail_path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 27,
            'name'       =>  'imagen32',
            'path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'thumbnail_path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 28,
            'name'       =>  'imagen33',
            'path'=>'images/computer/laptop_hp_500_gb.jpg',
            'thumbnail_path'=>'images/computer/laptop_hp_500_gb.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 29,
            'name'       =>  'imagen34',
            'path'=>'images/phones/xperia_z5.jpg',
            'thumbnail_path'=>'images/phones/xperia_z5.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 30,
            'name'       =>  'imagen35',
            'path'=>'images/audio/bocina_philips.jpg',
            'thumbnail_path'=>'images/audio/bocina_philips.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 31,
            'name'       =>  'imagen36',
            'path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'thumbnail_path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 32,
            'name'       =>  'imagen37',
            'path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'thumbnail_path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 33,
            'name'       =>  'imagen38',
            'path'=>'images/computer/laptop_hp_500_gb.jpg',
            'thumbnail_path'=>'images/computer/laptop_hp_500_gb.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 34,
            'name'       =>  'imagen39',
            'path'=>'images/phones/xperia_z5.jpg',
            'thumbnail_path'=>'images/phones/xperia_z5.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 35,
            'name'       =>  'imagen40',
            'path'=>'images/computer/laptop_hp_500_gb.jpg',
            'thumbnail_path'=>'images/computer/laptop_hp_500_gb.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 35,
            'name'       =>  'imagen41',
            'path'=>'images/phones/xperia_z5.jpg',
            'thumbnail_path'=>'images/phones/xperia_z5.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 36,
            'name'       =>  'imagen42',
            'path'=>'images/audio/bocina_philips.jpg',
            'thumbnail_path'=>'images/audio/bocina_philips.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 37,
            'name'       =>  'imagen43',
            'path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'thumbnail_path'=>'images/videoGames/xbox_360_halo_4.jpeg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 38,
            'name'       =>  'imagen44',
            'path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'thumbnail_path'=>'images/videogames/ps4_god_of_war_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 39,
            'name'       =>  'imagen45',
            'path'=>'images/computer/laptop_hp_500_gb.jpg',
            'thumbnail_path'=>'images/computer/laptop_hp_500_gb.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 40,
            'name'       =>  'imagen46',
            'path'=>'images/phones/xperia_z5.jpg',
            'thumbnail_path'=>'images/phones/xperia_z5.jpg',
            'featured'=>1
        ]);
        
        DB::table('product_images')->insert([
            'product_id' => 41,
            'name'       =>  'imagen47',
            'path'=>'images/computer/laptop_hp_500_gb.jpg',
            'thumbnail_path'=>'images/computer/laptop_hp_500_gb.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 42,
            'name'       =>  'imagen48',
            'path'=>'images/phones/xperia_z5.jpg',
            'thumbnail_path'=>'images/phones/xperia_z5.jpg',
            'featured'=>1
        ]);


    }
}
