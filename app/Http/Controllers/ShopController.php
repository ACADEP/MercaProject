<?php

namespace App\Http\Controllers;


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
        $products = Product::where('shop_id', '=', $id)->orderBy('product_name')->paginate(9);

        $ordenamiento = "Ordenar Por";

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

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

        return view('shop.index', compact('products', 'banner', 'relacion', 'ordenamiento', 'marcas', 'categorias', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
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
        $labels = 1;
        // dd($brandFilter);

        $query = $banner->product();
        $querybrands = $banner->product();
        $querybadge = $banner->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  
        $querybrands = $querybrands->join('brands', 'brand_id', '=', 'brands.id');  
        $querybadge = $querybadge->join('brands', 'brand_id', '=', 'brands.id')
        ->join('categories', 'cat_id', '=', 'categories.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');

        $marcas = array();
        $marcas['id'] = $querybrands->select("brands.id")->groupBy('brands.id')->pluck('brands.id');
        $marcas['brand_name'] = $querybrands->select("brand_name")->groupBy('brand_name')->pluck('brand_name');

        $badge = Product::select("products.*")->join('brands', 'brand_id', '=', 'brands.id')
        ->join('categories', 'cat_id', '=', 'categories.id');  

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

        $ordenamiento = "Menor Precio";
        // $products = Product::OrderBy('price')->where('shop_id', '=', $request->id)->where('price', '>=', $request->desde)->Paginate(5);

        // Filtro por Precio Maximo
        if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::OrderByRaw('(price - reduced_price) DESC')->where('shop_id',$request->id)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::OrderByRaw('(price - reduced_price) DESC')->where('shop_id',$request->id)->where('price', '<=', $hasta)->paginate(12);
            }        

        } // Filtro por Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)->where('price', '>=', $request->desde)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)->where('price', '>=', $desde)->paginate(12);
            }       

        } // Filtro por Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $desde)->where('price', '<=', $hasta)->paginate(12);
            }            

        } // Filtro por Marca
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::where('shop_id', $request->id)->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = Product::where('shop_id', $request->id)->whereIn('brand_id', $marca)->paginate(12);
            }       

        } // Filtro por Categoria
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::where('shop_id', $request->id)->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::where('shop_id', $request->id)->whereIn('cat_id', $categoria)->paginate(12);
            }

        } // Filtro por Marca y Categoria
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::where('shop_id', $request->id)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::where('shop_id', $request->id)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->paginate(12);
            }

        } // Filtro por Marca y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->paginate(12);
            }  

        } // Filtro por Marca y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('shop_id', $request->id)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('shop_id', $request->id)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $desde)->whereIn('cat_id', $categoria)->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('shop_id', $request->id)
                ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('shop_id', $request->id)
                ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria)->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('shop_id', $request->id)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('shop_id', $request->id)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->paginate(12);
            }
            
        } // Filtro por Marca, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = $querybadge->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_name', $marca)->where('shop_id', $request->id)
                ->orderByRaw('(price - reduced_price) ASC')->paginate(12);
            }
        }
        // Filtro por Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = $querybadge->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('cat_id', $categoria)->where('shop_id', $request->id)
                ->orderByRaw('(price - reduced_price) ASC')->paginate(12);
            }
        } // Filtro por Marca, Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('shop_id', $request->id)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria)
                ->where('shop_id', $request->id)->paginate(12);
            }
            
        } 
        else if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta==null) {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)->paginate(12);
        } else if ($request->clear == 'clear') {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('shop_id', $request->id)->paginate(12);
        }
        // dd($products);

        return view('shop.index', compact('products', 'banner', 'marcas', 'categorias', 'relacion', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


}
