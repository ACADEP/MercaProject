<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $appends = ["full_address"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->nombre." ".$this->apellidos;
    }

    public function getFullAddressAttribute()
    {
        $address= $this->calle != "" ?  $this->calle.", " : " ";  
        $address.="NumInt: ". $this->numInterior != "" ? $this->numInterior.", " : " ";
        $address.="NumExt: ".$this->numExterior != "" ? $this->numExterior.", " : " ";
        $address.="Col. ".$this->colonia." - Código postal: ".$this->cp;
        $address.=" Estado: ".$this->estado;

        return $address;
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
