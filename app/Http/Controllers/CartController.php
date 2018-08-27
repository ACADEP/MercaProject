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
               
                $cart=new Cart;
                $cart->user_id=Auth::user()->id;
                $cart->status="Active";
                $cart->product_id=$product_id->id;
                $cart->product_price=$product_id->price;
                $cart->qty=1;
                $cart->total=$product_id->price;
                $cart->save();
                $itemCount=Auth::user()->carts->count();
                $product_id->setAttribute('total', Auth::user()->total);
            }
            
        }
        
        return response(['item'=>$product_id,'user' =>$user,'itemcount'=>$itemCount],200);
    

    }

    public function changeqty(Request $request){
        $price_unit=Cart::select('product_price')->where('id',$request->cart_id)->where('user_id',Auth::user()->id)->first();
        $cart=Cart::where('id',$request->cart_id)->where('user_id',Auth::user()->id);
        $cart->update(array(
            'qty'        => $request->qty,
            'total'      => $request->qty*(int)$price_unit->product_price,
        ));

        $cartUser=Auth::user()->cart->where('id',$request->cart_id)->get();
        return response($cartUser,200);
    }
    public function PDF(Request $request)
    {
        $items;
        if(Auth::check())
        {
            $items=Auth::user()->cart->with("product");
        }
        else
        {
            $items=json_decode($request->get('Items'));
        }
       
        $pdf = PDF::loadView('cart.Print-cart',compact('items'));
        return $pdf->download('Carrito.pdf');
      
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
        }
       
        
        // Then redirect back
        return response($cartItems,200);
    }
    
    
}
