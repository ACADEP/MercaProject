<?php

namespace App\Http\Controllers;

use App\Cart;
use Validator;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;

class CartController extends Controller {

    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;


    /**
     * CartController constructor.
     */
    // public function __construct() {
    //     $this->middleware('auth');
        
    //     parent::__construct();
    // }

    public function showCart() {

        return view('cart.cart'); 
            
    }


    /**
     * Agregar productos al carrito
    
     */
    public function addCart(Request $request) {

    
        // Identificar si es visitante o usuario registrado
        if(Auth::user()==null)
        {
            $var="si";
        }
        else
        {
            $var="no";
        }
    
        $product_id=Product::find($request->product_id);
        
       
        // then redirect back
        // return response($request->product_id, 200);
        return  response()->json([
            'product' => $product_id,
        ]);

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
    

    /**
     * Delete a product from a users Cart
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        // Find the Carts table and given ID, and delete the record
        Cart::find($id)->delete();

        // Then redirect back
        return redirect()->back();
    }
    
    
}
