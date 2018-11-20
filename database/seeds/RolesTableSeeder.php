<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'    => 'Admin',
            'display_name' => 'Administrador',
            'guard_name'=>'web'
        ]);

        DB::table('roles')->insert([
            'name'    => 'Client',
            'display_name' => 'Cliente',
            'guard_name'=>'web'
        ]);

        DB::table('roles')->insert([
            'name'    => 'Seller',
            'display_name' => 'Vendedor',
            'guard_name'=>'web'
        ]);
    }
}
