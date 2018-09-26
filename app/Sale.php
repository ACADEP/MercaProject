<?php

namespace App;

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
    
}
