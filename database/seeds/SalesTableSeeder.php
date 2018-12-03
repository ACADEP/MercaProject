<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales')->insert([
            'user_id'       => 6,
            'date'          => Carbon::now(),
            'url_fact'      => '#',
            'status_pago'   => 'En espera de acreditación',
            'status_envio'  => 'En preparación',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 1000
        ]);

        DB::table('sales')->insert([
            'user_id'       => 6,
            'date'          => Carbon::now(),
            'url_fact'      => '#',
            'status_pago'   => 'Acreditado',
            'status_envio'  => 'Entregado',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 300
        ]);

        DB::table('sales')->insert([
            'user_id'       => 5,
            'date'          => Carbon::now(),
            'url_fact'      => '#',
            'status_pago'   => 'Acreditado',
            'status_envio'  => 'Entregado',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 100
        ]);

        DB::table('sales')->insert([
            'user_id'       => 5,
            'date'          => Carbon::now(),
            'url_fact'      => '#',
            'status_pago'   => 'Acreditado',
            'status_envio'  => 'Entregado',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 1500
        ]);
    }
}
