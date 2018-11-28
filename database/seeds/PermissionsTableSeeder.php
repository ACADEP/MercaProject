<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisos para productos
        DB::table('permissions')->insert([
            'name'    => 'view_products',
            'display_name' => 'Ver productos',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'add_products',
            'display_name' => 'Agregar productos',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'update_products',
            'display_name' => 'Actualizar productos',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'delete_products',
            'display_name' => 'Eliminar productos',
            'guard_name'=>'web'
        ]);

        //Permisos para categorias
        DB::table('permissions')->insert([
            'name'    => 'view_categories',
            'display_name' => 'Ver categorias',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'add_categories',
            'display_name' => 'Agregar categorias',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'update_categories',
            'display_name' => 'Actualizar categorias',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'delete_categories',
            'display_name' => 'Eliminar categorias',
            'guard_name'=>'web'
        ]);

        // //Permisos para ususarios
        // DB::table('permissions')->insert([
        //     'name'    => 'View_users',
        //     'display_name' => 'Ver usuarios',
        //     'guard_name'=>'web'
        // ]);

        // DB::table('permissions')->insert([
        //     'name'    => 'add_users',
        //     'display_name' => 'Agregar usuarios',
        //     'guard_name'=>'web'
        // ]);

        // DB::table('permissions')->insert([
        //     'name'    => 'delete_users',
        //     'display_name' => 'Eliminar usuarios',
        //     'guard_name'=>'web'
        // ]);

        // DB::table('permissions')->insert([
        //     'name'    => 'update_users',
        //     'display_name' => 'Actualizar usuarios',
        //     'guard_name'=>'web'
        // ]);

        //Permiso para ver ventas
        DB::table('permissions')->insert([
            'name'    => 'view_sales',
            'display_name' => 'Ver Ventas',
            'guard_name'=>'web'
        ]);

        //Permisos para facturas
        DB::table('permissions')->insert([
            'name'    => 'view_invoice',
            'display_name' => 'Ver facturas',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'add_invoice',
            'display_name' => 'Subir facturas',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'delete_invoice',
            'display_name' => 'Quitar facturas',
            'guard_name'=>'web'
        ]);


    }
}
