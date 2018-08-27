<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;
use App\Cart;
use App\Brand;
use App\Product;
use App\Category;
use App\Shop;

class ShopController extends Controller
{

    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;

    public function show() {
        return view('shop.index');
    }

    /**
     * Display things for main index home page.
     *
     * @return $this
     */
    public function showproducts($id) {

        $categories = Category::pluck('category')->take(5);
        
        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        // Select all products where featured = 1,
        // order by random rows, and only take 4 rows from table so we can display them on the homepage.
        $products = Product::where('shop_id', '=', $id)->orderByRaw('RAND()')->paginate(6);
        //dd($products);

        //
        $banner = Shop::find($id);

        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();

        // Select all products with the newest one first, and where featured = 0,
        // order by random rows, and only take 8 rows from table so we can display them on the New Product section in the homepage.
        $new = Product::orderBy('created_at', 'desc')->where('featured', '=', 0)->orderByRaw('RAND()')->take(4)->get();

        
        return view('shop.index', compact('products', 'banner', 'brands', 'search', 'new', 'cart_count', 'rand_brands','categories'));
    }

}
