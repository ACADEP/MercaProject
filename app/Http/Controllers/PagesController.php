<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Brand;
use App\Product;
use App\Shop;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;

use Illuminate\Support\Facades\Auth;


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

   
    public function displayProducts(Category $category) {
        $productscat=$category->products();
        if($category->totalSubcategories() > 0)
        {
            foreach($category->children()->get() as $sub)
            {
                $productscat=$productscat->union($sub->products());
            }
        }
        $products=$productscat->get();
        return view("pages.products-category", compact('products'));
       
    }
    public function orderCategories(Category $category ,Request $request)
    {
      
        $productscat=$category->products();
        $products=null;
        $order=$request->get("orderBy");
        if($category->totalSubcategories() > 0)
        {
            foreach($category->children()->get() as $sub)
            {
                $productscat=$productscat->union($sub->products());
            }
        }
        if($request->get("orderBy")==1)
        {
            $products= $productscat->orderByRaw('(price - reduced_price)')->get();
        }
        else if($request->get("orderBy")==2)
        {
            $products= $productscat->orderByRaw('(price - reduced_price) DESC')->get();
        }
        else if($request->get("orderBy")==3)
        {
            $products= $productscat->orderBy("product_name")->get();
        }
        else if($request->get("orderBy")==4)
        {
            $products= $productscat->orderBy("product_name", "desc")->get();
        }
        else
        {
            $products= $productscat->get();
        }

        return view("pages.products-category", compact('products','order'));
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
        $categoriesall = Category::where('parent_id', 0)->get();
      
        return view('pages.categories',compact('categoriesall'));
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