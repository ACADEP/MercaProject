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
            'path'=>'/images/VideoGames/XboxOne_GearsofWarBundle_1.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_GearsofWarBundle_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 1,
            'name'       =>  'imagen2',
            'path'=>'/images/VideoGames/XboxOne_GearsofWarBundle_1.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_GearsofWarBundle_1.jpg',
            'featured'=>0
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'name'       =>  'imagen3',
            'path'=>'/images/Cameras/1.jpg',
            'thumbnail_path'=>'/images/Cameras/1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'name'       =>  'imagen4',
            'path'=>'/images/Cameras/2.jpg',
            'thumbnail_path'=>'/images/Cameras/2.jpg',
            'featured'=>0
        ]);

        DB::table('product_images')->insert([
            'product_id' => 3,
            'name'       =>  'imagen5',
            'path'=>'/images/Computer/HD1.jpg',
            'thumbnail_path'=>'/images/Computer/HD1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 3,
            'name'       =>  'imagen6',
            'path'=>'/images/Computer/HD2.jpg',
            'thumbnail_path'=>'/images/Computer/HD2.jpg',
            'featured'=>0
        ]);

        DB::table('product_images')->insert([
            'product_id' => 4,
            'name'       =>  'imagen7',
            'path'=>'/images/Computer/mouse1.jpg',
            'thumbnail_path'=>'/images/Computer/mouse1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 4,
            'name'       =>  'imagen8',
            'path'=>'/images/Computer/mouse2.jpg',
            'thumbnail_path'=>'/images/Computer/mouse2.jpg',
            'featured'=>0
        ]);

        DB::table('product_images')->insert([
            'product_id' => 5,
            'name'       =>  'imagen9',
            'path'=>'/images/TV/Samsung_Curved_65_4.jpg',
            'thumbnail_path'=>'/images/TV/Samsung_Curved_65_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 5,
            'name'       =>  'imagen10',
            'path'=>'/images/TV/Samsung_Curved_65_3.jpg',
            'thumbnail_path'=>'/images/TV/Samsung_Curved_65_3.jpg',
            'featured'=>0
        ]);

        //Nuevos productos
        DB::table('product_images')->insert([
            'product_id' => 6,
            'name'       =>  'imagen11',
            'path'=>'/images/TV/Samsung_Curved_65_5.jpg',
            'thumbnail_path'=>'/images/TV/Samsung_Curved_65_5.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 7,
            'name'       =>  'imagen12',
            'path'=>'/images/VideoGames/PS4_Consolee_Black_1.jpg',
            'thumbnail_path'=>'/images/VideoGames/PS4_Consolee_Black_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 8,
            'name'       =>  'imagen13',
            'path'=>'/images/Cameras/Canon_Digital_DSLR_Camera_2.jpg',
            'thumbnail_path'=>'/images/Cameras/Canon_Digital_DSLR_Camera_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 9,
            'name'       =>  'imagen14',
            'path'=>'/images/CyberPower_1.jpg',
            'thumbnail_path'=>'/images/CyberPower_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 10,
            'name'       =>  'imagen15',
            'path'=>'/images/Phones/Blacberry_32GB_1.jpg',
            'thumbnail_path'=>'/images/Phones/Blacberry_32GB_1.jpg',
            'featured'=>1
        ]);

        /* -------*/
        DB::table('product_images')->insert([
            'product_id' => 11,
            'name'       =>  'imagen16',
            'path'=>'/images/VideoGames/xbox_360_halo_4.jpeg',
            'thumbnail_path'=>'/images/VideoGames/xbox_360_halo_4.jpeg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 12,
            'name'       =>  'imagen17',
            'path'=>'/images/VideoGames/ps4_god_of_war_4.jpg',
            'thumbnail_path'=>'/images/VideoGames/ps4_god_of_war_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 13,
            'name'       =>  'imagen18',
            'path'=>'/images/Computer/laptop_hp_500_gb.jpg',
            'thumbnail_path'=>'/images/Computer/laptop_hp_500_gb.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 14,
            'name'       =>  'imagen19',
            'path'=>'/images/Phones/xperia_z5.jpg',
            'thumbnail_path'=>'/images/Phones/xperia_z5.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 15,
            'name'       =>  'imagen20',
            'path'=>'/images/Audio/bocina_philips.jpg',
            'thumbnail_path'=>'/images/Audio/bocina_philips.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 16,
            'name'       =>  'imagen21',
            'path'=>'/images/VideoGames/PS4_Uncharted4_1.jpg',
            'thumbnail_path'=>'/images/VideoGames/PS4_Uncharted4_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 16,
            'name'       =>  'imagen22',
            'path'=>'/images/VideoGames/PS4_Uncharted4_2.jpg',
            'thumbnail_path'=>'/images/VideoGames/PS4_Uncharted4_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 16,
            'name'       =>  'imagen23',
            'path'=>'/images/VideoGames/PS4_Uncharted4_4.jpg',
            'thumbnail_path'=>'/images/VideoGames/PS4_Uncharted4_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 17,
            'name'       =>  'imagen24',
            'path'=>'/images/VideoGames/PS4_Controller_Black_1.jpg',
            'thumbnail_path'=>'/images/VideoGames/PS4_Controller_Black_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 17,
            'name'       =>  'imagen25',
            'path'=>'/images/VideoGames/PS4_Controller_Black_2.jpg',
            'thumbnail_path'=>'/images/VideoGames/PS4_Controller_Black_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 17,
            'name'       =>  'imagen26',
            'path'=>'/images/VideoGames/PS4_Controller_Black_3.jpg',
            'thumbnail_path'=>'/images/VideoGames/PS4_Controller_Black_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 18,
            'name'       =>  'imagen27',
            'path'=>'/images/VideoGames/XboxOne_Halo5_1.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_Halo5_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 18,
            'name'       =>  'imagen28',
            'path'=>'/images/VideoGames/XboxOne_Halo5_2.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_Halo5_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 18,
            'name'       =>  'imagen28',
            'path'=>'/images/VideoGames/XboxOne_Halo5_3.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_Halo5_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 19,
            'name'       =>  'imagen29',
            'path'=>'/images/VideoGames/XboxOne_Controller_Black_1.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_Controller_Black_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 19,
            'name'       =>  'imagen30',
            'path'=>'/images/VideoGames/XboxOne_Controller_Black_2.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_Controller_Black_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 19,
            'name'       =>  'imagen31',
            'path'=>'/images/VideoGames/XboxOne_Controller_Black_3.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_Controller_Black_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 20,
            'name'       =>  'imagen32',
            'path'=>'/images/VideoGames/PC_Fallout_4.jpg',
            'thumbnail_path'=>'/images/VideoGames/PC_Fallout_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 21,
            'name'       =>  'imagen33',
            'path'=>'/images/VideoGames/XboxOne_TomClancy_1.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_TomClancy_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 21,
            'name'       =>  'imagen34',
            'path'=>'/images/VideoGames/XboxOne_TomClancy_2.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_TomClancy_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 21,
            'name'       =>  'imagen35',
            'path'=>'/images/VideoGames/XboxOne_TomClancy_3.jpg',
            'thumbnail_path'=>'/images/VideoGames/XboxOne_TomClancy_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 22,
            'name'       =>  'imagen36',
            'path'=>'/images/TV/LG_OLED_55_1.jpg',
            'thumbnail_path'=>'/images/TV/LG_OLED_55_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 22,
            'name'       =>  'imagen37',
            'path'=>'/images/TV/LG_OLED_55_2.jpg',
            'thumbnail_path'=>'/images/TV/LG_OLED_55_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 22,
            'name'       =>  'imagen38',
            'path'=>'/images/TV/LG_OLED_55_3.jpg',
            'thumbnail_path'=>'/images/TV/LG_OLED_55_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 23,
            'name'       =>  'imagen39',
            'path'=>'/images/TV/Sony_4k_55_1.jpg',
            'thumbnail_path'=>'/images/TV/Sony_4k_55_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 23,
            'name'       =>  'imagen40',
            'path'=>'/images/TV/Sony_4k_55_2.jpg',
            'thumbnail_path'=>'/images/TV/Sony_4k_55_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 23,
            'name'       =>  'imagen41',
            'path'=>'/images/TV/Sony_4k_55_3.jpg',
            'thumbnail_path'=>'/images/TV/Sony_4k_55_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 24,
            'name'       =>  'imagen42',
            'path'=>'/images/TV/Samsung_Smart_48_2.jpg',
            'thumbnail_path'=>'/images/TV/Samsung_Smart_48_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 24,
            'name'       =>  'imagen43',
            'path'=>'/images/TV/Samsung_Smart_48_3.jpg',
            'thumbnail_path'=>'/images/TV/Samsung_Smart_48_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 24,
            'name'       =>  'imagen44',
            'path'=>'/images/TV/Samsung_Smart_48_4.jpg',
            'thumbnail_path'=>'/images/TV/Samsung_Smart_48_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 25,
            'name'       =>  'imagen45',
            'path'=>'/images/TV/LG_LED_TV_1.jpg',
            'thumbnail_path'=>'/images/TV/LG_LED_TV_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 25,
            'name'       =>  'imagen46',
            'path'=>'/images/TV/LG_LED_TV_2.jpg',
            'thumbnail_path'=>'/images/TV/LG_LED_TV_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 25,
            'name'       =>  'imagen47',
            'path'=>'/images/TV/LG_LED_TV_3.jpg',
            'thumbnail_path'=>'/images/TV/LG_LED_TV_3.jpg',
            'featured'=>1
        ]);
        
        DB::table('product_images')->insert([
            'product_id' => 26,
            'name'       =>  'imagen48',
            'path'=>'/images/TV/LG_Curved_55_1.jpg',
            'thumbnail_path'=>'/images/TV/LG_Curved_55_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 26,
            'name'       =>  'imagen49',
            'path'=>'/images/TV/LG_Curved_55_2.jpg',
            'thumbnail_path'=>'/images/TV/LG_Curved_55_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 26,
            'name'       =>  'imagen50',
            'path'=>'/images/TV/LG_Curved_55_3.jpg',
            'thumbnail_path'=>'/images/TV/LG_Curved_55_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 27,
            'name'       =>  'imagen51',
            'path'=>'/images/TV/Samsung_4k_50_1.jpg',
            'thumbnail_path'=>'/images/TV/Samsung_4k_50_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 27,
            'name'       =>  'imagen52',
            'path'=>'/images/TV/Samsung_4k_50_2.jpg',
            'thumbnail_path'=>'/images/TV/Samsung_4k_50_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 27,
            'name'       =>  'imagen53',
            'path'=>'/images/TV/Samsung_4k_50_3.jpg',
            'thumbnail_path'=>'/images/TV/Samsung_4k_50_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 28,
            'name'       =>  'imagen54',
            'path'=>'/images/Phones/iPhone_6_16GB_1.jpg',
            'thumbnail_path'=>'/images/Phones/iPhone_6_16GB_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 28,
            'name'       =>  'imagen55',
            'path'=>'/images/Phones/iPhone_6_16GB_2.jpg',
            'thumbnail_path'=>'/images/Phones/iPhone_6_16GB_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 28,
            'name'       =>  'imagen56',
            'path'=>'/images/Phones/iPhone_6_16GB_3.jpg',
            'thumbnail_path'=>'/images/Phones/iPhone_6_16GB_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 29,
            'name'       =>  'imagen57',
            'path'=>'/images/Phones/Blacberry_32GB_1.jpg',
            'thumbnail_path'=>'/images/Phones/Blacberry_32GB_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 29,
            'name'       =>  'imagen58',
            'path'=>'/images/Phones/Blacberry_32GB_2.jpg',
            'thumbnail_path'=>'/images/Phones/Blacberry_32GB_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 30,
            'name'       =>  'imagen59',
            'path'=>'/images/Phones/Samsung_Galaxy_Edge_16GB_1.jpg',
            'thumbnail_path'=>'/images/Phones/Samsung_Galaxy_Edge_16GB_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 30,
            'name'       =>  'imagen60',
            'path'=>'/images/Phones/Samsung_Galaxy_Edge_16GB_2.jpg',
            'thumbnail_path'=>'/images/Phones/Samsung_Galaxy_Edge_16GB_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 30,
            'name'       =>  'imagen61',
            'path'=>'/images/Phones/Samsung_Galaxy_Edge_16GB_3.jpg',
            'thumbnail_path'=>'/images/Phones/Samsung_Galaxy_Edge_16GB_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 31,
            'name'       =>  'imagen62',
            'path'=>'/images/Computer/Apple_MacBook_Pro_15_1.jpg',
            'thumbnail_path'=>'/images/Computer/Apple_MacBook_Pro_15_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 31,
            'name'       =>  'imagen63',
            'path'=>'/images/Computer/Apple_MacBook_Pro_15_2.jpg',
            'thumbnail_path'=>'/images/Computer/Apple_MacBook_Pro_15_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 31,
            'name'       =>  'imagen64',
            'path'=>'/images/Computer/Apple_MacBook_Pro_13.3_3.jpg',
            'thumbnail_path'=>'/images/Computer/Apple_MacBook_Pro_13.3_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 32,
            'name'       =>  'imagen65',
            'path'=>'/images/Computer/Apple-iPadAir_1.jpg',
            'thumbnail_path'=>'/images/Computer/Apple-iPadAir_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 32,
            'name'       =>  'imagen66',
            'path'=>'/images/Computer/Apple-iPadAir_2.jpg',
            'thumbnail_path'=>'/images/Computer/Apple-iPadAir_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 32,
            'name'       =>  'imagen67',
            'path'=>'/images/Computer/Apple-iPadAir_3.jpg',
            'thumbnail_path'=>'/images/Computer/Apple-iPadAir_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 33,
            'name'       =>  'imagen68',
            'path'=>'/images/Computer/ASUS_15.6_Laptop_1.jpg',
            'thumbnail_path'=>'/images/Computer/ASUS_15.6_Laptop_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 33,
            'name'       =>  'imagen69',
            'path'=>'/images/Computer/ASUS_15.6_Laptop_2.jpg',
            'thumbnail_path'=>'/images/Computer/ASUS_15.6_Laptop_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 33,
            'name'       =>  'imagen70',
            'path'=>'/images/Computer/ASUS_15.6_Laptop_3.jpg',
            'thumbnail_path'=>'/images/Computer/ASUS_15.6_Laptop_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 34,
            'name'       =>  'imagen71',
            'path'=>'/images/Computer/CyberPower_GamerUltra_PC_1.jpg',
            'thumbnail_path'=>'/images/Computer/CyberPower_GamerUltra_PC_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 34,
            'name'       =>  'imagen72',
            'path'=>'/images/Computer/CyberPower_GamerUltra_PC_2.jpg',
            'thumbnail_path'=>'/images/Computer/CyberPower_GamerUltra_PC_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 34,
            'name'       =>  'imagen73',
            'path'=>'/images/Computer/CyberPower_GamerUltra_PC_3.jpg',
            'thumbnail_path'=>'/images/Computer/CyberPower_GamerUltra_PC_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 35,
            'name'       =>  'imagen74',
            'path'=>'/images/Computer/DELL_Inspirion_Deskop_1.jpg',
            'thumbnail_path'=>'/images/Computer/DELL_Inspirion_Deskop_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 35,
            'name'       =>  'imagen75',
            'path'=>'/images/Computer/DELL_Inspirion_Deskop_2.jpg',
            'thumbnail_path'=>'/images/Computer/DELL_Inspirion_Deskop_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 35,
            'name'       =>  'imagen76',
            'path'=>'/images/Computer/DELL_Inspirion_Deskop_3.jpg',
            'thumbnail_path'=>'/images/Computer/DELL_Inspirion_Deskop_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 36,
            'name'       =>  'imagen77',
            'path'=>'/images/Computer/DELL_Monitor_23-1.jpg',
            'thumbnail_path'=>'/images/Computer/DELL_Monitor_23-1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 36,
            'name'       =>  'imagen78',
            'path'=>'/images/Computer/DELL_Monitor_23-2.jpg',
            'thumbnail_path'=>'/images/Computer/DELL_Monitor_23-2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 36,
            'name'       =>  'imagen79',
            'path'=>'/images/Computer/DELL_Monitor_23-3.jpg',
            'thumbnail_path'=>'/images/Computer/DELL_Monitor_23-3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 37,
            'name'       =>  'imagen80',
            'path'=>'/images/Computer/DELL_XPS_Desktop_4.jpg',
            'thumbnail_path'=>'/images/Computer/DELL_XPS_Desktop_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 37,
            'name'       =>  'imagen81',
            'path'=>'/images/Computer/DELL_XPS_Desktop_1.jpg',
            'thumbnail_path'=>'/images/Computer/DELL_XPS_Desktop_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 37,
            'name'       =>  'imagen82',
            'path'=>'/images/Computer/DELL_XPS_Desktop_2.jpg',
            'thumbnail_path'=>'/images/Computer/DELL_XPS_Desktop_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 38,
            'name'       =>  'imagen83',
            'path'=>'/images/Computer/HP_Pavilion_23_1.jpg',
            'thumbnail_path'=>'/images/Computer/HP_Pavilion_23_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 38,
            'name'       =>  'imagen84',
            'path'=>'/images/Computer/HP_Pavilion_23_2.jpg',
            'thumbnail_path'=>'/images/Computer/HP_Pavilion_23_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 38,
            'name'       =>  'imagen85',
            'path'=>'/images/Computer/HP_Pavilion_23_3.jpg',
            'thumbnail_path'=>'/images/Computer/HP_Pavilion_23_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 39,
            'name'       =>  'imagen86',
            'path'=>'/images/Computer/HD2.jpg',
            'thumbnail_path'=>'/images/Computer/HD2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 39,
            'name'       =>  'imagen87',
            'path'=>'/images/Computer/HD1.jpg',
            'thumbnail_path'=>'/images/Computer/HD1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 40,
            'name'       =>  'imagen88',
            'path'=>'/images/Computer/mouse1.jpg',
            'thumbnail_path'=>'/images/Computer/mouse1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 40,
            'name'       =>  'imagen89',
            'path'=>'/images/Computer/mouse2.jpg',
            'thumbnail_path'=>'/images/Computer/mouse2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 41,
            'name'       =>  'imagen90',
            'path'=>'/images/Audio/Beats_Solo_2_Earphones_Red_1.jpg',
            'thumbnail_path'=>'/images/Audio/Beats_Solo_2_Earphones_Red_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 41,
            'name'       =>  'imagen91',
            'path'=>'/images/Audio/Beats_Solo_2_Earphones_Red_2.jpg',
            'thumbnail_path'=>'/images/Audio/Beats_Solo_2_Earphones_Red_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 41,
            'name'       =>  'imagen92',
            'path'=>'/images/Audio/Beats_Solo_2_Earphones_Red_3.jpg',
            'thumbnail_path'=>'/images/Audio/Beats_Solo_2_Earphones_Red_3.jpg',
            'featured'=>1
        ]);
        
        DB::table('product_images')->insert([
            'product_id' => 42,
            'name'       =>  'imagen93',
            'path'=>'/images/Audio/Astro_a40_Wired_PS4_1.jpg',
            'thumbnail_path'=>'/images/Audio/Astro_a40_Wired_PS4_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 42,
            'name'       =>  'imagen94',
            'path'=>'/images/Audio/Astro_a40_Wired_PS4_2.jpg',
            'thumbnail_path'=>'/images/Audio/Astro_a40_Wired_PS4_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 43,
            'name'       =>  'imagen95',
            'path'=>'/images/Audio/Astro_headset_xbox_one_1.jpg',
            'thumbnail_path'=>'/images/Audio/Astro_headset_xbox_one_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 43,
            'name'       =>  'imagen96',
            'path'=>'/images/Audio/Astro_headset_xbox_one_2.jpg',
            'thumbnail_path'=>'/images/Audio/Astro_headset_xbox_one_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 44,
            'name'       =>  'imagen97',
            'path'=>'/images/Audio/Beats_Solo_2_PowerBeats_Earphones_1.jpg',
            'thumbnail_path'=>'/images/Audio/Beats_Solo_2_PowerBeats_Earphones_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 44,
            'name'       =>  'imagen98',
            'path'=>'/images/Audio/Beats_Solo_2_PowerBeats_Earphones_2.jpg',
            'thumbnail_path'=>'/images/Audio/Beats_Solo_2_PowerBeats_Earphones_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 44,
            'name'       =>  'imagen99',
            'path'=>'/images/Audio/Beats_Solo_2_PowerBeats_Earphones_3.jpg',
            'thumbnail_path'=>'/images/Audio/Beats_Solo_2_PowerBeats_Earphones_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 45,
            'name'       =>  'imagen101',
            'path'=>'/images/Audio/Bose_QuietComfort_Headphones_1.jpg',
            'thumbnail_path'=>'/images/Audio/Bose_QuietComfort_Headphones_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 45,
            'name'       =>  'imagen102',
            'path'=>'/images/Audio/Bose_QuietComfort_Headphones_2.jpg',
            'thumbnail_path'=>'/images/Audio/Bose_QuietComfort_Headphones_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 45,
            'name'       =>  'imagen103',
            'path'=>'/images/Audio/Bose_QuietComfort_Headphones_4.jpg',
            'thumbnail_path'=>'/images/Audio/Bose_QuietComfort_Headphones_4.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 46,
            'name'       =>  'imagen104',
            'path'=>'/images/Audio/PS4_Headset.jpg',
            'thumbnail_path'=>'/images/Audio/PS4_Headset.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 47,
            'name'       =>  'imagen105',
            'path'=>'/images/Audio/Turtle_Beach_XO-7_Headset_1.jpg',
            'thumbnail_path'=>'/images/Audio/Turtle_Beach_XO-7_Headset_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 47,
            'name'       =>  'imagen106',
            'path'=>'/images/Audio/Turtle_Beach_XO-7_Headset_2.jpg',
            'thumbnail_path'=>'/images/Audio/Turtle_Beach_XO-7_Headset_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 47,
            'name'       =>  'imagen107',
            'path'=>'/images/Audio/Turtle_Beach_XO-7_Headset_3.jpg',
            'thumbnail_path'=>'/images/Audio/Turtle_Beach_XO-7_Headset_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 48,
            'name'       =>  'imagen108',
            'path'=>'/images/Audio/turtle_beaches_star_wars_1.jpg',
            'thumbnail_path'=>'/images/Audio/turtle_beaches_star_wars_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 48,
            'name'       =>  'imagen109',
            'path'=>'/images/Audio/turtle_beaches_star_wars_2.jpg',
            'thumbnail_path'=>'/images/Audio/turtle_beaches_star_wars_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 48,
            'name'       =>  'imagen110',
            'path'=>'/images/Audio/turtle_beaches_star_wars_3.jpg',
            'thumbnail_path'=>'/images/Audio/turtle_beaches_star_wars_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 49,
            'name'       =>  'imagen111',
            'path'=>'/images/Audio/Xbox_one_mic.jpg',
            'thumbnail_path'=>'/images/Audio/Xbox_one_mic.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 50,
            'name'       =>  'imagen112',
            'path'=>'/images/Cameras/Canon_Digital_DSLR_Camera_1.jpg',
            'thumbnail_path'=>'/images/Cameras/Canon_Digital_DSLR_Camera_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 50,
            'name'       =>  'imagen113',
            'path'=>'/images/Cameras/Canon_Digital_DSLR_Camera_2.jpg',
            'thumbnail_path'=>'/images/Cameras/Canon_Digital_DSLR_Camera_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 50,
            'name'       =>  'imagen114',
            'path'=>'/images/Cameras/Canon_Digital_DSLR_Camera_3.jpg',
            'thumbnail_path'=>'/images/Cameras/Canon_Digital_DSLR_Camera_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 51,
            'name'       =>  'imagen115',
            'path'=>'/images/Cameras/Canon_PointandShoot_Camera_1.jpg',
            'thumbnail_path'=>'/images/Cameras/Canon_PointandShoot_Camera_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 51,
            'name'       =>  'imagen116',
            'path'=>'/images/Cameras/Canon_PointandShoot_Camera_2.jpg',
            'thumbnail_path'=>'/images/Cameras/Canon_PointandShoot_Camera_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 51,
            'name'       =>  'imagen117',
            'path'=>'/images/Cameras/Canon_PointandShoot_Camera_3.jpg',
            'thumbnail_path'=>'/images/Cameras/Canon_PointandShoot_Camera_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 52,
            'name'       =>  'imagen118',
            'path'=>'/images/Cameras/GoPro-Hero4-Black_Camera_1.jpg',
            'thumbnail_path'=>'/images/Cameras/GoPro-Hero4-Black_Camera_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 52,
            'name'       =>  'imagen119',
            'path'=>'/images/Cameras/GoPro-Hero4-Black_Camera_2.jpg',
            'thumbnail_path'=>'/images/Cameras/GoPro-Hero4-Black_Camera_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 52,
            'name'       =>  'imagen120',
            'path'=>'/images/Cameras/GoPro-Hero4-Black_Camera_3.jpg',
            'thumbnail_path'=>'/images/Cameras/GoPro-Hero4-Black_Camera_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 53,
            'name'       =>  'imagen121',
            'path'=>'/images/Cameras/Nikon_DSLR_Camera_1.jpg',
            'thumbnail_path'=>'/images/Cameras/Nikon_DSLR_Camera_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 53,
            'name'       =>  'imagen122',
            'path'=>'/images/Cameras/Nikon_DSLR_Camera_2.jpg',
            'thumbnail_path'=>'/images/Cameras/Nikon_DSLR_Camera_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 53,
            'name'       =>  'imagen123',
            'path'=>'/images/Cameras/Nikon_DSLR_Camera_3.jpg',
            'thumbnail_path'=>'/images/Cameras/Nikon_DSLR_Camera_3.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 54,
            'name'       =>  'imagen124',
            'path'=>'/images/Cameras/Sony_Alpha_Mirrorless_Camera_1.jpg',
            'thumbnail_path'=>'/images/Cameras/Sony_Alpha_Mirrorless_Camera_1.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 54,
            'name'       =>  'imagen125',
            'path'=>'/images/Cameras/Sony_Alpha_Mirrorless_Camera_2.jpg',
            'thumbnail_path'=>'/images/Cameras/Sony_Alpha_Mirrorless_Camera_2.jpg',
            'featured'=>1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 54,
            'name'       =>  'imagen126',
            'path'=>'/images/Cameras/Sony_Alpha_Mirrorless_Camera_4.jpg',
            'thumbnail_path'=>'/images/Cameras/Sony_Alpha_Mirrorless_Camera_4.jpg',
            'featured'=>1
        ]);


    }
}
