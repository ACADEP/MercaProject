<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    protected $fillable = [
        'name_shop',
        'product_id',
        'sold',
        'offsell',
        'namebanner',
        'path',
        'thumbnail_path',
    ];

    /**
     * One Product can have many photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos() {
        return $this->hasMany('App\Shop');
    }


    /**
     * Return a product can have one featured photo where "featured" column = true (or 1)
     *
     * @return mixed
     */
    public function featuredPhoto() {
        return $this->hasOne('App\Shop')->whereFeatured(true);
    }


}
