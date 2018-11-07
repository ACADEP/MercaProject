<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use App\Sale;

class CustomerHistory extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function insert(Cart $cart, Sale $sale)
    {
        $this->sale_id = $sale->id;
        $this->product_id=$cart->product->id;
        $this->product_name= $cart->product->product_name;
        $this->product_price=$cart->product_price;
        $this->amount=$cart->qty;
        $this->save();
    }

   
}
