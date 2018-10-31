<?php

namespace App;
use Carbon\Carbon;
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
    public function sales()
    {
        return $this->hasMany(Sales::class);
    }

    public function insert(Cart $cart, $id_prov, $client)
    {
        $this->user_id=$id_prov;
        $this->product_id=$cart->product->id;
        $this->client=$client;
        $this->date=Carbon::now();
        $this->amount=$cart->qty;
        $this->total=$cart->total;
        $this->save();
    }
}
