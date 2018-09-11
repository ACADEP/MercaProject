<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'usuario'       => 5,
            'calle'         => 'Pto. Madero',
            'ciudad'        => 'La Paz',
            'estado'        => 'B.C.S.',
            'colonia'       => 'Olas altas',
            'cp'            => '23089',
            'calles'        => 'Pto. Vallarta',
            'numExterior'   => 'Lt. 26',
            'referencias'   => 'Rejas blancas con un pino',
        ]);

        DB::table('addresses')->insert([
            'usuario'       => 5,
            'calle'         => 'Santos Degollado',
            'ciudad'        => 'La Paz',
            'estado'        => 'B.C.S.',
            'colonia'       => 'Guerrero',
            'cp'            => '23024',
            'calles'        => 'Lopéz Mateos',
            'numExterior'   => '224',
            'referencias'   => 'Rejas blancas con muchos camiones afura',
        ]);

        DB::table('addresses')->insert([
            'usuario'       => 7,
            'calle'         => 'Bravo',
            'ciudad'        => 'La Paz',
            'estado'        => 'B.C.S.',
            'colonia'       => 'Centro',
            'cp'            => '23055',
            'calles'        => 'Héroes de independencia',
            'numInterior'   => '6',
            'numExterior'   => '226',
            'referencias'   => 'En la esquina',
        ]);

    }
}
