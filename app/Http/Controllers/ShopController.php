<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Product;
use App\Shop;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;

class ShopController extends Controller
{
    use SearchTrait, CartTrait;

    public function show() {
        return view('shop.index');
    }

    /**
     * Display things for main index home page.
     *
     * @return $this
     */
    public function showproducts($id) {

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        // Select all products where featured = 1,
        // order by random rows, and only take 4 rows from table so we can display them on the homepage.
        $products = Product::where('shop_id', '=', $id)->orderBy('product_name')->paginate(9);
        //dd($products);

        $orden = "Ordenar Por";

        $banner = Shop::find($id);
        
        $relacion = false;
        return view('shop.index', compact('products', 'banner', 'search', 'cart_count', 'relacion', 'orden'));
    }

}
