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
        $categories = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        // Gets the query string from our form submission

        $search=null;
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
            $search = $query->get();
           
            
        }
        
        // If no results come up, flash info message with no results found message.

        // Return a view and pass the view the list of products and the original query.
        return view('pages.search', compact('search', 'search_find', 'categories', 'brands', 'cart_count'));
    }

    public function data()
    {
        if(request()->ajax())
        {   
            $query=Product::select("*")->join('brands', 'brand_id', '=', 'brands.id')
                                        ->join('categories', 'cat_id', '=', 'categories.id');
          
            $data="";
            $cont=1;
            $queries=[$query->select("brand_name")->groupBy('brand_name')->pluck('brand_name'),
                        $query->select("category")->groupBy('category')->pluck('category'),
                        $query->select("product_name")->groupBy('product_name')->pluck('product_name')];
            while($cont<=3)
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

    public function filter(Request $request) {
        // dd($request);
        // dd($request->categories);
        // dd($request->categories);

        if ($request->shopRoute) {
            $orden = Shop::find($request->id); 
        }
        if ($request->brandRoute) {
            $orden = Brand::find($request->id); 
        }
        $products = 0;

        // Filtro por Marca
        if($request->get("brand")!=null && $request->get("categories")==null && $request->get("hasta")==null && $request->get("desde")==null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = Product::whereIn('brand_id', $request->brand)->paginate(12);
            }
            
        } //Filtro por Categoria
        elseif ($request->get("brand")==null && $request->get("categories")!=null && $request->get("hasta")==null && $request->get("desde")==null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::whereIn('cat_id', $request->categories)->paginate(12);
            }
        } //Filtro por Marca y Categoria
        elseif ($request->get("brand")!=null && $request->get("categories")!=null && $request->get("hasta")==null && $request->get("desde")==null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products =  Product::whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)->paginate(12);
            }
        } //Filtro por Precio Menor
        elseif ($request->get("brand")==null && $request->get("categories")==null && $request->get("hasta")!=null && $request->get("desde")==null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::where('price', '<=', $request->hasta)->paginate(12);
            }
        } //Filtro por Precio Mayor
        elseif ($request->get("brand")==null && $request->get("categories")==null && $request->get("hasta")==null && $request->get("desde")!=null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->where('price', '>=', $request->desde)->paginate(12);
            } else {
                $products = Product::where('price', '>=', $request->desde)->paginate(12);
            }
        } //Filtro por Precio Mayor y Precio Menor
        elseif ($request->get("brand")==null && $request->get("categories")==null && $request->get("hasta")!=null && $request->get("desde")!=null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
            }
        } //Filtro por Categoria y Precio Menor
        elseif ($request->get("brand")==null && $request->get("categories")!=null && $request->get("hasta")!=null && $request->get("desde")==null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('cat_id', $request->categories)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::whereIn('cat_id', $request->categories)->where('price', '<=', $request->hasta)->paginate(12);
            }
        } //Filtro por Marca y Precio Menor
        elseif ($request->get("brand")!=null && $request->get("categories")==null && $request->get("hasta")!=null && $request->get("desde")==null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('brand_id', $request->brand)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::whereIn('brand_id', $request->brand)->where('price', '<=', $request->hasta)->paginate(12);
            }
        } //Filtro por Categoria y Precio Mayor
        elseif ($request->get("brand")==null && $request->get("categories")!=null && $request->get("hasta")==null && $request->get("desde")!=null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('cat_id', $request->categories)->where('price', '>=', $request->desde)->paginate(12);
            } else {
                $products = Product::whereIn('cat_id', $request->categories)->where('price', '>=', $request->desde)->paginate(12);
            }
        } //Filtro por Marca y Precio Mayor
        elseif ($request->get("brand")!=null && $request->get("categories")==null && $request->get("hasta")==null && $request->get("desde")!=null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('brand_id', $request->brand)->where('price', '>=', $request->desde)->paginate(12);
            } else {
                $products = Product::whereIn('brand_id', $request->brand)->where('price', '>=', $request->desde)->paginate(12);
            }
        } //Filtro por Marcas, Precio Mayor y Precio Menor
        elseif ($request->get("brand")!=null && $request->get("categories")==null && $request->get("hasta")!=null && $request->get("desde")!=null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('brand_id', $request->brand)->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::whereIn('brand_id', $request->brand)->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->paginate(12);
            }
        } //Filtro por Categorias, Precio Mayor y Precio Menor
        elseif ($request->get("brand")==null && $request->get("categories")!=null && $request->get("hasta")!=null && $request->get("desde")!=null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('cat_id', $request->categories)->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::whereIn('cat_id', $request->categories)->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->paginate(12);
            }
        } //Filtro por Marcas, Categorias y Precio Mayor
        elseif ($request->get("brand")!=null && $request->get("categories")!=null && $request->get("hasta")==null && $request->get("desde")!=null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)
                ->where('price', '>=', $request->desde)->paginate(12);
            } else {
                $products = Product::whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)
                ->where('price', '>=', $request->desde)->paginate(12);
            }
        } //Filtro por Marcas, Categorias y Precio Menor
        elseif ($request->get("brand")!=null && $request->get("categories")!=null && $request->get("hasta")!=null && $request->get("desde")==null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)
                ->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)
                ->where('price', '<=', $request->hasta)->paginate(12);
            }
        } //Filtro por Marcas, Categorias, Precio Mayor y Precio Menor
        elseif ($request->get("brand")!=null && $request->get("categories")!=null && $request->get("hasta")!=null && $request->get("desde")!=null) {
            if ($request->shopRoute || $request->brandRoute) {
                $products = $orden->product()->whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::whereIn('brand_id', $request->brand)->whereIn('cat_id', $request->categories)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
            }
        } 

        // if (isset($products)) {
            $brand = $products;  
        // }
        //     $vacio = 1;  
        //     dd($products);
        // } else {
        //     $products = null;
        // }
        

        $relacion = false;

        $ordenamiento = "Ordenar Por";

        if ($request->shopRoute || $request->brandRoute) {
            $banner = Shop::find($request->id);
        
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

        } elseif ($request->offersRoute) {
            $orden = null;
            $categorias = Category::all();
            $marcas = Brand::all();    

        } elseif ($request->newsRoute) {
            $orden = null;
            $categorias = Category::all();
            $marcas = Brand::all();    
        }

        if ($request->shopRoute) {
            $brandRoute = null;
            $shopRoute = 1;
            $offersRoute = null;
            $newsRoute = null;
            $categoryRoute = null;    
            return view('shop.index', compact('products', 'banner', 'orden', 'marcas', 'categorias', 'ordenamiento', 'relacion', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute'));
        }
        elseif ($request->brandRoute) {
            $brandRoute = 1;
            $shopRoute = null;
            $offersRoute = null;
            $newsRoute = null;
            $categoryRoute = null;    
            return view('brand.show', compact('products', 'brands', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute', 'marcas', 'categorias', 'ordenamiento', 'orden', 'previousURL', 'brand', 'category', 'search', 'cart_count'));
        }
        elseif ($request->offersRoute) {
            $brandRoute = null;
            $shopRoute = null;
            $offersRoute = 1;
            $newsRoute = null;
            $categoryRoute = null;  
            // dd($products); 
            return view('pages.partials.all-offersProducts',compact('offers', 'previousURL', 'products', 'orden', 'marcas', 'categorias', 'ordenamiento', 'relacion', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute')); 
        }
        elseif ($request->newsRoute) {
            $brandRoute = null;
            $shopRoute = null;
            $offersRoute = null;
            $newsRoute = 1;
            $categoryRoute = null;    
            return view('pages.partials.all-newProducts',compact('news', 'previousURL', 'products', 'orden', 'marcas', 'categorias', 'ordenamiento', 'relacion', 'brandRoute', 'shopRoute', 'offersRoute', 'newsRoute', 'categoryRoute'));
        }

    }



}