<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketRatesDetail extends Model
{
    public function MarketRates()
    {
        return $this->hasOne(MarketRates::class, 'market_rates_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
}
