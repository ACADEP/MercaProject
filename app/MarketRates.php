<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketRates extends Model
{
    public function getRouteKeyName()
    {
        return 'id';
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
}
