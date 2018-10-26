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

        return view('shop.index', compact('products', 'banner', 'relacion', 'ordenamiento', 'marcas', 'categorias'));
    }

    public function filter($id, Request $request) {
        $orden = Shop::find($id); 
        $products = 0;

        // Filtro por Marca
        if($request->get("brand")!=null && $request->get("categories")==null && $request->get("hasta")==null && $request->get("desde")==null) {
            $products = $orden->product()->whereIn('brand_id', $request->brand)->paginate(1);
        } //Filtro por Categoria
        elseif ($request->get("brand")==null && $request->get("categories")!=null && $request->get("hasta")==null && $request->get("desde")==null) {
            $products = $orden->product()->whereIn('cat_id', $request->categories)->paginate(1);
        } //Filtro por Marca y Categoria
        elseif ($request->get("brand")!=null && $request->get("categories")!=null && $request->get("hasta")==null && $request->get("desde")==null) {
            $products = $orden->product()->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)->paginate(12);
        } //Filtro por Precio Menor
        elseif ($request->get("brand")==null && $request->get("categories")==null && $request->get("hasta")!=null && $request->get("desde")==null) {
            $products = $orden->product()->where('price', '<=', $request->hasta)->paginate(12);
        } //Filtro por Precio Mayor
        elseif ($request->get("brand")==null && $request->get("categories")==null && $request->get("hasta")==null && $request->get("desde")!=null) {
            $products = $orden->product()->where('price', '>=', $request->desde)->paginate(12);
        } //Filtro por Precio Mayor y Precio Menor
        elseif ($request->get("brand")==null && $request->get("categories")==null && $request->get("hasta")!=null && $request->get("desde")!=null) {
            $products = $orden->product()->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
        } //Filtro por Categoria y Precio Menor
        elseif ($request->get("brand")==null && $request->get("categories")!=null && $request->get("hasta")!=null && $request->get("desde")==null) {
            $products = $orden->product()->whereIn('cat_id', $request->categories)->where('price', '<=', $request->hasta)->paginate(12);
        } //Filtro por Marca y Precio Menor
        elseif ($request->get("brand")!=null && $request->get("categories")==null && $request->get("hasta")!=null && $request->get("desde")==null) {
            $products = $orden->product()->whereIn('brand_id', $request->brand)->where('price', '<=', $request->hasta)->paginate(12);
        } //Filtro por Categoria y Precio Mayor
        elseif ($request->get("brand")==null && $request->get("categories")!=null && $request->get("hasta")==null && $request->get("desde")!=null) {
            $products = $orden->product()->whereIn('cat_id', $request->categories)->where('price', '>=', $request->desde)->paginate(12);
        } //Filtro por Marca y Precio Mayor
        elseif ($request->get("brand")!=null && $request->get("categories")==null && $request->get("hasta")==null && $request->get("desde")!=null) {
            $products = $orden->product()->whereIn('brand_id', $request->brand)->where('price', '>=', $request->desde)->paginate(12);
        } //Filtro por Marcas, Precio Mayor y Precio Menor
        elseif ($request->get("brand")!=null && $request->get("categories")==null && $request->get("hasta")!=null && $request->get("desde")!=null) {
            $products = $orden->product()->whereIn('brand_id', $request->brand)->where('price', '>=', $request->desde)
            ->where('price', '<=', $request->hasta)->paginate(12);
        } //Filtro por Categorias, Precio Mayor y Precio Menor
        elseif ($request->get("brand")==null && $request->get("categories")!=null && $request->get("hasta")!=null && $request->get("desde")!=null) {
            $products = $orden->product()->whereIn('cat_id', $request->categories)->where('price', '>=', $request->desde)
            ->where('price', '<=', $request->hasta)->paginate(12);
        } //Filtro por Marcas, Categorias y Precio Mayor
        elseif ($request->get("brand")!=null && $request->get("categories")!=null && $request->get("hasta")==null && $request->get("desde")!=null) {
            $products = $orden->product()->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)
            ->where('price', '>=', $request->desde)->paginate(12);
        } //Filtro por Marcas, Categorias y Precio Menor
        elseif ($request->get("brand")!=null && $request->get("categories")!=null && $request->get("hasta")!=null && $request->get("desde")==null) {
            $products = $orden->product()->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)
            ->where('price', '<=', $request->hasta)->paginate(12);
        } //Filtro por Marcas, Categorias, Precio Mayor y Precio Menor
        elseif ($request->get("brand")!=null && $request->get("categories")!=null && $request->get("hasta")!=null && $request->get("desde")!=null) {
            $products = $orden->product()->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)
            ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
        } 

        // dd($products);

        $relacion = false;

        $ordenamiento = "Ordenar Por";

        $banner = Shop::find($id);
    
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

        return view('shop.index', compact('products', 'banner', 'relacion', 'ordenamiento', 'marcas', 'categorias'));
    }


}
