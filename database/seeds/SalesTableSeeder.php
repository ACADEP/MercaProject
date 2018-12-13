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
            'user_id'       => 2,
            'date'          => Carbon::now(),
            'url_fact'      => '#',
            'status_pago'   => 'En espera de acreditación',
            'status_envio'  => 'En preparación',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 1200
        ]);

        DB::table('sales')->insert([
            'user_id'       => 3,
            'date'          => '2018-10-03 13:32:45',
            'url_fact'      => '#',
            'status_pago'   => 'Acreditado',
            'status_envio'  => 'Entregado',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 8000
        ]);

        DB::table('sales')->insert([
            'user_id'       => 4,
            'date'          => '2018-11-03 13:32:45',
            'url_fact'      => '#',
            'status_pago'   => 'Acreditado',
            'status_envio'  => 'Entregado',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 7000
        ]);

        DB::table('sales')->insert([
            'user_id'       => 8,
            'date'          => '2018-12-03 13:32:45',
            'url_fact'      => '#',
            'status_pago'   => 'Acreditado',
            'status_envio'  => 'Entregado',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 1700
        ]);

        DB::table('sales')->insert([
            'user_id'       => 2,
            'date'          => Carbon::now(),
            'url_fact'      => '#',
            'status_pago'   => 'En espera de acreditación',
            'status_envio'  => 'En preparación',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 3500
        ]);

        DB::table('sales')->insert([
            'user_id'       => 3,
            'date'          => '2018-10-03 13:32:45',
            'url_fact'      => '#',
            'status_pago'   => 'Acreditado',
            'status_envio'  => 'Entregado',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 1000
        ]);

        DB::table('sales')->insert([
            'user_id'       => 4,
            'date'          => '2018-11-03 13:32:45',
            'url_fact'      => '#',
            'status_pago'   => 'Acreditado',
            'status_envio'  => 'Entregado',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 12000
        ]);

        DB::table('sales')->insert([
            'user_id'       => 8,
            'date'          => '2018-12-03 13:32:45',
            'url_fact'      => '#',
            'status_pago'   => 'Acreditado',
            'status_envio'  => 'Entregado',
            'status_reclamo'=> 'Abrir un reclamo',
            'total'         => 10000
        ]);
    }
}
