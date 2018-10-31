<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function customerHistories()
    {
        return $this->hasMany(CustomerHistory::class);
    }
    public function sellerHistories()
    {
        return $this->hasMany(seleHistory::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    public function photosReclame()
    {
        return $this->hasMany(PhotosReclame::class);
    }

    public function Insert($total, $shipment_method, $shipment_status, $shipment_number, $status_pay)
    {
        $this->user_id=Auth::user()->id;
        $this->date=Carbon::now();
        $this->url_fact="#";
        $this->shipment_method=$shipment_method;
        $this->shipment_tracking=$shipment_number;
        $this->status_pago=$status_pay;
        $this->status_envio=$shipment_status;
        $this->status_reclamo="Abrir un reclamo";
        $this->total=$total;
        $this->save();
       
    }

    public function updateStatusShip($shipment_status)
    {
        $this->status_envio=$shipment_status;
        $this->save();
    }
    
}
