<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'usuario'   => 5,
            'nombre'    => 'Jonatan',
            'apellidos' => 'Ceseña',
            'telefono'  => '6121428497'
        ]);

        DB::table('customers')->insert([
            'usuario'   => 6,
            'nombre'    => 'Jonatan',
            'apellidos' => 'Marquez',
            'telefono'  => '6121428497'
        ]);

        DB::table('customers')->insert([
            'usuario'   => 7,
            'nombre'    => 'Luis Bernardo',
            'apellidos' => 'Perez Torres',
            'telefono'  => '6121428497'
        ]);

    }
}
