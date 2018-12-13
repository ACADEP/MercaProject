<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
    public function insert($product_id)
    {
        $this->user_id=Auth::user()->id;
        $this->product_id=$product_id;
        $this->save();
    }
}
