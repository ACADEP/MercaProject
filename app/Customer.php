<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentActive()
    {
        $band="0";
        if($this->idCustomerOpenpay != null)
        {
            $band="1";
        }
        return $band;
    }
}
