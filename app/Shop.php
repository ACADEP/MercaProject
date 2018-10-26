<?php

namespace App;

use App\Product;
use App\Brand;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function product()
    {
        return $this->hasMany(Product::class, 'shop_id');
    }
    
    public function shopsold() {
        return $this->hasMany(ShopSold::class);
    }

    public function category() {
        return $this->belongsTo(Category::class,'cat_id');
    }

}
