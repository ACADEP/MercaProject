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

    

}
