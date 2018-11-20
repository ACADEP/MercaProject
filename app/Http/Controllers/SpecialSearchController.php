<?php

namespace App\Http\Controllers;
use App\Product;
use App\Brand;
use App\Category;

use Illuminate\Http\Request;

class SpecialSearchController extends Controller
{
    public function specialFilters(Request $request) {
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

        if ($request->Popularidad == 1) {
            $products = Product::OrderBy('created_at', 'desc')->paginate(12);
            $ordenamiento = "Popularidad";
            
        } elseif ($request->Menor == 2) {
            $products = Product::OrderByRaw('(price - reduced_price) ASC')->paginate(12);
            $ordenamiento = "Precio Menor";

        } elseif ($request->Mayor == 3) {
            $products = Product::OrderByRaw('(price - reduced_price) DESC')->paginate(12);
            $ordenamiento = "Precio Mayor";

        } elseif ($request->AZ == 4) {
            $products = Product::OrderBy('product_name', 'asc')->paginate(12);
            $ordenamiento = "Productos A-Z";

        } elseif ($request->ZA == 5) {
            $products = Product::OrderBy('product_name', 'desc')->paginate(12);
            $ordenamiento = "Productos Z-A";    
        } else {
            // Filtro por Precio Maximo
            if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta!=null)
            {
                if ($request->fil == 1) {
                    $products = Product::OrderByRaw('(price - reduced_price) DESC')->where('price', '<=', $request->hasta)->paginate(12);
                } else {
                    $products = Product::OrderByRaw('(price - reduced_price) DESC')->where('price', '<=', $hasta)->paginate(12);
                }        

            } // Filtro por Precio Minimo
            else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta==null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) >='.$request->desde)->paginate(12);
                    // $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)->paginate(12);
                } else {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)->paginate(12);
                }       

            } // Filtro por Precio Minimo y Precio Maximo
            else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta!=null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
                } else {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $desde)->where('price', '<=', $hasta)->paginate(12);
                }            

            } // Filtro por Marca
            else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta==null)
            {
                if ($request->fil == 1) {
                    $products = Product::whereIn('brand_id', $request->brand)->paginate(12);
                } else {
                    $products = Product::whereIn('brand_id', $marca)->paginate(12);
                }       

            } // Filtro por Categoria
            else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta==null)
            {
                if ($request->fil == 1) {
                    $products = Product::whereIn('cat_id', $request->categories)->paginate(12);
                } else {
                    $products = Product::whereIn('cat_id', $categoria)->paginate(12);
                }

            } // Filtro por Marca y Categoria
            else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta==null)
            {
                if ($request->fil == 1) {
                    $products = Product::whereIn('brand_id', $request->brand)
                    ->whereIn('cat_id', $request->categories)->paginate(12);
                } else {
                    $products = Product::whereIn('brand_id', $marca)
                    ->whereIn('cat_id', $categoria)->paginate(12);
                }

            } // Filtro por Marca y Precio Minimo
            else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta==null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->paginate(12);
                } else {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->paginate(12);
                }  

            } // Filtro por Marca y Precio Maximo
            else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta!=null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) DESC')
                    ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->paginate(12);
                } else {
                    $products = Product::orderByRaw('(price - reduced_price) DESC')
                    ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->paginate(12);
                }
                
            } // Filtro por Categoria y Precio Minimo
            else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta==null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories)->paginate(12);
                } else {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $desde)->whereIn('cat_id', $categoria)->paginate(12);
                }
                
            } // Filtro por Categoria y Precio Maximo
            else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta!=null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) DESC')
                    ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories)->paginate(12);
                } else {
                    $products = Product::orderByRaw('(price - reduced_price) DESC')
                    ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria)->paginate(12);
                }
                
            } // Filtro por Marca, Categoria y Precio Minimo
            else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta==null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)
                    ->whereIn('cat_id', $request->categories)->paginate(12);
                } else {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $desde)->whereIn('brand_id', $marca)
                    ->whereIn('cat_id', $categoria)->paginate(12);
                }
                
            } // Filtro por Marca, Categoria y Precio Maximo
            else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta!=null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) DESC')
                    ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                    ->whereIn('cat_id', $request->categories)->paginate(12);
                } else {
                    $products = Product::orderByRaw('(price - reduced_price) DESC')
                    ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)
                    ->whereIn('cat_id', $categoria)->paginate(12);
                }
                
            } // Filtro por Marca, Precio Minimo y Precio Maximo
            else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta!=null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                    ->whereIn('brand_id', $request->brand)->paginate(12);
                } else {
                    $products =  Product::where('price', '>=', $desde)->where('price', '<=', $hasta)
                    ->WhereIn('brand_id', $marca)
                    ->orderByRaw('(price - reduced_price) ASC')->paginate(12);
                }
            }
            // Filtro por Categoria, Precio Minimo y Precio Maximo
            else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')
                    ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                    ->whereIn('cat_id', $request->categories)->paginate(12);
                } else {
                    $products =  Product::where('price', '>=', $desde)->where('price', '<=', $hasta)
                    ->WhereIn('cat_id', $categoria)
                    ->orderByRaw('(price - reduced_price) ASC')->paginate(12);
                }
            } // Filtro por Marca, Categoria, Precio Minimo y Precio Maximo
            else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
            {
                if ($request->fil == 1) {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                    ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                    ->whereIn('cat_id', $request->categories)->paginate(12);
                } else {
                    $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                    ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria)
                    ->paginate(12);
                }
                
            } 
            else if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta==null) {
                $products = Product::orderByRaw('RAND()')->paginate(12);
            } else if ($request->clear == 'clear') {
                $products = Product::orderByRaw('RAND()')->paginate(12);
            }
        }

        return view('partials.specialized-search', compact('products', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels'));
    }


}
