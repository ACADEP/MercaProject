<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateProducts;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductSeller;
use App\SeleHistory;
use App\Http\Controllers\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Crypt;

class SellerController extends Controller
{
    
    public function show()
    {
        return view('seller.dash');
    }

    public function showProducts()
    {
        $productsSeller=ProductSeller::Where('user_id',Auth::user()->id)->with('product')->get();
        return view('seller.pages.products',compact('productsSeller'));
    }

    public function showUpdate(Product $product)
    {
        
        return view('seller.partials.update-product',compact('product'));
    }

    public function showSales()
    {
        $seleHistories=Auth::user()->selehistories()->paginate(5);
        $histories=Auth::user()->selehistories()->get();
        return view('seller.pages.sales_history',compact('seleHistories','histories'));
    }
    public function orderDate(Request $request)
    { 
    
        $seleHistories;
        $histories;
        if($request->get("dia")==null && $request->get("mes")==null && $request->get("año")!=null)
        {
            $años=$request->get("año");
            $seleHistories=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(5);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->get();
            
        }
        else if($request->get("dia")==null && $request->get("mes")!=null && $request->get("año")==null)
        {
            $meses=$request->get("mes");
            $seleHistories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->paginate(5); 
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->get();   
        }
        else if($request->get("dia")!=null && $request->get("mes")==null && $request->get("año")==null)
        {
            $dias=$request->get("dia");
            $seleHistories=Auth::user()->selehistories()->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(5);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('DAY(date)'), $dias)->get();
           
        }
        else if($request->get("dia")==null && $request->get("mes")!=null && $request->get("año")!=null)
        {
            $meses=$request->get("mes");
            $años=$request->get("año");
            $seleHistories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(5);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('YEAR(date)'), $años)->get();
            
        }
        else if($request->get("dia")!=null && $request->get("mes")==null && $request->get("año")!=null)
        {
            $años=$request->get("año");
            $dias=$request->get("dia");
            $seleHistories=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(5);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->whereIn(\DB::raw('DAY(date)'), $dias)->get();
            
        }
        else if($request->get("dia")!=null && $request->get("mes")!=null && $request->get("año")==null)
        {
            $meses=$request->get("mes");
            $dias=$request->get("dia");
            $seleHistories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(5);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->get();
            
        }
        else if($request->get("dia")!=null && $request->get("mes")!=null && $request->get("año")!=null)
        {
            $meses=$request->get("mes");
            $dias=$request->get("dia");
            $años=$request->get("año");
            $seleHistories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(5);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->whereIn(\DB::raw('YEAR(date)'), $años)->get();
            
        }
        else
        {
            $seleHistories=Auth::user()->selehistories()->paginate(5);
            $histories=Auth::user()->selehistories()->get();
        }
        return view('seller.pages.sales_history',compact('seleHistories','histories'));
    }
    public function orderSales($order)
    {   
        
        $seleHistories="";
        $histories="";
        if($order==1)
        {
            $seleHistories=Auth::user()->selehistories()->orderBy('amount',"desc")->paginate(5);
            $histories=Auth::user()->selehistories()->orderBy('amount',"desc")->get();
        }
        else if($order==2)
        {
            $seleHistories=Auth::user()->selehistories()->orderBy('date',"desc")->paginate(5);
            $histories=Auth::user()->selehistories()->orderBy('date',"desc")->get();
        }
        else if($order==3)
        {
            $seleHistories=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.price', 'desc')->paginate(5);
            $histories=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.price', 'desc')->get();
            
        }
        else if($order==4)
        {
            $seleHistories=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.product_name', 'asc')->paginate(5);
            $histories=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.product_name', 'asc')->get();
        }
        else if($order==5)
        {
            $seleHistories=Auth::user()->selehistories()->orderBy('client')->paginate(5);
            $histories=Auth::user()->selehistories()->orderBy('client')->get();
        }
        else if($order==6)
        {
            $seleHistories=Auth::user()->selehistories()->orderBy('total','desc')->paginate(5);
            $histories=Auth::user()->selehistories()->orderBy('total','desc')->get();
        }
        else if($order==7)
        {
            $seleHistories=Auth::user()->selehistories()->paginate(5);
            $histories=Auth::user()->selehistories()->get();
        }
        else
        {
            $seleHistories=Auth::user()->selehistories()->paginate(5);
            $histories=Auth::user()->selehistories()->get();
        }
       
        return view('seller.pages.sales_history',compact('seleHistories','histories'));
    }

    public function addProduct(ValidateProducts $request)
    {
        $product=new Product;
        $product->product_name=$request->product_name;
        $product->product_qty=$request->product_qty;
        $product->product_sku=$request->product_sku;
        $product->price=$request->product_price;
        $product->reduced_price=$request->product_reduced;
        $product->shop_id=0;
        $product->cat_id=$request->categoria;
        $product->brand_id=$request->marca;
        $product->featured=0;
        $product->description=$request->product_des;
        $product->product_spec=$request->product_spec;
        $product->save();

        
        $productSeller=new ProductSeller;
        $productSeller->user_id=Auth::user()->id;
        $productSeller->product_id=$product->id;
        $productSeller->save();

        return back()->with("msg",$product->id);
    }

    public function updateProduct(ValidateProducts $request)
    {
       
        $productSeller=Auth::user()->productseller()->with("product")->where("product_id",$request->product_id)->first();
        if($productSeller!=null)
        {
            $product=Product::find($productSeller->product->id);
            $product->product_name=$request->product_name;
            $product->product_qty=$request->product_qty;
            $product->product_sku=$request->product_sku;
            $product->price=$request->product_price;
            $product->reduced_price=$request->product_reduced;
            $product->cat_id=$request->categoria;
            $product->brand_id=$request->marca;
            $product->featured=0;
            $product->description=$request->product_des;
            $product->product_spec=$request->product_spec;
            $product->update();
        }
        return redirect()->back()->with("msg","Producto actualizado!!");

    }

    public function deleteProduct(Request $request)
    {
        
        $productSellers=Auth::user()->productseller;
        $product=null;
        foreach($productSellers as $productSeller)
        {
            if($productSeller->product->id==$request->product_id)
            {
                $productSeller->product->delete();
                $productSeller->delete();
            }
        }
       
       
        
    }

    public function printPdf(Request $request)
    { 
        
        $items=explode( ", ", $request->get("histories") );
        $itemsOrden=$request->get('histories');
        $seleHistories=SeleHistory::whereIn('id',$items)->orderByRaw(\DB::raw("FIELD(id,$itemsOrden)"))->get();
        $pdf = PDF::loadView('seller.partials.print-pdf',compact('seleHistories'));
        return $pdf->stream('Carrito.pdf');
    }
}
