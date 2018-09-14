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
        $this->call(CustomerTableSeeder::class);
        $this->call(PaymentInformationTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(SeleHistoriesTableSeeder::class);
        $this->call(ShipmentTableSeeder::class);

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
