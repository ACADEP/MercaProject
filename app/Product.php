<?php

namespace App;

use App\ProductPhoto;
use App\Brand;
use App\Category;
use App\Shop;
use App\ShopSold;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $appends =['real_price'];
    
    public function getRouteKeyName()
    {
        return 'product_name';
    } 




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

    public static function setQtybyBrand($brand_id) {
        $products=Product::where("brand_id",$brand_id)->get();
        foreach ($products as $product) 
        {
           $product->product_qty=0;
           $product->featured=0;
           $product->save();
        }
    }


    /**
     * A Product Belongs To a Brand
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand() {
        return $this->belongsTo('App\Brand',"brand_id");
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

    public function getRealPriceAttribute()
    {
        $real=0;
        if($this->reduced_price > 0)
        {
            $real=$this->reduced_price;
        }
        else
        {
            $real=$this->price;
        }

        return floatval($real)*1.16;
    }

    public function getMrPriceAttribute()
    {
        
        return floatval($this->price);
    }

   


}