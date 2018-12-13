<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    public function shipmentProduct()
    {
        return $this->belongsTo(ShipmentProduct::class,'id_shipment');
    }
}
