<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductPhoto extends Model {

   Protected $guarded=[];
    
   protected $table = "product_images";

    /**
     * @var array
     */
    protected $fillable = ['product_id','name', 'path', 'thumbnail_path', 'featured'];


    /**
     * Product photos belong to a Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo('App\Product');
    }


    /**
     * Get the product photos base directory.
     */
    public function baseDir() {
        return 'src/public/ProductPhotos/photos';
    }


    /**
     * Set the name attribute of photo
     *
     *
     * @param $name
     */
    public function setNameAttribute($name) {
        $this->attributes['name'] = $name;

        // Set the path of photo
        $this->path = $this->baseDir() . '/' . $name;

        // Set the thumbnail path of photo
        $this->thumbnail_path = $this->baseDir() . '/th-' . $name;
    }


    



}