<?php

namespace App;
use App\Product;
use App\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopSold extends Model
{
    public function product() {
      return  $this->belongsTo(Product::class, 'product_id');
    }

    public function shop() {
        $this->hasMany(Shop::class);
    }

}
