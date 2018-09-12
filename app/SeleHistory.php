<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeleHistory extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
