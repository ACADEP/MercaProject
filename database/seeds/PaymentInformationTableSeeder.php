<?php

use Illuminate\Database\Seeder;

class PaymentInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_informations')->insert([
            'usuario'       => 6,
            'numtarjeta'   => '4152313324916290',
            'titular'       => 'Ceseña Marquez',
            'vigencia'      => '08/22',
            'cvc'           => '351'
        ]);

        DB::table('payment_informations')->insert([
            'usuario'       => 5,
            'numtarjeta'   => '4242424242424242',
            'titular'       => 'Marquez',
            'vigencia'      => '10/18',
            'cvc'           => '555'
        ]);

        DB::table('payment_informations')->insert([
            'usuario'       =>  9,
            'numtarjeta'   =>   '4242424242424242',
            'titular'       =>  'Perez Torres Luis Bernardo',
            'vigencia'      =>  '08/22',
            'cvc'           =>  '351'
        ]);


    }
}
