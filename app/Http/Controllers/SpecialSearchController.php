<?php

namespace App\Http\Controllers;
use App\Product;
use App\Brand;
use App\Category;

use Illuminate\Http\Request;

class SpecialSearchController extends Controller
{
    public function specialFilters(Request $request) {
            $query=  Product::select("*");
                   
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

        return view('partials.specialized-search', compact('products', 'marcas', 'categorias', 'old_inputs'));
    }


}
