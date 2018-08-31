<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductSeller;
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

    public function showSales()
    {
        return view('seller.pages.sales_history');
    }

    public function addProduct(Request $request)
    {
        $product=new Product;
        $product->product_name=$request->product_name;
        $product->product_qty=$request->product_qty;
        $product->product_sku=$request->product_inv;
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

        return back();
    }
}
