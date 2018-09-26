<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;
use App\User;
use App\Order;
use App\Product;
use App\Shop;
use App\Address;
use App\PaymentInformation;


class CustomerController extends Controller
{
    use SearchTrait, CartTrait;

    /**
     * Display Profile contents
     *
     * @return mixed
     */
    public function index() {
        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        // Get the currently authenticated user
        $username = \Auth::user();

        // Set user_id to the currently authenticated user ID
        $user_id = $username->id;

        // Select all from "Orders" where the user_id = the ID og the signed in user to get all their Orders
        $orders = Order::where('user_id', '=', $user_id)->get();

        return view('customer.dash', compact('search', 'cart_count', 'username', 'orders'));
    }

    

}
