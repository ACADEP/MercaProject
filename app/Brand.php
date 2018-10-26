<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

    protected $table = 'brands';

    protected $fillable = [
        'brand_name',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * One Brand can have Many Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function productBrand() {
    //     return $this->hasMany('App\Product', 'brand_id');
    // }



}