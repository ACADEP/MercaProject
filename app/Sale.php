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

    public function Insert($total)
    {
        $this->user_id=Auth::user()->id;
        $this->date=Carbon::now();
        $this->url_fact="#";
        $this->status_pago="Acreditado";
        $this->status_envio="En preparación";
        $this->status_reclamo="Abrir un reclamo";
        $this->total=$total;
        $this->save();
    }
    
}