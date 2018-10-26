<?php

namespace App\Http\Controllers;


use App\Http\Controllers;
use DB;
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
use App\ShopSold;

class testController extends Controller
{
    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;
    
    /*public function order (Request $request)
    {
        $id = $request->id;
        $banner = Shop::find($id);

        if ($request->low) {
            $products = Product::OrderBy('price')->where('shop_id', '=', $id)->get();
        }
        elseif ($request->high) {
            $products = Product::OrderBy('price', 'desc')->where('shop_id', '=', $id)->get();
        }
        return view('shop.index', compact('products', 'banner'));
    }*/

    public function orderlow($id)
    {
        $banner = Shop::find($id);
        $orden = Shop::find($id); 
        $products = Product::OrderBy('price')->where('shop_id', '=', $id)->Paginate(12);
        $relacion = false;
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

        $brandRoute = null;
        $shopRoute = 1;
        $offersRoute = null;
        $newsRoute = null;
        $categoryRoute = null;

        $ordenamiento = "Menor Precio";
        return view('shop.index', compact('products', 'banner', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'marcas', 'orden', 'categorias', 'relacion', 'ordenamiento'));
    }

    public function orderhigh($id)
    {
        $banner = Shop::find($id);
        $orden = Shop::find($id); 
        $products = Product::OrderBy('price', 'desc')->where('shop_id', '=', $id)->Paginate(12);
        $relacion = false;
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

        $brandRoute = null;
        $shopRoute = 1;
        $offersRoute = null;
        $newsRoute = null;
        $categoryRoute = null;

        $ordenamiento = "Mayor Precio";
        return view('shop.index', compact('products', 'banner', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden', 'categorias', 'marcas', 'relacion', 'ordenamiento'));
    }

    public function ordernewst($id)
    {
        $banner = Shop::find($id);
        /*$products = DB::table('products')->leftjoin('shop_solds', 'shop_solds.shop_id', '=', 'products.shop_id')
                    ->where('products.shop_id', '=', $id)->where('products.id', '=', 'shop_solds.product_id')->get();
        */
        $orden = Shop::find($id); 
        $products = ShopSold::OrderBy('sold', 'desc')->where('shop_id', '=', $id)->Paginate(12);
        /*foreach($products as $prod) {
            dd($prod->product->product_name);
        }*/
        $relacion = true;
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

        $brandRoute = null;
        $shopRoute = 1;
        $offersRoute = null;
        $newsRoute = null;
        $categoryRoute = null;

        $ordenamiento = "Popularidad";
        return view('shop.index', compact('products', 'banner', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden', 'categorias', 'marcas', 'relacion', 'ordenamiento'));
    }

    public function orderaz($id)
    {
        $banner = Shop::find($id);
        $orden = Shop::find($id); 
        $products = Product::OrderBy('product_name')->where('shop_id', '=', $id)->Paginate(12);
        $relacion = false;
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

        $brandRoute = null;
        $shopRoute = 1;
        $offersRoute = null;
        $newsRoute = null;
        $categoryRoute = null;

        $ordenamiento = "Productos A-Z";
        return view('shop.index', compact('products', 'banner', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'orden', 'categorias', 'marcas', 'relacion', 'ordenamiento'));
    }

    public function orderza($id)
    {
        $banner = Shop::find($id);
        $orden = Shop::find($id); 
        $products = Product::OrderBy('product_name', 'desc')->where('shop_id', '=', $id)->Paginate(12);
        $relacion = false;
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

        $brandRoute = null;
        $shopRoute = 1;
        $offersRoute = null;
        $newsRoute = null;
        $categoryRoute = null;

        $ordenamiento = "Productos Z-A";
        return view('shop.index', compact('products', 'banner', 'orden', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'categorias', 'marcas', 'relacion', 'ordenamiento'));
    }


}
