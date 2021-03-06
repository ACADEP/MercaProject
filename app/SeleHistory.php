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

    public function marketdetail()
    {
        return $this->belongsTo(MarketRatesDetail::class, "product_id");
    } 



    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function sales()
    {
        return $this->belongsTo(Sale::class,"sale_id");
    }

    public function insert(Cart $cart, $id_prov, $client, $sale_id)
    {
        $this->user_id=$id_prov;
        $this->sale_id=$sale_id;
        $this->product_id=$cart->product->id;
        $this->client=$client;
        $this->date=Carbon::now();
        $this->amount=$cart->qty;
        $this->total=$cart->total;
        $this->save();
    }

    public function insert_pCustomer(CustomerHistory $item, $id_prov, $client, $sale_id)
    {
        $this->user_id=$id_prov;
        $this->sale_id=$sale_id;
        $this->product_id=$item->product_id;
        $this->client=$client;
        $this->date=Carbon::now();
        $this->amount=$item->amount;
        $this->total=$item->amount*$item->product_price;
        $this->save();
    }

    //Atributos
    public function getProductPhotoAttribute()
    {
        if($this->sales->pay_method=="Cotización")
        {
            return $this->marketdetail->thumbnail;
        }

        return $this->product->photos->first()->path;
    }

    public function getProductNameAttribute()
    {
        if($this->sales->pay_method=="Cotización")
        {
            return $this->marketdetail->description;
        }

        return $this->product->product_name;
    }

}
