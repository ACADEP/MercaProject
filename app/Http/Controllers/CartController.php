<?php

namespace App\Http\Controllers;

use App\Cart;
use Validator;
use App\Product;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

use Laravel\Cashier\CashierServiceProvider;
use Laravel\Cashier\Cashier;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;

use Barryvdh\DomPDF\Facade as PDF;

class CartController extends Controller {

    use BrandAllTrait, CategoryTrait, SearchTrait;

    public function showCart() {

        return view('cart.cart'); 
            
    }


    /**
     * Agregar productos al carrito
     */
    public function addCart(Request $request) {

        //Buscar el producto para agregar al carrito
        $product_id=Product::find($request->product_id);
        $product_id->setAttribute('qty', 1);
        // Identificar si es visitante o usuario registrado
        $user=0;
        $itemCount=0;
        if(Auth::check())
        { 
            $user=1;
            if(Auth::user()->productIs($product_id->id))
            {  
                
            }
            else
            {
                $product_total=$product_id->price-$product_id->reduced_price;
                $cart=new Cart;
                $cart->user_id=Auth::user()->id;
                $cart->status="Active";
                $cart->product_id=$product_id->id;
                $cart->product_price=$product_total;
                $cart->qty=1;
                $cart->total=$product_total;
                $cart->save();
                $itemCount=Auth::user()->carts->count();
                $product_id->setAttribute('total', Auth::user()->total);
            }
            
        }
        
        return response(['item'=>$product_id,'user' =>$user,'itemcount'=>$itemCount],200);
    

    }

    public function changeqty(Request $request){
        $cart=Cart::where('id',$request->cart_id)->where('user_id',Auth::user()->id);
        $product_price=Cart::where('id',$request->cart_id)->where('user_id',Auth::user()->id)->get();
        
        $cart->update(array(
            'qty'        => $request->qty,
            'total'      => $request->qty*$product_price[0]->product_price,
        ));

        $cartUser=Auth::user()->cart->where('id',$request->cart_id)->get();
        $totalCart=Auth::User()->total;
        return response(['cartUser'=>$cartUser,'totalCart'=>$totalCart],200);
    }
    public function PDF(Request $request)
    {
        $items;
        if(Auth::check())
        {
            $items=Auth::user()->cart->with("product")->get();
        }
        else
        {
            $items=json_decode($request->get('Items'));
        }
       
        $pdf = PDF::loadView('cart.Print-cart',compact('items'));
        return $pdf->stream('Carrito.pdf');
      
    }

    /**
     * Update the Cart
     * 
     * @return mixed
     */
    public function update() {
        
        // Set $user_id to the currently signed in user ID
        $user_id = Auth::user()->id;

        // Set the $qty to the quantity of products selected
        $qty = Input::get('qty');

        // Set $product_id to the hidden product input field in the update cart from
        $product_id = Input::get('product');

        // Set $cart_id to the hidden cart_id input field in the update cart from
        $cart_id = Input::get('cart_id');
        
        // Find the ID of the products in the Cart
        $product = Product::find($product_id);

        if ($product->reduced_price == 0) {
            $total = $qty * $product->price;
        } else {
            $total = $qty * $product->reduced_price;
        }

        // Select ALL from cart where the user ID = to the current logged in user, product_id = the current product ID being updated, and the cart_id = to the cartId being updated
        $cart = Cart::where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->where('id', '=', $cart_id);

        // Update your cart
        $cart->update(array(
            'user_id'    => $user_id,
            'product_id' => $product_id,
            'qty'        => $qty,
            'total'      => $total
        ));

        return redirect()->route('cart');
    }
    
    
    
    public function delete(Request $request) {
        // Find the Carts table and given ID, and delete the record
       
        $cartDestroy=Cart::destroy($request->cart_id);
        $cartItems;
        if(Auth::check())
        {
            $cartItems=Auth::user()->cart->with('product')->get();
            $TotalUser=Auth::user()->total;
        }
       
        
        // Then redirect back
        return response(['cartItems'=>$cartItems,'totalUser'=>$TotalUser ],200);
    }

    public function showPaymentCardCredit() {
        return view('cart.cart-payment');
    }

    public function showPaymentCardCreditSuccess(Request $request) {
        //dd($request);
        return back()->with('flash','Pago exitoso');
    }


    public function stripe() {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        try {
            if(!isset($_POST['stripeToken'])) {
                throw new \Exception("El token de Stripe no fue generado correctamente");
            } else {
                $token = $_POST['stripeToken'];
                // dd($token);
                $charge = \Stripe\Charge::create([
                    'amount' => 1000, // Ingresar cantidad en centavos 100 centavos = $1 peso, 
                    'currency' => 'mxn', // monto minimo que acepta Stripe es de $10 pesos
                    'description' => 'Pago de Xbox One',
                    'source' => $token,
                ]);  
                dd($charge);  
                return view('cart.cart-confirmation');
                echo("Pago realizado con exito");
            }    
        }
        catch(Exeption $e) {
            $error = $e->getMessage();
        }

    }
    
    public function paypal(Request $request) {
        return view('cart.cart-confirmation');
    }

    
}
