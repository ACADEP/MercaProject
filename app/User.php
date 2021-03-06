<?php

namespace App;

use App\Customer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\ApiRequest;
use Carbon\Carbon;



class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    // use Billable;
    
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

    public function getRouteKeyName()
    {
        return 'username';
    }
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


    /**
     * Asignar la direccion agregada como activa
     *
     * @var address Direccion agregada
     * 
     */ 
    public function setAddressActive($newAddress)
    {
        //Desactivar todas sus direcciones
        foreach ($this->address()->get() as $address) {
            $address->activo=0;
            $address->save();
        }

        //Asignar la nueva direccion como activa
        $newAddress->activo=1;
        $newAddress->save();

        return $newAddress;
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

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function customer()
    {
        return $this->hasOne(Customer::class,"usuario");
    }
    public function ordersOxxo()
    {
        return $this->hasMany(Order::class);
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

    public function addressActive()
    {
        $addresses=$this->address()->get();
        $address_active="";
        foreach($addresses as $address)
        {
            if($address->activo==1)
            {
                $address_active=$address;
            }
        }
        return $address_active;
    }

    public function updateAddressActive($id)
    {
        $addresses=$this->address()->get();
        foreach($addresses as $address)
        {
            $address->activo=0;
            $address->update();
        }
        $addressActive=$this->address()->where("id",$id)->first();
        if($addressActive!=null)
        {
            $addressActive->activo=1;
            $addressActive->update();
        }
        

        return $addressActive;
    }
    public function valFavorite($product_id)
    {
        $band=true;
        $favorites=$this->favorites()->get();
        foreach($favorites as $favorite)
        {
            if($favorite->product->id == $product_id)
            {
                $band=false;
            }
        }
        return $band;
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

    public function getTotalCheckedAttribute()
    {
        $cartUser= $this->carts()->where('status', 'Active')->get();
        $total=0;
        $api_request=new ApiRequest;

        foreach($cartUser as $cartItem)
        {
         
            $totalChecked=ApiRequest::checkPrice($cartItem->product_sku);
            if($totalChecked > 0) //Checar el precio 0=elimnar
            {
                $total+=$totalChecked;
                $cartItem->total=$totalChecked;
                $cartItem->checked_date=$date_now->format("Y-m-d");
                $cartItem->save();
            }
            else
            {
                $cartItem->delete();
            }
            
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

    public function insert($username, $email, $pass, $company_id)
    {
        $this->username=$username;
        $this->company_id=$company_id;
        $this->email=$email;
        $this->password= bcrypt($pass);
        $this->verified=1;
        $this->admin=0;
        $this->save();
    }

    public function updateU($username, $email, $pass)
    {
        $this->username=$username;
        $this->email=$email;
        if($pass!=null)
        {
            $this->password= bcrypt($pass);
        }
        $this->save();
    }

    public function getRoleDisplayNames()
    {
        return $this->roles->pluck('display_name')->implode(', ');
    }

}
