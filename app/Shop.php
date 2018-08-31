<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function product()
    {
        $this->hasMany(Product::class);
    }
    
    public function shopsold() {
        return $this->hasMany(ShopSold::class);
    }


}
