<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Category;
use App\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\CartTrait;


class QueryController extends Controller {

    use BrandAllTrait, CategoryTrait, CartTrait;


    /**
     * Search for items in our e-commerce store
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $peticion) {    
        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $categorie = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        // Gets the query string from our form submission

        $search=null;
        $resultados = null;
        $search_find=$peticion->searchname;
        if( $search_find!=null)
        {
            // Returns an array of products that have the query string located somewhere within
            // our products product name. Paginate them so we can break up lots of search results.
            $query=Product::select("products.*")->join('brands', 'brand_id', '=', 'brands.id')
                                        ->join('categories', 'cat_id', '=', 'categories.id');  
                                                 
            $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%");
            $query = $query->orWhere("category", 'LIKE', "%$search_find%");
            $query = $query->orWhere("product_name", 'LIKE', "%$search_find%");
            $query = $query->orWhere("description", 'LIKE', "%$search_find%");
            $resultados = count($query->get());
            // $search = $query->get();
            $search = $query->paginate(4);
            
        }

        $ordenamiento = "Ordenar Por";

        $orden = null;

        $categorias = Category::all();
        $marcas = Brand::all();

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

        
        // If no results come up, flash info message with no results found message.

        // Return a view and pass the view the list of products and the original query.
        return view('pages.search', compact('search', 'search_find', 'categorie', 'brands', 'cart_count', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels', 'resultados'));
    }

    public function data()
    {
        if(request()->ajax())
        {   
            $query1=Product::select("*")->join('brands', 'brand_id', '=', 'brands.id')
                                        ->join('categories', 'cat_id', '=', 'categories.id');
            $query2=Product::select("*")->join('brands', 'brand_id', '=', 'brands.id')
                                        ->join('categories', 'cat_id', '=', 'categories.id');
            $query3=Product::select("*")->join('brands', 'brand_id', '=', 'brands.id')
                                        ->join('categories', 'cat_id', '=', 'categories.id');
        
            $data="";
            $cont=1;
            $queries=[  $query1->select("brand_name")->groupBy('brand_name')->pluck('brand_name'),
                        $query2->select("category")->groupBy('category')->pluck('category'),
                        $query3->select("product_name")->groupBy('product_name')->pluck('product_name')];
            
            while($cont<=count($queries))
            {
                $string=(string)$queries[$cont-1];
                $newstring="";
                for($i=0; $i<=strlen($string)-1; $i++)
                {
                    if($i==0 || $i==strlen($string)-1 || $string[$i]=='"')
                    {
    
                    }
                    else
                    {
                        $newstring.=$string[$i];
                    }
                }
                $data.=$newstring;
                $data.=",";
                $cont++;
            }
            
            $array=explode(",", $data);
            return response($array,200);
           
        }  
        else
        {
            return back();
        }
       
    }

    public function filtros(Request $request) {
        // dd($request);
        $brandFilter = $request->brand;
        $catFilter = $request->categories;
        $minFilter = $request->desde;
        $maxfilter = $request->hasta;
        $labels = 1;
        $search_find = $request->search;
        $categorias = Category::all();
        $marcas = Brand::all();
        $hasta = $request->hasta;
        $desde = $request->desde;
        $d = $request->desde;
        $h = $request->hasta;
        $ordenamiento = "Menor Precio";

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

        $query=Product::select("products.*")->join('brands', 'brand_id', '=', 'brands.id')
        ->join('categories', 'cat_id', '=', 'categories.id');  

        $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%");
        $query = $query->orWhere("category", 'LIKE', "%$search_find%");
        $query = $query->orWhere("product_name", 'LIKE', "%$search_find%");
        $query = $query->orWhere("description", 'LIKE', "%$search_find%");

        // Filtro por Precio Maximo
        if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $query = $query->OrderByRaw('(price - reduced_price) DESC', $request->hasta);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->OrderByRaw('(price - reduced_price) DESC'.$hasta);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }        

        } // Filtro por Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $query = $query->orderByRaw('(price - reduced_price) ASC')->whereRaw('(price - reduced_price)', '>=', $request->desde);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orderByRaw('(price - reduced_price) ASC'.$desde);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }       

        } // Filtro por Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                // $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                // ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta);
                // $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                // ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta);
                // $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                // ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta);
                // $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                // ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta);
                $query = $query->orderByRaw('(price - reduced_price) >='.$request->desde.' and (price - reduced_price) <='.$request->hasta);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->where('price', '<=', $hasta);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->where('price', '<=', $hasta);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->where('price', '<=', $hasta);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->where('price', '<=', $hasta);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }            

        } // Filtro por Marca
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->whereIn('brand_id', $request->brand);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->whereIn('brand_id', $marca);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->whereIn('brand_id', $marca);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->whereIn('brand_id', $marca);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->whereIn('brand_id', $marca);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }       

        } // Filtro por Categoria
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->whereIn('cat_id', $request->categories);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->whereIn('cat_id', $categoria);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->whereIn('cat_id', $categoria);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->whereIn('cat_id', $categoria);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->whereIn('cat_id', $categoria);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }

        } // Filtro por Marca y Categoria
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }

        } // Filtro por Marca y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                // $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                // ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand);
                // $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                // ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand);
                // $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                // ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand);
                // $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                // ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand);

                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) >='.$request->desde)
                ->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) >='.$request->desde)
                ->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) >='.$request->desde)
                ->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) >='.$request->desde)
                ->whereIn('brand_id', $request->brand);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }  

        } // Filtro por Marca y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }
            
        } // Filtro por Categoria y Precio Minimo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('cat_id', $categoria);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }
            
        } // Filtro por Categoria y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }
            
        } // Filtro por Marca, Categoria y Precio Minimo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }
            
        } // Filtro por Marca, Categoria y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) DESC')
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }
            
        } // Filtro por Marca, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_id', $marca)->orderByRaw('(price - reduced_price) ASC');
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_id', $marca)->orderByRaw('(price - reduced_price) ASC');
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_id', $marca)->orderByRaw('(price - reduced_price) ASC');
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_id', $marca)->orderByRaw('(price - reduced_price) ASC');
                $resultados = count($query->get());
                $search =  $query->paginate(4);
            }
        }
        // Filtro por Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")==null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('cat_id', $categoria)->orderByRaw('(price - reduced_price) ASC');
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('cat_id', $categoria)->orderByRaw('(price - reduced_price) ASC');
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('cat_id', $categoria)->orderByRaw('(price - reduced_price) ASC');
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('cat_id', $categoria)->orderByRaw('(price - reduced_price) ASC');
                $resultados = count($query->get());
                $search =  $query->paginate(4);
            }
        } // Filtro por Marca, Categoria, Precio Minimo y Precio Maximo
        else if($request->get("brand")!=null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            } else {
                $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("category", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("product_name", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $query = $query->orWhere("description", 'LIKE', "%$search_find%")->orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria);
                $resultados = count($query->get());
                $search = $query->paginate(4);
            }
            
        } 
        else if($request->get("brand")==null && $request->get("categories")==null && $desde==null && $hasta==null) {
            $resultados = count($query->get());
            $search = $query->paginate(4);
        }
        // dd($resultados);

        return view('pages.search', compact('search', 'marcas', 'categorias', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels', 'search_find', 'resultados'));
    }



}