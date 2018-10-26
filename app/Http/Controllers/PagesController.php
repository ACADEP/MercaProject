<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Brand;
use App\Product;
use App\Shop;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;


class PagesController extends Controller {

    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;


    /**
     * Display things for main index home page.
     *
     * @return $this
     */
    public function index() {

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
        $products = Product::where('featured', '=', 1)->orderByRaw('RAND()')->take(12)->get();

        $rand_brands = Brand::orderByRaw('RAND()')->take(8)->get();

        $rand_shops = Shop::orderByRaw('RAND()')->take(8)->get();

        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        // Select all products with the newest one first, and where featured = 0,
        // order by random rows, and only take 8 rows from table so we can display them on the New Product section in the homepage.
        $new = Product::orderBy('created_at', 'desc')->where('featured', '=', 0)->orderByRaw('RAND()')->take(12)->get();

        
        return view('pages.index', compact('products', 'brands', 'previousURL', 'search', 'new', 'cart_count', 'rand_shops', 'rand_brands','categories'));
    }

    /**
     * Display Products by Category.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayProducts($id) {

        // Get the Category ID , so we can display the category name under each list view
        $categories = Category::where('id', '=', $id)->get();

        $categories_find = Category::where('id', '=', $id)->find($id);

        // If no category exists with that particular ID, then redirect back to Home page.
        if (!$categories_find) {
            return redirect('/');
        }

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // Get the Products under the Category ID
        $products = Product::where('cat_id','=', $id)->get();

        // Count the products under a certain category
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('category.show', compact('products', 'categories','brands', 'category', 'search', 'cart_count'))->with('count', $count);
    }


    /** Display Products by Brand
     *
     * @param $id
     * @return $this
     */
    public function displayProductsByBrand($id) {

        // Get the Brand ID , so we can display the brand name under each list view
        // $brands = Brand::where('id', '=', $id)->get();
        $brands = Brand::find($id);

        $orden = Brand::find($id); 

        $brands_find = Brand::where('id', '=', $id)->find($id);

        // If no brand exists with that particular ID, then redirect back to Home page.
        if (!$brands_find) {
            return redirect('/');
        }

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // Get the Products under the Brand ID
        $products = Product::where('brand_id', '=', $id)->get();

        // Count the products under a certain brand
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        $ordenamiento = "Ordenar Por";

        $query = $orden->product();
        $querybrands = $orden->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  
        $querybrands = $querybrands->join('brands', 'brand_id', '=', 'brands.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');

        $marcas = array();
        $marcas['id'] = $querybrands->select("brands.id")->groupBy('brands.id')->pluck('brands.id');
        $marcas['brand_name'] = $querybrands->select("brand_name")->groupBy('brand_name')->pluck('brand_name');

        $brandRoute = 1;
        $shopRoute = null;
        $offersRoute = null;
        $newsRoute = null;
        $categoryRoute = null;

        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        return view('brand.show', compact('products', 'brands', 'marcas', 'categorias', 'ordenamiento', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden', 'previousURL', 'brand', 'category', 'search', 'cart_count'));
    }

    public function displayAllCategories()
    {
        $categories = Category::all();
        $previousURL = url()->previous();
        return view('pages.categories',compact('categories', 'previousURL'));
    }

    public function displayAllBrands()
    {
        $brands = Brand::orderBy('brand_name')->paginate(12);
        //previous URL for breadcrumbs
        $previousURL = url()->previous();
        return view('pages.partials.all-brands',compact('brands', 'previousURL'));
    }

    public function displayAllShops()
    {
        $shops = Shop::orderBy('name')->paginate(12);
        //previous URL for breadcrumbs
        $previousURL = url()->previous();
        return view('pages.partials.all-shops',compact('shops', 'previousURL'));
    }

    public function displayAllNewProducts()
    {
        $news = Product::orderBy('created_at', 'desc')->where('featured', '=', 0)->paginate(12);
        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        $ordenamiento = "Ordenar Por";

        $orden = Product::orderBy('created_at', 'desc')->where('featured', '=', 0)->get();

        $query = $orden;
        $querybrands = $orden;

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  
        $querybrands = $querybrands->join('brands', 'brand_id', '=', 'brands.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');

        $marcas = array();
        $marcas['id'] = $querybrands->select("brands.id")->groupBy('brands.id')->pluck('brands.id');
        $marcas['brand_name'] = $querybrands->select("brand_name")->groupBy('brand_name')->pluck('brand_name');

        $brandRoute = null;
        $shopRoute = null;
        $offersRoute = null;
        $newsRoute = 1;
        $categoryRoute = null;

        return view('pages.partials.all-newProducts',compact('news', 'previousURL', 'marcas', 'categorias', 'ordenamiento', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden'));
    }

    public function displayAllOffersProducts()
    {
        $products = Product::where('featured', '=', 1)->paginate(12);
        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        $ordenamiento = "Ordenar Por";

        $orden = null;

        $categorias = Category::all();

        $marcas = Brand::all();
        // dd($marcas);
        $brandRoute = null;
        $shopRoute = null;
        $offersRoute = 1;
        $newsRoute = null;
        $categoryRoute = null;

        return view('pages.partials.all-offersProducts',compact('products', 'previousURL', 'marcas', 'categorias', 'ordenamiento', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden'));
    }

}