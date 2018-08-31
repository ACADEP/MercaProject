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
            'path'=>'images/videoGames/PS4_Uncharted4_4.jpg',
            'thumbnail_path'=>'images/videoGames/PS4_Uncharted4_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 17,
            'name'       =>  'imagen22',
            'path'=>'images/videogames/PS4_Controller_Black_1.jpg',
            'thumbnail_path'=>'images/videogames/PS4_Controller_Black_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 18,
            'name'       =>  'imagen23',
            'path'=>'images/videogames/XboxOne_Halo5_1.jpg',
            'thumbnail_path'=>'images/videogames/XboxOne_Halo5_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 19,
            'name'       =>  'imagen24',
            'path'=>'images/videogames/XboxOne_Controller_Black_1.jpg',
            'thumbnail_path'=>'images/videogames/XboxOne_Controller_Black_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 20,
            'name'       =>  'imagen25',
            'path'=>'images/videogames/PC_Fallout_4.jpg',
            'thumbnail_path'=>'images/videogames/PC_Fallout_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 21,
            'name'       =>  'imagen26',
            'path'=>'images/videoGames/XboxOne_TomClancy_1.jpg',
            'thumbnail_path'=>'images/videoGames/XboxOne_TomClancy_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 22,
            'name'       =>  'imagen27',
            'path'=>'images/TV/LG_OLED_55_2.jpg',
            'thumbnail_path'=>'images/TV/LG_OLED_55_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 23,
            'name'       =>  'imagen28',
            'path'=>'images/TV/Sony_4k_55_2.jpg',
            'thumbnail_path'=>'images/TV/Sony_4k_55_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 24,
            'name'       =>  'imagen29',
            'path'=>'images/TV/Samsung_Smart_48_3.jpg',
            'thumbnail_path'=>'images/TV/Samsung_Smart_48_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 25,
            'name'       =>  'imagen30',
            'path'=>'images/TV/LG_LED_TV_2.jpg',
            'thumbnail_path'=>'images/TV/LG_LED_TV_2.jpg',
            'featured'=>1
        ]);
        
        DB::table('product_images')->insert([
            'product_id' => 26,
            'name'       =>  'imagen31',
            'path'=>'images/TV/LG_Curved_55_2.jpg',
            'thumbnail_path'=>'images/TV/LG_Curved_55_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 27,
            'name'       =>  'imagen32',
            'path'=>'images/TV/Samsung_4k_50_2.jpg',
            'thumbnail_path'=>'images/TV/Samsung_4k_50_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 28,
            'name'       =>  'imagen33',
            'path'=>'images/phones/iPhone_6_16GB_2.jpg',
            'thumbnail_path'=>'images/phones/iPhone_6_16GB_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 29,
            'name'       =>  'imagen34',
            'path'=>'images/phones/Blacberry_32GB_1.jpg',
            'thumbnail_path'=>'images/phones/Blacberry_32GB_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 30,
            'name'       =>  'imagen35',
            'path'=>'images/phones/Samsung_Galaxy_Edge_16GB_1.jpg',
            'thumbnail_path'=>'images/phones/Samsung_Galaxy_Edge_16GB_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 31,
            'name'       =>  'imagen36',
            'path'=>'images/computer/Apple_MacBook_Pro_15_1.jpg',
            'thumbnail_path'=>'images/computer/Apple_MacBook_Pro_15_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 32,
            'name'       =>  'imagen37',
            'path'=>'images/computer/Apple-iPadAir_2.jpg',
            'thumbnail_path'=>'images/computer/Apple-iPadAir_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 33,
            'name'       =>  'imagen38',
            'path'=>'images/computer/ASUS_15.6_Laptop_1.jpg',
            'thumbnail_path'=>'images/computer/ASUS_15.6_Laptop_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 34,
            'name'       =>  'imagen39',
            'path'=>'images/computer/CyberPower_GamerUltra_PC_2.jpg',
            'thumbnail_path'=>'images/computer/CyberPower_GamerUltra_PC_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 35,
            'name'       =>  'imagen40',
            'path'=>'images/computer/DELL_Inspirion_Deskop_2.jpg',
            'thumbnail_path'=>'images/computer/DELL_Inspirion_Deskop_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 35,
            'name'       =>  'imagen41',
            'path'=>'images/computer/DELL_Monitor_23-2.jpg',
            'thumbnail_path'=>'images/computer/DELL_Monitor_23-2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 36,
            'name'       =>  'imagen42',
            'path'=>'images/computer/DELL_XPS_Desktop_4.jpg',
            'thumbnail_path'=>'images/computer/DELL_XPS_Desktop_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 37,
            'name'       =>  'imagen43',
            'path'=>'images/computer/HP_Pavilion_23_1.jpeg',
            'thumbnail_path'=>'images/computer/HP_Pavilion_23_1.jpeg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 38,
            'name'       =>  'imagen44',
            'path'=>'images/computer/HD2.jpg',
            'thumbnail_path'=>'images/computer/HD2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 39,
            'name'       =>  'imagen45',
            'path'=>'images/computer/mouse1.jpg',
            'thumbnail_path'=>'images/computer/mouse1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 40,
            'name'       =>  'imagen46',
            'path'=>'images/audio/Beats_Solo_2_Earphones_Red_2.jpg',
            'thumbnail_path'=>'audio/phones/Beats_Solo_2_Earphones_Red_2.jpg',
            'featured'=>1
        ]);
        
        DB::table('product_images')->insert([
            'product_id' => 41,
            'name'       =>  'imagen47',
            'path'=>'images/audio/Astro_a40_Wired_PS4_2.jpg',
            'thumbnail_path'=>'images/audio/Astro_a40_Wired_PS4_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 42,
            'name'       =>  'imagen48',
            'path'=>'images/audio/Astro_headset_xbox_one_1.jpg',
            'thumbnail_path'=>'images/audio/Astro_headset_xbox_one_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 43,
            'name'       =>  'imagen49',
            'path'=>'images/audio/Beats_Solo_2_PowerBeats_Earphones_1.jpg',
            'thumbnail_path'=>'images/audio/Beats_Solo_2_PowerBeats_Earphones_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 44,
            'name'       =>  'imagen50',
            'path'=>'images/audio/Bose_QuietComfort_Headphones_4.jpg',
            'thumbnail_path'=>'images/audio/Bose_QuietComfort_Headphones_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 45,
            'name'       =>  'imagen51',
            'path'=>'images/audio/PS4_Headset.jpg',
            'thumbnail_path'=>'images/audio/PS4_Headset.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 46,
            'name'       =>  'imagen52',
            'path'=>'images/audio/Turtle_Beach_XO-7_Headset_2.jpg',
            'thumbnail_path'=>'images/audio/Turtle_Beach_XO-7_Headset_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 47,
            'name'       =>  'imagen53',
            'path'=>'images/audio/turtle_beaches_star_wars_1.jpg',
            'thumbnail_path'=>'images/audio/turtle_beaches_star_wars_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 48,
            'name'       =>  'imagen54',
            'path'=>'images/audio/Xbox_one_mic.jpg',
            'thumbnail_path'=>'images/audio/Xbox_one_mic.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 49,
            'name'       =>  'imagen55',
            'path'=>'images/cameras/Canon_Digital_DSLR_Camera_1.jpg',
            'thumbnail_path'=>'images/cameras/Canon_Digital_DSLR_Camera_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 50,
            'name'       =>  'imagen56',
            'path'=>'images/cameras/Canon_PointandShoot_Camera_2.jpg',
            'thumbnail_path'=>'images/cameras/Canon_PointandShoot_Camera_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 51,
            'name'       =>  'imagen57',
            'path'=>'images/cameras/GoPro-Hero4-Black_Camera_1.jpg',
            'thumbnail_path'=>'images/cameras/GoPro-Hero4-Black_Camera_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 52,
            'name'       =>  'imagen58',
            'path'=>'images/cameras/Nikon_DSLR_Camera_2.jpg',
            'thumbnail_path'=>'images/cameras/Nikon_DSLR_Camera_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 53,
            'name'       =>  'imagen59',
            'path'=>'images/cameras/Sony_Alpha_Mirrorless_Camera_4.jpg',
            'thumbnail_path'=>'images/cameras/Sony_Alpha_Mirrorless_Camera_4.jpg',
            'featured'=>1
        ]);


    }
}
