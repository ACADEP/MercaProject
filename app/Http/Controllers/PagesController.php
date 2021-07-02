<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Brand;
use App\Sale;
use App\Product;
use App\CustomerHistory;
use App\Shop;
use App\Category;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\ApiRequest;

use Illuminate\Support\Facades\Auth;


class PagesController extends Controller {


        public function index() {
        // $requestAPI=ApiRequest::ProductbyBrand("SYMANTEC / NORTON");
        // dd($requestAPI);
        
       

        $categories = Category::pluck('category')->take(5);
        
        // From Traits/BrandAll.php
        // Get all the Brands
        

        // Select all products where featured = 1,
        // order by random rows, and only take 4 rows from table so we can display them on the homepage.
        $products = Product::selectRaw('*, (100 - ((reduced_price*100)/price)) AS pct_desc')
                            ->where('featured', '=', 1)
                            ->where("product_qty",">",0)
                            ->where("price","!=","reduced_price")
                            ->orderBy('pct_desc','desc')->take(12)->get();

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
        $new = Product::where('featured', '=', 0)
                ->where('product_qty','>',0)
                ->OrderBy('company_id','ASC')
                ->OrderBy('created_at','desc')->take(12)->get();


        
        return view('pages.index', compact('products',  'previousURL', 'new',  'rand_shops', 'rand_brands','categories', 'selledProducts'));
    }

    public function about() {
        return view('pages.about');
    }

    public function terms() {
        return view('pages.terms-and-conditions');
    }

    public function politics() {
        return view('pages.politics');
    }

    public function help() {
        return view('pages.help');
    }

    public function displayProducts(Category $category) {
        $products = $category->products();
       
        $marcas = Brand::select("*")->whereIn("id",$products->select("brand_id")->get())->get();
        $categorias = Category::select("*")->whereIn("id",$products->select("cat_id")->get())->get();

        $products=$products->select("*")->paginate(12);

        return view("pages.products-category", compact('products', 'categorias', 'marcas'));
    }

    public function orderCategories(Category $category ,Request $request)
    {
        $query = $category->products();
       
        $marcas = Brand::select("*")->whereIn("id",$query->select("brand_id")->get())->get();
        $categorias = Category::select("*")->whereIn("id",$query->select("cat_id")->get())->get();

        $products=$query->select("*")->paginate(12);
        
        $old_inputs=$request;

        return view("pages.products-category", compact('products', 'categorias','marcas', 'old_inputs'));
    }

    // /usr/local/bin/php /home7/mercadata/mercadata/artisan db:seed --class=UpdateProductsApi
    /** Display Products by Brand
     *
     * @param $id
     * @return $this
     */
    public function displayProductsByBrand($id) 
    {
        $brand = Brand::find($id);

        $products = Product::where('brand_id', '=', $id);

        $marcas = Brand::select("*")->whereIn("id",$products->select("brand_id"))->get();
        $categorias = Category::select("*")->whereIn("id",$products->select("cat_id"))->get();

        $products=$products->select("*")->paginate(12);

        $previousURL = url()->previous();
      

        return view('brand.show', compact('products','brand','previousURL' ,'marcas', 'categorias'));
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
        $products = Product::where('featured', '=', 0)->OrderBy('created_at','desc');
        //previous URL for breadcrumbs
        $previousURL = url()->previous();

        $marcas = Brand::select("*")->whereIn("id",$products->select("brand_id"))->get();
        $categorias = Category::select("*")->whereIn("id",$products->select("cat_id"))->get();

        $news=$products->select("*")->paginate(12);
     

        return view('pages.partials.all-newProducts',compact('news', 'previousURL', 'marcas', 'categorias'));
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
        //previous URL for breadcrumbs
        $previousURL = url()->previous();
        
        $products = Product::where('featured', '=', 1)->OrderBy('company_id','ASC');

        $marcas = Brand::select("*")->whereIn("id",$products->select("brand_id"))->get();
        $categorias = Category::select("*")->whereIn("id",$products->select("cat_id"))->get();

        $products=$products->select("*")->paginate(12);
        

        return view('pages.partials.all-offersProducts',compact('products', 'previousURL', 'marcas', 'categorias'));
    }




    public function filtrosNuevos(Request $request) {
        
        
        $query=Product::where('featured', '=', 0)->OrderBy('created_at','desc');
                   
        $categorias = Category::select("*")->whereIn("id",$query->select("cat_id"))->get();
        $marcas = Brand::select("*")->whereIn("id",$query->select("brand_id"))->get();


        $filter=Product::whereIn("id",$query->select("products.id"));


        if($request->desde > 0)
        {
        $filter->whereRaw('IF(reduced_price > 0, reduced_price, price) >= ?', [$request->desde]);
        }

        if($request->hasta > 0)
        {
        $filter->whereRaw('IF(reduced_price > 0, reduced_price, price) <= ?', [$request->hasta]);
        }

        if($request->brand != null)
        {
        $filter->whereIn("brand_id",$request->brand);
        }

        if($request->categories != null)
        {
        $filter->whereIn("cat_id",$request->categories);
        }      

        if ($request->order != null) 
        {
            switch ($request->order) {
                case 'Menor':
                $filter->orderByRaw("IF(reduced_price > 0, reduced_price, price)");
                break;
                case 'Mayor':
                $filter->orderByRaw("IF(reduced_price > 0, reduced_price, price) desc");
                break;
                case 'AZ':
                $filter->orderBy("product_name");
                break;
                case 'ZA':
                $filter->orderBy("product_name","desc");
                break;
                default:
                $filter->orderBy("product_name");
                break;
            }
        }

        $old_inputs=$request;
        $news=$filter->paginate(12);

        return view('pages.partials.all-newProducts', compact('news', 'marcas', 'categorias', 'old_inputs'));
    }




    public function filtrosOffer(Request $request) {
        
        
            $query=  Product::where('featured', '=', 1)->OrderBy('company_id','ASC');
                   
            $categorias = Category::select("*")->whereIn("id",$query->select("cat_id"))->get();
            $marcas = Brand::select("*")->whereIn("id",$query->select("brand_id"))->get();


            $filter=Product::whereIn("id",$query->select("products.id"));


            if($request->desde > 0)
            {
            $filter->whereRaw('IF(reduced_price > 0, reduced_price, price) >= ?', [$request->desde]);
            }

            if($request->hasta > 0)
            {
            $filter->whereRaw('IF(reduced_price > 0, reduced_price, price) <= ?', [$request->hasta]);
            }

            if($request->brand != null)
            {
            $filter->whereIn("brand_id",$request->brand);
            }

            if($request->categories != null)
            {
            $filter->whereIn("cat_id",$request->categories);
            }      

            if ($request->order != null) 
            {
                switch ($request->order) {
                    case 'Menor':
                    $filter->orderByRaw("IF(reduced_price > 0, reduced_price, price)");
                    break;
                    case 'Mayor':
                    $filter->orderByRaw("IF(reduced_price > 0, reduced_price, price) desc");
                    break;
                    case 'AZ':
                    $filter->orderBy("product_name");
                    break;
                    case 'ZA':
                    $filter->orderBy("product_name","desc");
                    break;
                    default:
                    $filter->orderBy("product_name");
                    break;
                }
            }

            $old_inputs=$request;
            $products=$filter->paginate(12);
        return view('pages.partials.all-offersProducts', compact('products', 'marcas', 'categorias', 'old_inputs'));
    }


    public function filtrosSelled(Request $request) 
    {
      
        $query=Product::where('featured', '=', 0)->OrderBy('created_at','desc');
                   
        $categorias = Category::select("*")->whereIn("id",$query->select("cat_id"))->get();
        $marcas = Brand::select("*")->whereIn("id",$query->select("brand_id"))->get();

        $filter=Product::whereIn("id",$query->select("products.id"));

        if($request->desde > 0)
        {
        $filter->whereRaw('IF(reduced_price > 0, reduced_price, price) >= ?', [$request->desde]);
        }

        if($request->hasta > 0)
        {
        $filter->whereRaw('IF(reduced_price > 0, reduced_price, price) <= ?', [$request->hasta]);
        }

        if($request->brand != null)
        {
        $filter->whereIn("brand_id",$request->brand);
        }

        if($request->categories != null)
        {
        $filter->whereIn("cat_id",$request->categories);
        }      

        if ($request->order != null) 
        {
            switch ($request->order) 
            {
                case 'Menor':
                    $filter->orderByRaw("IF(reduced_price > 0, reduced_price, price)");
                break;
                case 'Mayor':
                    $filter->orderByRaw("IF(reduced_price > 0, reduced_price, price) desc");
                break;
                case 'AZ':
                    $filter->orderBy("product_name");
                break;
                case 'ZA':
                    $filter->orderBy("product_name","desc");
                break;
                default:
                    $filter->orderBy("product_name");
                break;
            }
        }

        $old_inputs=$request;
        $selledProducts=$filter->paginate(12);

        return view('pages.partials.all-selledProducts', compact('selledProducts', 'marcas', 'categorias', 'old_inputs'));
    }


}
