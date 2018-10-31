<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;
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
        // Select all products where featured = 1,
        // order by random rows, and only take 4 rows from table so we can display them on the homepage.
        $products = Product::where('shop_id', '=', $id)->orderBy('product_name')->paginate(12);

        $ordenamiento = "Ordenar Por";

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;

        $relacion = false;

        $banner = Shop::find($id);

        $query = $banner->product();
        $querybrands = $banner->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  
        $querybrands = $querybrands->join('brands', 'brand_id', '=', 'brands.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');

        $marcas = array();
        $marcas['id'] = $querybrands->select("brands.id")->groupBy('brands.id')->pluck('brands.id');
        $marcas['brand_name'] = $querybrands->select("brand_name")->groupBy('brand_name')->pluck('brand_name');

        return view('shop.index', compact('products', 'banner', 'relacion', 'ordenamiento', 'marcas', 'categorias', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter'));
    }

    public function filtros(Request $request) {
        $banner = Shop::find($request->id);
        // dd($request);
        // $products = "";
        $relacion = false;
        $brandFilter = $request->brand;
        $catFilter = $request->categories;
        $minFilter = $request->desde;
        $maxfilter = $request->hasta;

        $query = $banner->product();
        $querybrands = $banner->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  
        $querybrands = $querybrands->join('brands', 'brand_id', '=', 'brands.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');

        $marcas = array();
        $marcas['id'] = $querybrands->select("brands.id")->groupBy('brands.id')->pluck('brands.id');
        $marcas['brand_name'] = $querybrands->select("brand_name")->groupBy('brand_name')->pluck('brand_name');

        $ordenamiento = "Menor Precio";
        // $products = Product::OrderBy('price')->where('shop_id', '=', $request->id)->where('price', '>=', $request->desde)->Paginate(5);

        // Filtro por Precio Maximo
        if($request->get("brand")==null && $request->get("categories")==null && $request->get("desde")==null && $request->get("hasta")!=null)
        {
            $products = Product::OrderByRaw('(price - reduced_price) DESC')->where('shop_id',$request->id)->where('price', '<=', $request->hasta)->paginate(2);
        } // Filtro por Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")==null && $request->get("desde")!=null && $request->get("hasta")==null)
        {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)->where('price', '>=', $request->desde)->paginate(2);
        } // Filtro por Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")==null && $request->get("desde")!=null && $request->get("hasta")!=null)
        {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
            ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(2);
        } // Filtro por Marca
        else if($request->get("brand")!=null && $request->get("categories")==null && $request->get("desde")==null && $request->get("hasta")==null)
        {
            $products = Product::where('shop_id', $request->id)->whereIn('brand_id', $request->brand)->paginate(2);
        } // Filtro por Categoria
        else if($request->get("brand")==null && $request->get("categories")!=null && $request->get("desde")==null && $request->get("hasta")==null)
        {
            $products = Product::where('shop_id', $request->id)->whereIn('cat_id', $request->categories)->paginate(2);
        } // Filtro por Marca y Categoria
        else if($request->get("brand")!=null && $request->get("categories")!=null && $request->get("desde")==null && $request->get("hasta")==null)
        {
            $products = Product::where('shop_id', $request->id)->whereIn('brand_id', $request->brand)
            ->whereIn('cat_id', $request->categories)->paginate(2);
        } // Filtro por Marca y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")==null && $request->get("desde")!=null && $request->get("hasta")==null)
        {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
            ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->paginate(2);
        } // Filtro por Marca y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $request->get("desde")==null && $request->get("hasta")!=null)
        {
            $products = Product::orderByRaw('(price - reduced_price) DESC')->where('shop_id', $request->id)
            ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->paginate(2);
        } // Filtro por Categoria y Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")!=null && $request->get("desde")!=null && $request->get("hasta")==null)
        {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
            ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories)->paginate(2);
        } // Filtro por Categoria y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $request->get("desde")==null && $request->get("hasta")!=null)
        {
            $products = Product::orderByRaw('(price - reduced_price) DESC')->where('shop_id', $request->id)
            ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories)->paginate(2);
        } // Filtro por Marca, Categoria y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $request->get("desde")!=null && $request->get("hasta")==null)
        {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
            ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)
            ->whereIn('cat_id', $request->categories)->paginate(2);
        } // Filtro por Marca, Categoria y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $request->get("desde")==null && $request->get("hasta")!=null)
        {
            $products = Product::orderByRaw('(price - reduced_price) DESC')->where('shop_id', $request->id)
            ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
            ->whereIn('cat_id', $request->categories)->paginate(2);
        } // Filtro por Marca, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $request->get("desde")!=null && $request->get("hasta")!=null)
        {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
            ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
            ->whereIn('brand_id', $request->brand)->paginate(2);
        } // Filtro por Marca, Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $request->get("desde")!=null && $request->get("hasta")!=null)
        {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
            ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
            ->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)->paginate(2);
        } 

        return view('shop.index', compact('products', 'banner', 'marcas', 'categorias', 'relacion', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter'));
    }


}
