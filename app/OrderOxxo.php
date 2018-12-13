<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderOxxo extends Model
{
    public function insert($userId,$saleId,$market_id)
    {
        $this->sale_id=$saleId;
        $this->market_id=$market_id;
        $this->user_id=$userId;
        $this->save();
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
