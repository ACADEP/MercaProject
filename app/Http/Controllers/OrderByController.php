<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Shop;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;



class OrderByController extends ProductsController {

    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;


    /****************** Order By for Category Section *****************************************************************/


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsPriceHighest($id, Product $product) {

        // Get the Category ID
        $categories = Category::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // Order Products by price highest, where the category id = the URl route ID
        $products = Product::orderBy('price', 'desc')->where('cat_id', '=', $id)->paginate(15);

        // Count the Products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('category.show', ['products' => $products], compact('categories', 'shop', 'category', 'brands', 'search', 'count', 'cart_count'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsPriceLowest($id, Product $product) {

        // Get the Category ID
        $categories = Category::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // Order Products by price lowest, where the category id = the URl route ID
        $products = Product::orderBy('price', 'asc')->where('cat_id', '=', $id)->paginate(15);

        // Count the Products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('category.show', ['products' => $products], compact('categories', 'shop', 'category', 'brands', 'search', 'count', 'cart_count'));
    }



    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsAlphaHighest($id, Product $product) {

        // Get the Category ID
        $categories = Category::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // Order Products by Alphabet Descending, where the category id = the URl route ID
        $products = Product::orderBy('product_name', 'desc')->where('cat_id', '=', $id)->paginate(15);

        // Count the Products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('category.show', ['products' => $products], compact('categories', 'shop', 'category', 'brands', 'search', 'count', 'cart_count'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsAlphaLowest($id, Product $product) {

        // Get the Category ID
        $categories = Category::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // Order Products by Alphabet Ascending, where the category id = the URl route ID
        $products = Product::orderBy('product_name', 'asc')->where('cat_id', '=', $id)->paginate(15);

        // Count the Products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('category.show', ['products' => $products], compact('categories', 'shop', 'category', 'brands','search', 'count', 'cart_count'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsNewest($id, Product $product) {

        // Get the Category ID
        $categories = Category::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // Order Products by newest products, where the category id = the URl route ID
        $products = Product::orderBy('created_at', 'desc')->where('cat_id', '=', $id)->paginate(15);

        // Count the products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('category.show', ['products' => $products], compact('categories', 'shop', 'category', 'brands', 'search', 'count', 'cart_count'));
    }




    /****************** Order By for Brands Section *******************************************************************/


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsPriceHighestBrand($id, Product $product) {

        // Get the Brand ID
        $brands = Brand::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        $products = Product::orderBy('price', 'desc')->where('brand_id', '=', $id)->paginate(15);

        // Count the products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        $orden = Brand::find($id); 

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


        return view('brand.show', ['products' => $products], compact('brands', 'shop', 'brand', 'category', 'search', 'count', 'cart_count', 'marcas', 'categorias', 'ordenamiento', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsPriceLowestBrand($id, Product $product) {


        // Get the Brand ID
        $brands = Brand::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        $products = Product::orderBy('price', 'asc')->where('brand_id', '=', $id)->paginate(15);

        // Count the products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        $orden = Brand::find($id); 

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


        return view('brand.show', ['products' => $products], compact('brands', 'shop', 'category', 'brand', 'search', 'count', 'cart_count', 'marcas', 'categorias', 'ordenamiento', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden'));
    }



    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsAlphaHighestBrand($id, Product $product) {

        // Get the Brand ID
        $brands = Brand::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        $products = Product::orderBy('product_name', 'desc')->where('brand_id', '=', $id)->paginate(15);

        // Count the products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        $orden = Brand::find($id); 
        
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


        return view('brand.show', ['products' => $products], compact('brands', 'shop', 'category', 'brand', 'search', 'count', 'cart_count', 'marcas', 'categorias', 'ordenamiento', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsAlphaLowestBrand($id, Product $product) {

        // Get the Brand ID
        $brands = Brand::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        $products = Product::orderBy('product_name', 'asc')->where('brand_id', '=', $id)->paginate(15);

        // Count the products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        $orden = Brand::find($id); 

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


        return view('brand.show', ['products' => $products], compact('brands', 'shop', 'category', 'brand', 'search', 'count', 'cart_count', 'marcas', 'categorias', 'ordenamiento', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsNewestBrand($id, Product $product) {

        // Get the Brand ID
        $brands = Brand::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        $products = Product::orderBy('created_at', 'desc')->where('brand_id', '=', $id)->paginate(15);

        // Count the products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        $orden = Brand::find($id); 

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


        return view('brand.show', ['products' => $products], compact('brands', 'shop', 'category', 'brand', 'search', 'count', 'cart_count', 'marcas', 'categorias', 'ordenamiento', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden'));
    }


    /****************** Order By for Shops Section *******************************************************************/

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsPriceHighestShop($id, Product $product) {

        // Get the Shop ID
        $shops = Shop::where('id', '=', $id)->get();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // Order Products by price highest, where the category id = the URl route ID
        $products = Product::orderBy('price', 'desc')->where('shop_id', '=', $id)->paginate(6);

        // Count the Products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('shop.index', ['products' => $products], compact('shops', 'category', 'brands', 'search', 'count', 'cart_count'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsPriceLowestShop($id) {

        // Get the Shop ID
        $shops = Shop::find($id);

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // Order Products by price lowest, where the shop id = the URl route ID
        $products = Product::orderBy('price', 'asc')->where('shop_id', '=', $id)-get();

        // Count the Products
        $count = $products->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('shop.index', compact('shops', 'category', 'brands', 'search', 'count', 'cart_count'));
    }


}