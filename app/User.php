<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Make a boot function to listen
     * to any model events that are fired below.
     */
    public static function boot() {
        // Reference the parent class
        parent::boot();

        // When we are creating a record (for user registration),
        // then we want to set a token to some random string.
        static::creating(function($user) {
            $user->token = str_random(30);
        });
    }


    /**
     * Confirm the users email by
     * setting verified to true,
     * token to a NULL value,
     * then save the results.
     */
    public function confirmEmail() {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
        
    }

    public function productseller()
    {
        return $this->hasMany(ProductSeller::class);
    }

    public function selehistories()
    {
        return $this->hasMany(SeleHistory::class);
    }
    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
    public function payments()
    {
        return $this->hasMany(PaymentInformation::class,'usuario');
    }

    public function product($id)
    {   
        $product=Product::find($id);
        return $product;
    }

    public function address()
    {
        return $this->hasMany(Address::class, 'usuario');
    }

    public function paymentscard()
    {
        return $this->hasMany(PaymentInformation::class, 'usuario');
    }
    
    public function shipments()
    {
        return $this->hasMany(Shipment::class,'id_seller');
    }

    public function getTotalAttribute()
    {
        $cartUser= $this->carts()->where('status', 'Active')->get();
        $total=0;
        foreach($cartUser as $cartItem)
        {
            $total+=$cartItem->total;
        }
        return $total;
    }
    public function productIs($id)
    {   
        $band=false;
        $cart = $this->cart->get();
        foreach($cart as $cartItem)
        {
            if($cartItem->product_id==$id)
            {
                $band=true;
            }
        }
        return $band;

    }
    
    public function getCartAttribute()
    {
        $cart = $this->carts()->where('status', 'Active');
        if ($cart)
            return $cart;

        // else
        $cart = new Cart();
        $cart->status = 'Active';
        $cart->user_id = $this->id;
        $cart->save();

        return $cart;
    }

}
