<?php

use Illuminate\Database\Seeder;

class ShipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipments')->insert([
            'id_seller'         => 7,
            'Name'              =>'Fedex',
            'rate'              => 100,
        ]);

        DB::table('shipments')->insert([
            'id_seller'         => 7,
            'Name'              =>'DHL',
            'rate'              => 150,
        ]);

        DB::table('shipments')->insert([
            'id_seller'         => 7,
            'Name'              =>'UPS',
            'rate'              => 110,
        ]);
        
    }
}
