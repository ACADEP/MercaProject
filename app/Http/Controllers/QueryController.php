<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Category;
use App\Shop;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\CartTrait;


class QueryController extends Controller {

    public function search(Request $peticion)
    {    
        
        $search=null;
        $resultados = null;
        $search_find=$peticion->searchname;
        
        if($search_find!=null)
        {   
            $query=Product::select("*")->with('brand')->with("category");  
                          
            $query->orWhere("products.product_sku", 'like', "%".$search_find."%");
            $query = $query->orWhereHas('brand', function( $query ) use ( $search_find ){
                $query->where('brand_name', "like" , "%".$search_find."%" );
            });

           
            $query = $query->orWhereHas('category', function( $query ) use ( $search_find ){
                $query->where('category',"like" ,"%".$search_find."%" );
            });
            
            $query = $query->orWhere("product_name", 'LIKE', "%".$search_find."%");
            
            $query = $query->orWhere("description", 'LIKE', "%".$search_find."%");
            
           
            $marcas = Brand::select("*")->whereIn("id",$query->select("brand_id"))->get();
            $categorias = Category::select("*")->whereIn("id",$query->select("cat_id"))->get();
            
            $resultados = count($query->get());

            $search = $query->select('products.*')->paginate(12);
        }

        $orden = null;

        $brandFilter = null;
        $catFilter = null;
        $minFilter = null;
        $maxfilter = null;
        $labels = 1;

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
                    { }
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

    public function filtros(Request $request) 
    {
       
        $search_find=$request->search;

        $query=Product::select("*")->with('brand')->with("category");  
                          
        $query->orWhere("products.product_sku", 'like', "%".$search_find."%");
        $query = $query->orWhereHas('brand', function( $query ) use ( $search_find ){
            $query->where('brand_name', "like" , "%".$search_find."%" );
        });

        
        $query = $query->orWhereHas('category', function( $query ) use ( $search_find ){
            $query->where('category',"like" ,"%".$search_find."%" );
        });
        
        $query = $query->orWhere("product_name", 'LIKE', "%".$search_find."%");
        
        $query = $query->orWhere("description", 'LIKE', "%".$search_find."%");

        $marcas = Brand::select("*")->whereIn("id",$query->select("brand_id"))->get();
        $categorias = Category::select("*")->whereIn("id",$query->select("cat_id"))->get();
        
        $filter=Product::whereIn("id",$query->select("id"));
        
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
        
        $resultados=$filter->count();
        $search=$filter->paginate(12);

        $old_inputs=$request;

        // dd($old_inputs->brand);
        return view('pages.search', compact('search', 'marcas', 'categorias','search_find', 'old_inputs','resultados'));
    }



}