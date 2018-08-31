<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {




    /**
     * A Product belongs to a Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Product() {
        return $this->belongsTo('App\Product');
    }


    /**
     * A Cart belongs to a User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User() {
        return $this->belongsTo(User::class);
    }


}