<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Category;
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




}