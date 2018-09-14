<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentProduct extends Model
{
   public function ship()
   {
        return $this->belongsTo(Shipment::class, 'id_shipment');
   }

}
