<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderOxxo extends Model
{
    public function insert($userId,$saleId)
    {
        $this->sale_id=$saleId;
        $this->user_id=$userId;
        $this->save();
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
