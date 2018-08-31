<?php
namespace App\Http\Traits;

use App\Shop;

trait ShopTrait {


    public function shopAll() {
        // Get all the brands from the Brands Table.
        return Shop::all();
    }

}