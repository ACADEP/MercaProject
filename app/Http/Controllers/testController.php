<?php

namespace App\Http\Controllers;


use App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;
use App\Cart;
use App\Brand;
use App\Product;
use App\Category;
use App\Shop;
use App\ShopSold;

class testController extends Controller
{
    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;
    
    /*public function order (Request $request)
    {
        $id = $request->id;
        $banner = Shop::find($id);

        if ($request->low) {
            $products = Product::OrderBy('price')->where('shop_id', '=', $id)->get();
        }
        elseif ($request->high) {
            $products = Product::OrderBy('price', 'desc')->where('shop_id', '=', $id)->get();
        }
        return view('shop.index', compact('products', 'banner'));
    }*/

    public function orderlow($id)
    {
        $banner = Shop::find($id);
        $products = Product::OrderBy('price')->where('shop_id', '=', $id)->Paginate(20);
        $relacion = false;
        $orden = "Menor Precio";
        return view('shop.index', compact('products', 'banner', 'relacion', 'orden'));
    }

    public function orderhigh($id)
    {
        $banner = Shop::find($id);
        $products = Product::OrderBy('price', 'desc')->where('shop_id', '=', $id)->Paginate(20);
        $relacion = false;
        $orden = "Mayor Precio";
        return view('shop.index', compact('products', 'banner', 'relacion', 'orden'));
    }

    public function ordernewst($id)
    {
        $banner = Shop::find($id);
        /*$products = DB::table('products')->leftjoin('shop_solds', 'shop_solds.shop_id', '=', 'products.shop_id')
                    ->where('products.shop_id', '=', $id)->where('products.id', '=', 'shop_solds.product_id')->get();
        */
        $products = ShopSold::OrderBy('sold', 'desc')->where('shop_id', '=', $id)->Paginate(20);
        /*foreach($products as $prod) {
            dd($prod->product->product_name);
        }*/
        $relacion = true;
        $orden = "Popularidad";
        return view('shop.index', compact('products', 'banner', 'relacion', 'orden'));
    }

    public function orderaz($id)
    {
        $banner = Shop::find($id);
        $products = Product::OrderBy('product_name')->where('shop_id', '=', $id)->Paginate(20);
        $relacion = false;
        $orden = "Productos A-Z";
        return view('shop.index', compact('products', 'banner', 'relacion', 'orden'));
    }

    public function orderza($id)
    {
        $banner = Shop::find($id);
        $products = Product::OrderBy('product_name', 'desc')->where('shop_id', '=', $id)->Paginate(20);
        $relacion = false;
        $orden = "Productos Z-A";
        return view('shop.index', compact('products', 'banner', 'relacion', 'orden'));
    }


}
