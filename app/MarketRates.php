<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketRates extends Model
{
    protected $fillable = [ 'company','client','contact','address','phone','email','date'];
    
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, "client")->withTrashed();
    }

    public function MarketRatesDetails()
    {
        return $this->hasMany(MarketRatesDetail::class);
    }

    public function productRepeat($id)
    {
        $band=false;
        $details = $this->MarketRatesDetails()->get();
        foreach($details as $detail)
        {
            if($detail->product_id==$id)
            {
                $band=true;
            }
        }
        return $band;
    }

    public function getTotalWithIvaAttribute()
    {
        return $this->total*1.16;
    }
}
