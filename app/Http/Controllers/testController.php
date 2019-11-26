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
use App\ApiRequest;
use App\ProductPhoto;

class testController extends Controller
{
    function getBrands()
    {
        
        return Brand::pluck('id');
    }

    function updateProduct(Request $request)
    {
            $brand=Brand::findOrFail($request->brand_id);
            Product::setQtybyBrand($request->brand_id);

            $requestAPI=ApiRequest::ProductbyBrand($brand->brand_name);
            
            foreach ($requestAPI as $value) 
            {
                $band=false;
               
                if(count($value) > 0)
                {
                    $product=Product::where("product_sku", $value["clave"])->with('photos')->get();

                    if($product->count() == 0)
                    {
                        if($value['disponible'] > 0)
                        {
                            $product=new Product();
                            $band=true;
                        }
                       
                       
                       
                    }
                    else
                    {
                        $product=$product->first();
                        $band=true;
                    }

                    if($band)
                    {
                        $product->company_id=1;
    
                        $product->product_qty=(int)$value['disponible'];
                       
                        $product->product_name=str_replace("/","-",$value['descripcion']);
                        $product->product_sku=$value['clave'];
                        $product->price=$value['precio'];
                       
                        if($value['PrecioDescuento']=='Sin Descuento')
                        {
                            $product->reduced_price=0;
                            $product->featured=0;
                        }
                        else
                        {
                            $product->reduced_price=$value['PrecioDescuento'];
                            $product->featured=1;
                        }
                        
                        if(!empty($value['marca']))
                        {
                            $brand=Brand::where("brand_name",$value['marca'])->first();
                            $product->brand_id=$brand->id;
            
                        }
                    
                        if(!empty($value['grupo'])){
                            $category=Category::where("category",$value['grupo'])->first();
                            $product->cat_id=$category->id;
                        }
                       
                        $ficha="";
                        if(!empty($value['ficha_comercial']))
                        {
                            $ficha=$value['ficha_comercial'];
                        }
                        $product->description=$ficha;
                        $ficha="";
                        if(!empty($value['ficha_tecnica']))
                        {
                            $ficha=$value['ficha_tecnica'];
                        }
                        $product->product_spec=$ficha;
                        $product->save();
            
                        if($product->photos()->count() == 0)
                        {
                            $productphoto=new ProductPhoto();
                        }
                        else
                        {
                            $productphoto=$product->photos()->first();
                        }

                        if(!empty($value['imagen']))
                        {
                            $foto=str_replace("http","https",$value['imagen']);
                            $productphoto->product_id=$product->id;
                            $productphoto->name=$value['descripcion'];
                            $productphoto->path=$foto;
                            $productphoto->thumbnail_path=$foto;
                            $productphoto->save();
                        }
                    }
                }
            }
            
        return response($brand->brand_name,200);   
    }

    function downloadProducts(Request $request)
    {
        $brand=Brand::findOrFail($request->brand_id);

        $requestAPI=ApiRequest::ProductbyBrand($brand->brand_name);
       
        foreach ($requestAPI as $value)
        {
        
            if(count($value) > 0  && $value['disponible'] > 0)
            {
                $product=new Product();
                $product->company_id=1;

            
                $product->product_qty=(int)$value['disponible'];
            
                
                    
                $product->product_name=str_replace("/","-",$value['descripcion']);
                $product->product_sku=$value['clave'];
                $product->price=$value['precio'];
                if($value['PrecioDescuento']=='Sin Descuento')
                {
                    $product->reduced_price=0;
                }
                else
                {
                    $product->reduced_price=$value['PrecioDescuento'];
                    $product->featured=1;
                }
            
                
                if(!empty($value['marca']))
                {
                    $product->brand_id=$brand->id;
                }
            
                if(!empty($value['grupo'])){
                    $category=Category::where("category",$value['grupo'])->first();
                    $product->cat_id=$category->id;
    
                }
            
                $ficha="";
                if(!empty($value['ficha_comercial']))
                {
                    $ficha=$value['ficha_comercial'];
                }
                $product->description=$ficha;
                $ficha="";
                if(!empty($value['ficha_tecnica']))
                {
                    $ficha=$value['ficha_tecnica'];
                }
                $product->product_spec=$ficha;
                $product->save();
    
                $productphoto=new ProductPhoto();
                $productphoto->product_id=$product->id;
                $foto="";
                if(!empty($value['imagen']))
                {
                    $foto=str_replace("http","https",$value['imagen']);
                }
                
                $productphoto->name=$value['descripcion'];
                $productphoto->path=$foto;
                $productphoto->thumbnail_path=$foto;
                $productphoto->save();
                
            }
    
        }
        

        return response($brand->brand_name,200);
    }


}
