<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Shop;
use App\Category;
use Carbon\Carbon;
// use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class OrderByController extends ProductsController {

    
    public function OrderSelledproducts(Request $request) {
        $date = Carbon::now();
        $endDate = $date->subMonth(3);
        
        $query=Product::select("products.*")->join('customer_histories', 'products.id', '=', 'customer_histories.product_id')
        ->join('sales', 'customer_histories.sale_id', '=', 'sales.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id');

        $query=$query->select(\DB::raw("products.*, SUM(customer_histories.amount) as ventas"))
            ->where('sales.status_pago', 'Acreditado')
            ->where("sales.date",">",$endDate)
            ->groupBy("products.id");

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
    
            $old_inputs=$request;
            $selledProducts=$filter->paginate(12);
    
            return view('pages.partials.all-selledProducts', compact('selledProducts', 'marcas', 'categorias', 'old_inputs'));

        
    }

    


}