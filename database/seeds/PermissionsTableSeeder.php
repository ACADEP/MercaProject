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
        //Compañia mercadata
        DB::table('companies')->insert([
            'name'    => 'Mercadata',
        ]);
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

        DB::table('permissions')->insert([
            'name'    => 'view_all_sales',
            'display_name' => 'Ver todas las Ventas',
            'guard_name'=>'web'
        ]);


        //Permisos ordenes
        DB::table('permissions')->insert([
            'name'    => 'view_orders',
            'display_name' => 'Ver ordenes',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'acredit_pay',
            'display_name' => 'Acreditar pagos de ordenes',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'delete_order',
            'display_name' => 'Eliminar orden',
            'guard_name'=>'web'
        ]);

        //Permisos reclamos de ventas
        DB::table('permissions')->insert([
            'name'    => 'view_reclames',
            'display_name' => 'Ver reclamos',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'respond_reclames',
            'display_name' => 'Responder reclamos',
            'guard_name'=>'web'
        ]);

        //Permisos para Marcas
        DB::table('permissions')->insert([
            'name'    => 'view_brands',
            'display_name' => 'Ver marcas',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'add_brands',
            'display_name' => 'Agregar marcas',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'update_brands',
            'display_name' => 'Actualizar marcas',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'delete_brands',
            'display_name' => 'Eliminar marcas',
            'guard_name'=>'web'
        ]);

         //Permisos para hacer configuraciones
         DB::table('permissions')->insert([
            'name'    => 'configurations',
            'display_name' => 'Hacer configuraciones',
            'guard_name'=>'web'
        ]);

        //Permisos cotizaciones
        DB::table('permissions')->insert([
            'name'    => 'make_marketRate',
            'display_name' => 'Hacer cotizaciones',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'delete_markerRate',
            'display_name' => 'Eliminar cotizaciones',
            'guard_name'=>'web'
        ]);

        DB::table('permissions')->insert([
            'name'    => 'pay_markerRate',
            'display_name' => 'Convertir cotizaciones a pedidos',
            'guard_name'=>'web'
        ]);


    }
}
