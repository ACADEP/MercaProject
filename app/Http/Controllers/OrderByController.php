<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Shop;
use App\Category;
use Carbon\Carbon;
// use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        return view('category.show', ['products' => $products], compact('categories', 'category', 'brands', 'search', 'count', 'cart_count'));
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

        return view('category.show', ['products' => $products], compact('categories', 'category', 'brands', 'search', 'count', 'cart_count'));
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

        return view('category.show', ['products' => $products], compact('categories', 'category', 'brands', 'search', 'count', 'cart_count'));
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

        return view('category.show', ['products' => $products], compact('categories', 'category', 'brands','search', 'count', 'cart_count'));
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

        return view('category.show', ['products' => $products], compact('categories', 'category', 'brands', 'search', 'count', 'cart_count'));
    }




    /****************** Order By for Brands Section *******************************************************************/


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsPriceHighestBrand($id, Product $product) {

        // Get the Brand ID
        $brands = Brand::find($id);

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        $products = Product::orderBy('price', 'desc')->where('brand_id', '=', $id)->paginate(12);

        $orden = Brand::find($id); 

        $ordenamiento = "Precio Mayor";

        $query = $orden->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');
        
        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('brand.show', compact('products', 'brands', 'category', 'brand', 'categorias', 'ordenamiento', 'orden', 'categorias', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsPriceLowestBrand($id, Product $product) {


        // Get the Brand ID
        $brands = Brand::find($id);

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        $products = Product::orderBy('price', 'asc')->where('brand_id', '=', $id)->paginate(12);

        $orden = Brand::find($id); 

        $ordenamiento = "Precio Menor";

        $query = $orden->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');
        
        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('brand.show', compact('products', 'brands', 'category', 'brand', 'categorias', 'ordenamiento', 'orden', 'categorias', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }



    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsAlphaHighestBrand($id, Product $product) {

        // Get the Brand ID
        $brands = Brand::find($id);

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        $products = Product::orderBy('product_name', 'desc')->where('brand_id', '=', $id)->paginate(12);

        $orden = Brand::find($id); 

        $ordenamiento = "Productos Z-A";

        $query = $orden->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');
        
        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('brand.show', compact('products', 'brands', 'category', 'brand', 'categorias', 'ordenamiento', 'orden', 'categorias', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsAlphaLowestBrand($id, Product $product) {

        // Get the Brand ID
        $brands = Brand::find($id);

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $category = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        $products = Product::orderBy('product_name', 'asc')->where('brand_id', '=', $id)->paginate(12);


        $orden = Brand::find($id); 

        $ordenamiento = "Productos A-Z";

        $query = $orden->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');
        
        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('brand.show', compact('products', 'brands', 'category', 'brand', 'categorias', 'ordenamiento', 'orden', 'categorias', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function productsNewestBrand($id) {
        // Get the Brand ID
        // $brands = Brand::where('id', '=', $id)->get();
        $brands = Brand::find($id);

        // From Traits/BrandAll.php
        // Get all the Brands
        $brand = $this->brandsAll();

        $products = Product::orderBy('created_at', 'desc')->where('brand_id', '=', $id)->paginate(12);

        $orden = Brand::find($id); 

        $ordenamiento = "Popularidad";

        $query = $orden->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');
        
        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('brand.show', compact('products', 'brands', 'category', 'brand', 'categorias', 'ordenamiento', 'orden', 'categorias', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


    /****************** Order By for New Products Section *******************************************************************/

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function PriceHighestNew(Product $product) {

        // Order Products by price highest, where the category id = the URl route ID
        $news = Product::OrderByRaw('(price - reduced_price) DESC')->where('featured', '=', 0)->paginate(12);

        $ordenamiento = "Precio Mayor";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-newProducts', compact('news', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function PriceLowestNew() {

        // Order Products by price lowest, where the shop id = the URl route ID
        $news = Product::OrderByRaw('(price - reduced_price) ASC')->where('featured', '=', 0)->paginate(12);

        $ordenamiento = "Precio Menor";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-newProducts', compact('news', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function NewestNew() {

        // Order Products by price lowest, where the shop id = the URl route ID
        $news = Product::OrderBy('created_at', 'desc')->where('featured', '=', 0)->paginate(12);

        $ordenamiento = "Popularidad";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-newProducts', compact('news', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function AlphaLowestNew() {

        // Order Products by price lowest, where the shop id = the URl route ID
        $news = Product::OrderBy('product_name', 'asc')->where('featured', '=', 0)->paginate(12);

        $ordenamiento = "Productos A-Z";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-newProducts', compact('news', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function AlphaHighestNew() {

        // Order Products by price lowest, where the shop id = the URl route ID
        $news = Product::OrderBy('product_name', 'desc')->where('featured', '=', 0)->paginate(12);

        $ordenamiento = "Productos Z-A";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-newProducts', compact('news', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


    
    /****************** Order By for Offer Products Section *******************************************************************/
    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function PriceHighestOffers(Product $product) {

        // Order Products by price highest, where the category id = the URl route ID
        $products = Product::OrderByRaw('(price - reduced_price) DESC')->paginate(4);

        $ordenamiento = "Precio Mayor";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-offersProducts', compact('products', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function PriceLowestOffers() {

        // Order Products by price lowest, where the shop id = the URl route ID
        $products = Product::OrderByRaw('(price - reduced_price) ASC')->where('featured', 1)->paginate(12);

        $ordenamiento = "Precio Menor";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-offersProducts', compact('products', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function NewestOffers() {

        // Order Products by price lowest, where the shop id = the URl route ID
        $products = Product::OrderBy('created_at', 'desc')->where('featured', 1)->paginate(12);

        $ordenamiento = "Popularidad";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-offersProducts', compact('products', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function AlphaLowestOffers() {

        // Order Products by price lowest, where the shop id = the URl route ID
        $products = Product::OrderBy('product_name', 'asc')->where('featured', 1)->paginate(12);

        $ordenamiento = "Productos A-Z";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-offersProducts', compact('products', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function AlphaHighestOffers() {

        // Order Products by price lowest, where the shop id = the URl route ID
        $products = Product::OrderBy('product_name', 'desc')->where('featured', 1)->paginate(12);

        $ordenamiento = "Productos Z-A";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-offersProducts', compact('products', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


    /****************** Order By for Search Products Section *******************************************************************/
    public function OrderQueries(Request $request){
        // dd($request);
        $search_find = $request->search_find;

        $query=Product::select("products.*")->join('brands', 'brand_id', '=', 'brands.id')
        ->join('categories', 'cat_id', '=', 'categories.id');  

        if ($request->Popularidad == 1) {
            $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->OrderBy('created_at', 'desc');
            $query = $query->orWhere("category", 'LIKE', "%$search_find%")->OrderBy('created_at', 'desc');
            $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->OrderBy('created_at', 'desc');
            $query = $query->orWhere("description", 'LIKE', "%$search_find%")->OrderBy('created_at', 'desc');
            $search = $query->paginate(4);
            $ordenamiento = "Popularidad";
            
        } elseif ($request->Menor == 2) {
            $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->OrderByRaw('(price - reduced_price) ASC');
            $query = $query->orWhere("category", 'LIKE', "%$search_find%")->OrderByRaw('(price - reduced_price) ASC');
            $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->OrderByRaw('(price - reduced_price) ASC');
            $query = $query->orWhere("description", 'LIKE', "%$search_find%")->OrderByRaw('(price - reduced_price) ASC');
            $search = $query->paginate(4);
            $ordenamiento = "Precio Menor";

        } elseif ($request->Mayor == 3) {
            $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->OrderByRaw('(price - reduced_price) DESC');
            $query = $query->orWhere("category", 'LIKE', "%$search_find%")->OrderByRaw('(price - reduced_price) DESC');
            $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->OrderByRaw('(price - reduced_price) DESC');
            $query = $query->orWhere("description", 'LIKE', "%$search_find%")->OrderByRaw('(price - reduced_price) DESC');
            $search = $query->paginate(4);
            $ordenamiento = "Precio Mayor";

        } elseif ($request->AZ == 4) {
            $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->OrderBy('product_name', 'asc');
            $query = $query->orWhere("category", 'LIKE', "%$search_find%")->OrderBy('product_name', 'asc');
            $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->OrderBy('product_name', 'asc');
            $query = $query->orWhere("description", 'LIKE', "%$search_find%")->OrderBy('product_name', 'asc');
            $search = $query->paginate(4);
            $ordenamiento = "Productos A-Z";

        } elseif ($request->ZA == 5) {
            $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->OrderBy('product_name', 'desc');
            $query = $query->orWhere("category", 'LIKE', "%$search_find%")->OrderBy('product_name', 'desc');
            $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->OrderBy('product_name', 'desc');
            $query = $query->orWhere("description", 'LIKE', "%$search_find%")->OrderBy('product_name', 'desc');
            $search = $query->paginate(4);
            $ordenamiento = "Productos Z-A";    
        }

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.search', compact('search', 'search_find', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function OrderSelledproducts(Request $request) {
        $date = Carbon::now();
        $endDate = $date->subMonth(3);
        
        $query=Product::select("products.*")->join('customer_histories', 'products.id', '=', 'customer_histories.product_id')
        ->join('sales', 'customer_histories.sale_id', '=', 'sales.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id');

        $query=$query->select(\DB::raw("products.*, SUM(customer_histories.amount) as ventas"))
            ->where('sales.status_pago', 'Acreditado')
            ->where("sales.date",">",$endDate)
            ->groupBy("products.id");

        if ($request->Menor == 1) {
            $selledProducts = $query->OrderByRaw('(price - reduced_price) ASC')->paginate(12);
            $ordenamiento = "Precio Menor";
        } elseif ($request->Mayor) {
            $selledProducts = $query->OrderByRaw('(price - reduced_price) DESC')->paginate(12);
            $ordenamiento = "Precio Mayor";
        } elseif ($request->AZ) {
            $selledProducts = $query->OrderBy('product_name', 'ASC')->paginate(12);
            $ordenamiento = "Productos A-Z";
        } elseif ($request->ZA) {
            $selledProducts = $query->OrderBy('product_name', 'DESC')->paginate(12);
            $ordenamiento = "Productos Z-A";    
        }

        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-selledProducts',compact('selledProducts', 'previousURL', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    


}