<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(BrandTableSeed::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductImageTableSeeder::class);
        $this->call(ShopSalesTableSeeder::class);

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
