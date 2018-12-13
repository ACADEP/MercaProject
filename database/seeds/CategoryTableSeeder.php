<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category' => 'Computadoras',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'Games',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'Electronica',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'Accessorios',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'Alamacenamiento',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'Camaras',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'Cables',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'Bocinas',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'Alarmas',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'TV',
            'parent_id'        =>  0,
        ]);

        DB::table('categories')->insert([
            'category' => 'Celulares',
            'parent_id'        =>  0,
        ]);
    }
}
