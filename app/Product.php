<?php

namespace App;

use App\ProductPhoto;
use App\Brand;
use App\Category;
use App\Shop;
use App\ShopSold;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    

    protected $fillable = [
        'product_name',
        'product_qty',
        'product_sku',
        'price',
        'reduced_price',
        'shop_id',
        'cat_id',
        'featured',
        'brand_id',
        'description',
        'product_spec',
    ];

    //protected $gaurded = ['id'];

    
    
    public function category() {
        return $this->belongsTo(Category::class,'cat_id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function shop() {
        return $this->hasMany(Shop::class);
    }

    public function shopsold() {
        return $this->hasMany(ShopSold::class);
    }

    public function shipments(){
        return $this->hasMany(ShipmentProduct::class,'id_product');
    }


    // do same thing above for category() if you want to show what category a certain product is under in products page.

    /**
     * A Product Belongs To a Brand
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand() {
        return $this->belongsTo('App\Brand');
    }


    public function addPhoto(ProductPhoto $ProductPhoto) {
        return $this->photos()->save($ProductPhoto);
    }


    /**
     * One Product can have many photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos() {
        return $this->hasMany(ProductPhoto::class);
    }


    /**
     * Return a product can have one featured photo where "featured" column = true (or 1)
     *
     * @return mixed
     */
    public function featuredPhoto() {
        return $this->hasOne('App\ProductPhoto')->whereFeatured(true);
    }


    /**
     * Show a product when clicked on (Admin side).
     *
     * @param $id
     * @return mixed
     */
    public static function LocatedAt($id) {
        return static::where(compact('id'))->firstOrFail();
    }


    /**
     * Show a Product when clicked on.
     *
     * @param $product_name
     * @return mixed
     */
    public static function ProductLocatedAt($product_name) {
        return static::where(compact('product_name'))->firstOrFail();
    }


}