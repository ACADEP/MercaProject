<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentInformation extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
