<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Brand;
use App\Sale;
use App\Product;
use App\CustomerHistory;
use App\Shop;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;
use App\ApiRequest;

use Illuminate\Support\Facades\Auth;


class PagesController extends Controller {

    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;


    /**
     * Display things for main index home page.
     *
     * @return $this
     */
    public function index() {
        // $requestAPI=ApiRequest::ProductbyBrand("SYMANTEC / NORTON");
        // dd($requestAPI);

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
        $products = Product::where('featured', '=', 1)->where("product_qty",">",0)->orderBy('reduced_price','asc')->take(12)->get();

        $date = Carbon::now();
        $endDate = $date->subMonth(3);
        
        $query=Product::select("products.*")->join('customer_histories', 'products.id', '=', 'customer_histories.product_id')
        ->join('sales', 'customer_histories.sale_id', '=', 'sales.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id');

        $query=$query->select(\DB::raw("products.id, products.product_name, products.description, products.price, products.reduced_price, brands.brand_name, products.company_id, SUM(customer_histories.amount) as ventas"))
        ->where('sales.status_pago', 'Acreditado')->where("sales.date",">",$endDate)
        ->groupBy("products.id", "products.product_name", "products.description", "products.price", "products.reduced_price", "brands.brand_name", "products.company_id")
        ->orderBy("ventas", "desc");        
        $selledProducts = Product::wherein('id', $query->pluck('id'))->OrderBy('company_id','ASC')->take(12)->get();

        $rand_brands = Brand::orderByRaw('RAND()')->take(8)->get();

        $rand_shops = Shop::orderByRaw('RAND()')->take(8)->get();

        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        //asdasdlakdjsalkdjs Jonasd

        // Select all products with the newest one first, and where featured = 0,
        // order by random rows, and only take 8 rows from table so we can display them on the New Product section in the homepage.
        $new = Product::where('featured', '=', 0)->OrderBy('company_id','ASC')->take(12)->get();


        
        return view('pages.index', compact('products', 'brands', 'previousURL', 'search', 'new', 'cart_count', 'rand_shops', 'rand_brands','categories', 'selledProducts'));
    }

    public function about() {
        return view('pages.about');
    }

    public function help() {
        return view('pages.help');
    }

    public function displayProducts(Category $category) {
        $productscat = $category->products();
        if($category->totalSubcategories() > 0)
        {
            foreach($category->children()->get() as $sub)
            {
                $productscat = $productscat->union($sub->products());
            }
        }
        $products = $productscat->paginate(12);
        
        $ordenamiento = "Ordenar Por";

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        $querybrands = $productscat;

        $querybrands = $querybrands->join('brands', 'brand_id', '=', 'brands.id');  

        $marcas = array();
        $marcas['id'] = $querybrands->select("brands.id")->groupBy('brands.id')->pluck('brands.id');
        $marcas['brand_name'] = $querybrands->select("brand_name")->groupBy('brand_name')->pluck('brand_name');

        return view("pages.products-category", compact('products', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels', 'marcas'));
    }

    public function orderCategories(Category $category ,Request $request)
    {
        $productscat=$category->products();
        $querybrands=$category->products();
        $products=null;
         
        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        $querybrands = $querybrands->join('brands', 'brand_id', '=', 'brands.id');  

        $marcas = array();
        $marcas['id'] = $querybrands->select("brands.id")->groupBy('brands.id')->pluck('brands.id');
        $marcas['brand_name'] = $querybrands->select("brand_name")->groupBy('brand_name')->pluck('brand_name');

        
        if($category->totalSubcategories() > 0)
        {
            foreach($category->children()->get() as $sub)
            {
                $productscat=$productscat->union($sub->products());
            }
        }
      
        if($request->get("Menor")==1)
        {
            $products= $productscat->orderByRaw('(price - reduced_price)')->Paginate(12);
            $ordenamiento = "Precio Menor";
        }
        else if($request->get("Mayor")==2)
        {
            $products= $productscat->orderByRaw('(price - reduced_price) DESC')->Paginate(12);
            $ordenamiento = "Precio Mayor";
        }
        else if($request->get("AZ")==3)
        {
            $products= $productscat->orderBy("product_name")->Paginate(12);
            $ordenamiento = "Productos A-Z";
        }
        else if($request->get("ZA")==4)
        {
            $products= $productscat->orderBy("product_name", "desc")->Paginate(12);
            $ordenamiento = "Productos Z-A";    
        }
        else
        {
            $products= $productscat->Paginate(12);
        }

        return view("pages.products-category", compact('products', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels', 'marcas'));
    }


    /** Display Products by Brand
     *
     * @param $id
     * @return $this
     */
    public function displayProductsByBrand($id) {

        // Get the Brand ID , so we can display the brand name under each list view
        // $brands = Brand::where('id', '=', $id)->get();
        // dd($id);
        $brands = Brand::find($id);
        $idbrand = $id;

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
        $products = Product::where('brand_id', '=', $id)->Paginate(12);

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

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        //previous URL for breadcrumbs
        $previousURL = url()->previous();
        // dd($idbrand);

        return view('brand.show', compact('products', 'brands', 'orden', 'previousURL', 'brand', 'category', 'search', 'cart_count', 'ordenamiento', 'marcas', 'categorias', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels', 'idbrand'));
    }

    public function displayAllCategories()
    {
        $categoriesall = Category::where('parent_id', 0)->get();
      
        return view('pages.categories',compact('categoriesall'));
    }

    public function displayAllBrands()
    {
        $brands = Brand::orderBy('brand_name')->paginate(12);
        // dd($brands);
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
        $news = Product::where('featured', '=', 0)->OrderBy('company_id','ASC')->paginate(12);
        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        $ordenamiento = "Ordenar Por";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-newProducts',compact('news', 'previousURL', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function displayAllSelledProducts()
    {
        $date = Carbon::now();
        // $endDate = $date->subDay(3);
        $endDate = $date->subMonth(3);
        // $endDate = $endDate->format('Y-m-d H:i:s');
        
        $query=Product::select("products.*")->join('customer_histories', 'products.id', '=', 'customer_histories.product_id')
        ->join('sales', 'customer_histories.sale_id', '=', 'sales.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id');

        $query=$query->select(\DB::raw("products.*, products.brand_id, products.product_name, products.description, products.price, products.reduced_price, brands.brand_name, products.company_id, SUM(customer_histories.amount) as ventas"))
            // ->where('sales.status_pago', 'Pago por acreditar')
            ->where('sales.status_pago', 'Acreditado')
            ->where("sales.date",">",$endDate)
            ->groupBy("products.id", 'products.brand_id' ,"products.product_name", "products.description", "products.price", "products.reduced_price", "brands.brand_name", "products.company_id")->with("brand")->orderBy("ventas", "desc");
        $selledProducts = $query->OrderBy('products.product_name','ASC')->paginate(12);
        //$selledProducts = Product::wherein('id', $query->select("products.id"))->OrderBy('company_id','ASC')->paginate(12);
        
        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        $ordenamiento = "Ordenar Por";

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-selledProducts',compact('selledProducts', 'previousURL', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }

    public function displayAllOffersProducts()
    {
        $products = Product::where('featured', '=', 1)->OrderBy('company_id','ASC')->paginate(12);
        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        $ordenamiento = "Ordenar Por";

        $orden = null;

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        return view('pages.partials.all-offersProducts',compact('products', 'previousURL', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }




    public function filtrosNuevos(Request $request) {
        // dd($request);
        // $products = "";
        $brandFilter = $request->brand;
        $catFilter = $request->categories;
        $minFilter = $request->desde;
        $maxfilter = $request->hasta;
        $labels = 1;
        // dd($brandFilter);

        $categorias = Category::all();
        $marcas = Brand::all();

        $hasta = $request->hasta;
        $desde = $request->desde;
        $d = $request->desde;
        $h = $request->hasta;


        $marc = array();
        $marca =  array();
        $cat = array();
        $categoria = array();
        if($request->fil == 0) {
            $d = $request->desde;
            $h = $request->hasta;
            $desde = json_decode($d);
            $hasta = json_decode($h);

            $cb = $request->brand;
            $m = null;
            $c = 0;
            for ($i=0; $i < strlen($request->brand); $i++) { 
                if($i+1 == strlen($request->brand)) {
                    $m = $m.$cb[$i];
                    $marc[$c] = $m;
                } elseif ($cb[$i] != ",") {
                    $m = $m.$cb[$i];
                } elseif ($cb[$i] == ",") {
                    $marc[$c] = $m;
                    $m = null;
                    $c++;
                }
            }
            // dd($marc);
            $marca = Brand::wherein('brand_name', $marc)->get();
            // dd($marca);

            $cc = $request->categories;
            $ca = null;
            $a = 0;
            for ($i=0; $i < strlen($request->categories); $i++) { 
                if($i+1 == strlen($request->categories)) {
                    $ca = $ca.$cc[$i];
                    $cat[$a] = $ca;
                } elseif ($cc[$i] != ",") {
                    $ca = $ca.$cc[$i];
                } elseif ($cc[$i] == ",") {
                    $cat[$a] = $ca;
                    $ca = null;
                    $a++;
                }
            }
            // dd($marc);
            $categoria = Category::wherein('category', $cat)->get();
            // dd($categoria);

            $brandFilter = $marca;
            $catFilter = $categoria;
            $minFilter = $desde;
            $maxfilter = $hasta;
            $labels = 0;
            // dd($maxfilter);
        }

        $ordenamiento = "Ordenar Por";
        // $products = Product::OrderBy('price')->where('shop_id', '=', $request->id)->where('price', '>=', $request->desde)->Paginate(5);

        // Filtro por Precio Maximo
        if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $news = Product::OrderByRaw('(price - reduced_price) DESC')->where('price', '<=', $request->hasta)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::OrderByRaw('(price - reduced_price) DESC')->where('price', '<=', $hasta)->where('featured', '=', 0)->paginate(12);
            }        

        } // Filtro por Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)->where('featured', '=', 0)->paginate(12);
            }       

        } // Filtro por Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->where('price', '<=', $hasta)->where('featured', '=', 0)->paginate(12);
            }            

        } // Filtro por Marca
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $news = Product::whereIn('brand_id', $request->brand)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::whereIn('brand_id', $marca)->where('featured', '=', 0)->paginate(12);
            }       

        } // Filtro por Categoria
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $news = Product::whereIn('cat_id', $request->categories)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::whereIn('cat_id', $categoria)->where('featured', '=', 0)->paginate(12);
            }

        } // Filtro por Marca y Categoria
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $news = Product::whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->where('featured', '=', 0)->paginate(12);
            }

        } // Filtro por Marca y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->where('featured', '=', 0)->paginate(12);
            }  

        } // Filtro por Marca y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->where('featured', '=', 0)->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('cat_id', $categoria)->where('featured', '=', 0)->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria)->where('featured', '=', 0)->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->where('featured', '=', 0)->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->where('featured', '=', 0)->paginate(12);
            }
            
        } // Filtro por Marca, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('brand_id', $request->brand)->where('featured', '=', 0)->paginate(12);
            } else {
                $news =  Product::where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_id', $marca)
                ->orderByRaw('(price - reduced_price) ASC')->where('featured', '=', 0)->paginate(12);
            }
        }
        // Filtro por Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 0)->paginate(12);
            } else {
                $news =  Product::where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('cat_id', $categoria)
                ->orderByRaw('(price - reduced_price) ASC')->where('featured', '=', 0)->paginate(12);
            }
        } // Filtro por Marca, Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $news = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 0)->paginate(12);
            } else {
                $news = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria)
                ->where('featured', '=', 0)->paginate(12);
            }
            
        } 
        else if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta==null) {
            $news = Product::where('featured', '=', 0)->paginate(12);
        } else if ($request->clear == 'clear') {
            $news = Product::where('featured', '=', 0)->paginate(12);
        }
        // dd($maxfilter);

        return view('pages.partials.all-newProducts', compact('news', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }




    public function filtrosOffer(Request $request) {
        
        // $products = "";
        $brandFilter = $request->brand;
        $catFilter = $request->categories;
        $minFilter = $request->desde;
        $maxfilter = $request->hasta;
        $labels = 1;
        // dd($brandFilter);

        $categorias = Category::all();
        $marcas = Brand::all();

        $hasta = $request->hasta;
        $desde = $request->desde;
        $d = $request->desde;
        $h = $request->hasta;


        $marc = array();
        $marca =  array();
        $cat = array();
        $categoria = array();
        if($request->fil == 0) {
            $d = $request->desde;
            $h = $request->hasta;
            $desde = json_decode($d);
            $hasta = json_decode($h);

            $cb = $request->brand;
            $m = null;
            $c = 0;
            for ($i=0; $i < strlen($request->brand); $i++) { 
                if($i+1 == strlen($request->brand)) {
                    $m = $m.$cb[$i];
                    $marc[$c] = $m;
                } elseif ($cb[$i] != ",") {
                    $m = $m.$cb[$i];
                } elseif ($cb[$i] == ",") {
                    $marc[$c] = $m;
                    $m = null;
                    $c++;
                }
            }
            // dd($marc);
            $marca = Brand::wherein('brand_name', $marc)->get();
            // dd($marca);

            $cc = $request->categories;
            $ca = null;
            $a = 0;
            for ($i=0; $i < strlen($request->categories); $i++) { 
                if($i+1 == strlen($request->categories)) {
                    $ca = $ca.$cc[$i];
                    $cat[$a] = $ca;
                } elseif ($cc[$i] != ",") {
                    $ca = $ca.$cc[$i];
                } elseif ($cc[$i] == ",") {
                    $cat[$a] = $ca;
                    $ca = null;
                    $a++;
                }
            }
            // dd($marc);
            $categoria = Category::wherein('category', $cat)->get();
            // dd($categoria);

            $brandFilter = $marca;
            $catFilter = $categoria;
            $minFilter = $desde;
            $maxfilter = $hasta;
            $labels = 0;
            // dd($maxfilter);
        }

        $ordenamiento = "Ordenar Por";
        // $products = Product::OrderBy('price')->where('shop_id', '=', $request->id)->where('price', '>=', $request->desde)->Paginate(5);

        // Filtro por Precio Maximo
        if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::OrderByRaw('(price - reduced_price) DESC')->where('price', '<=', $request->hasta)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::OrderByRaw('(price - reduced_price) DESC')->where('price', '<=', $hasta)->where('featured', '=', 1)->paginate(12);
            }        

        } // Filtro por Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)->where('featured', '=', 1)->paginate(12);
            }       

        } // Filtro por Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->where('price', '<=', $hasta)->where('featured', '=', 1)->paginate(12);
            }            

        } // Filtro por Marca
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::whereIn('brand_id', $request->brand)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::whereIn('brand_id', $marca)->where('featured', '=', 1)->paginate(12);
            }       

        } // Filtro por Categoria
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::whereIn('cat_id', $request->categories)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::whereIn('cat_id', $categoria)->where('featured', '=', 1)->paginate(12);
            }

        } // Filtro por Marca y Categoria
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->where('featured', '=', 1)->paginate(12);
            }

        } // Filtro por Marca y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->where('featured', '=', 1)->paginate(12);
            }  

        } // Filtro por Marca y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->where('featured', '=', 1)->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('cat_id', $categoria)->where('featured', '=', 1)->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria)->where('featured', '=', 1)->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->where('featured', '=', 1)->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->where('featured', '=', 1)->paginate(12);
            }
            
        } // Filtro por Marca, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('brand_id', $request->brand)->where('featured', '=', 1)->paginate(12);
            } else {
                $products =  Product::where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_id', $marca)
                ->orderByRaw('(price - reduced_price) ASC')->where('featured', '=', 1)->paginate(12);
            }
        }
        // Filtro por Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 1)->paginate(12);
            } else {
                $products =  Product::where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('cat_id', $categoria)
                ->orderByRaw('(price - reduced_price) ASC')->where('featured', '=', 1)->paginate(12);
            }
        } // Filtro por Marca, Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('featured', '=', 1)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria)
                ->where('featured', '=', 1)->paginate(12);
            }
            
        } 
        else if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta==null) {
            $products = Product::where('featured', '=', 1)->paginate(12);
        } else if ($request->clear == 'clear') {
            $products = Product::where('featured', '=', 1)->paginate(12);
        }

        return view('pages.partials.all-offersProducts', compact('products', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }





    public function filtrosSelled(Request $request) {
       
        $brandFilter = $request->brand;
        $catFilter = $request->categories;
        $minFilter = $request->desde;
        $maxfilter = $request->hasta;
        $labels = 1;

        $date = Carbon::now();
        $endDate = $date->subMonth(3);

        $categorias = Category::all();
        $marcas = Brand::all();

        $hasta = $request->hasta;
        $desde = $request->desde;
        $d = $request->desde;
        $h = $request->hasta;

        $marc = array();
        $marca =  array();
        $cat = array();
        $categoria = array();

        if($request->fil == 0) {
            $d = $request->desde;
            $h = $request->hasta;
            $desde = json_decode($d);
            $hasta = json_decode($h);

            $cb = $request->brand;
            $m = null;
            $c = 0;
            for ($i=0; $i < strlen($request->brand); $i++) { 
                if($i+1 == strlen($request->brand)) {
                    $m = $m.$cb[$i];
                    $marc[$c] = $m;
                } elseif ($cb[$i] != ",") {
                    $m = $m.$cb[$i];
                } elseif ($cb[$i] == ",") {
                    $marc[$c] = $m;
                    $m = null;
                    $c++;
                }
            }
            $marca = Brand::wherein('brand_name', $marc)->get();

            $cc = $request->categories;
            $ca = null;
            $a = 0;
            for ($i=0; $i < strlen($request->categories); $i++) { 
                if($i+1 == strlen($request->categories)) {
                    $ca = $ca.$cc[$i];
                    $cat[$a] = $ca;
                } elseif ($cc[$i] != ",") {
                    $ca = $ca.$cc[$i];
                } elseif ($cc[$i] == ",") {
                    $cat[$a] = $ca;
                    $ca = null;
                    $a++;
                }
            }
            $categoria = Category::wherein('category', $cat)->get();

            $brandFilter = $marca;
            $catFilter = $categoria;
            $minFilter = $desde;
            $maxfilter = $hasta;
            $labels = 0;
        }

        $ordenamiento = "Ordenar Por";

        $query=Product::select("products.*")->join('customer_histories', 'products.id', '=', 'customer_histories.product_id')
        ->join('sales', 'customer_histories.sale_id', '=', 'sales.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id');

        $query=$query->select(\DB::raw("products.*,SUM(customer_histories.amount) as ventas"))
            ->where('sales.status_pago', 'Acreditado')
            ->where("sales.date",">",$endDate)
            ->groupBy("products.*")->orderBy("ventas", "desc");
        $products = $query;
       dd($products);
      

        // Filtro por Precio Maximo
        if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->where('price', '<=', $request->hasta)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->where('price', '<=', $hasta)->OrderBy('company_id','ASC')->paginate(12);
            }        

        } // Filtro por Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)->OrderBy('company_id','ASC')->paginate(12);
            }       

        } // Filtro por Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->where('price', '<=', $hasta)->OrderBy('company_id','ASC')->paginate(12);
            }            

        } // Filtro por Marca
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->whereIn('brand_id', $request->brand)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->whereIn('brand_id', $marca)->OrderBy('company_id','ASC')->paginate(12);
            }       

        } // Filtro por Categoria
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->whereIn('cat_id', $request->categories)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->whereIn('cat_id', $categoria)->OrderBy('company_id','ASC')->paginate(12);
            }

        } // Filtro por Marca y Categoria
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->OrderBy('company_id','ASC')->paginate(12);
            }

        } // Filtro por Marca y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->OrderBy('company_id','ASC')->paginate(12);
            }  

        } // Filtro por Marca y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->OrderBy('company_id','ASC')->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('cat_id', $categoria)->OrderBy('company_id','ASC')->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products
                ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products
                ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria)->OrderBy('company_id','ASC')->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->OrderBy('company_id','ASC')->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->OrderBy('company_id','ASC')->paginate(12);
            }
            
        } // Filtro por Marca, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('brand_id', $request->brand)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts =  $products->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_id', $marca)
                ->orderByRaw('(price - reduced_price) ASC')->OrderBy('company_id','ASC')->paginate(12);
            }
        }
        // Filtro por Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('cat_id', $request->categories)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts =  $products->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('cat_id', $categoria)
                ->orderByRaw('(price - reduced_price) ASC')->OrderBy('company_id','ASC')->paginate(12);
            }
        } // Filtro por Marca, Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->OrderBy('company_id','ASC')->paginate(12);
            } else {
                $selledProducts = $products->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria)
                ->OrderBy('company_id','ASC')->paginate(12);
            }
            
        } 
        else if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta==null) {
            $selledProducts = $products->OrderBy('company_id','ASC')->paginate(12);
        } else if ($request->clear == 'clear') {
            $selledProducts = $products->OrderBy('company_id','ASC')->paginate(12);
        }

        return view('pages.partials.all-selledProducts', compact('selledProducts', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


}

function removeNamespaceFromXML( $xml )
{
    // Because I know all of the the namespaces that will possibly appear in 
    // in the XML string I can just hard code them and check for 
    // them to remove them
    $toRemove = ['rap', 'turss', 'crim', 'cred', 'j', 'rap-code', 'evic'];
    // This is part of a regex I will use to remove the namespace declaration from string
    $nameSpaceDefRegEx = '(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?';

    // Cycle through each namespace and remove it from the XML string
   foreach( $toRemove as $remove ) {
        // First remove the namespace from the opening of the tag
        $xml = str_replace('<' . $remove . ':', '<', $xml);
        // Now remove the namespace from the closing of the tag
        $xml = str_replace('</' . $remove . ':', '</', $xml);
        // This XML uses the name space with CommentText, so remove that too
        $xml = str_replace($remove . ':commentText', 'commentText', $xml);
        // Complete the pattern for RegEx to remove this namespace declaration
        $pattern = "/xmlns:{$remove}{$nameSpaceDefRegEx}/";
        // Remove the actual namespace declaration using the Pattern
        $xml = preg_replace($pattern, '', $xml, 1);
    }

    // Return sanitized and cleaned up XML with no namespaces
    return $xml;
}

function namespacedXMLToArray($xml)
{
    // One function to both clean the XML string and return an array
    return json_decode(json_encode(simplexml_load_string(removeNamespaceFromXML($xml))), true);
}