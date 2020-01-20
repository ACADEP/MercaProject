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

class ApiController extends Controller
{
    function getBrands()
    {

        //Actualizar las marcas
        $brandsAPI=ApiRequest::AllBrands();
        foreach ($brandsAPI as $brand)
        {
            if(Brand::where("brand_name",$brand)->count() <= 0)
            {
                $br=new Brand;
                $br->brand_name=$brand;
                $br->save();
            }
        }

        //Actualizar las categorias
        $categoriesAPI=ApiRequest::AllCategories();
        foreach ($categoriesAPI as $category)
        {
           if(Category::where("category",$category)->count() <= 0)
           {
               $br=new Category;
               $br->category=$category;
               $br->parent_id=0;
               $br->save();
           }
        }
        
        //Regresar los id de las marcas
        return Brand::pluck('id');
    }

    function updateProduct(Request $request)
    {
        $brand=Brand::findOrFail($request->brand_id); //Buscar marca por id
        Product::setQtybyBrand($request->brand_id); //Resetar la cantidad de los productos por marca
        $inventario=0; //Variable para sumar inventarios de la paz y guadalajara
        
        $requestAPI=ApiRequest::ProductbyBrand($brand->brand_name); //Obtener los productos de la api de CVA
           
        foreach ($requestAPI as $value) 
        {
            $band=false; //Variable de control para productos sin inventario

            $inventario=$value['disponible']+$value['VENTAS_GUADALAJARA']; //Variable de suma de inventarios de la paz y guadalajara

            if(count($value) > 0) //Condicion para si el producto contiene información
            {
                $product=Product::where("product_sku", $value["clave"])->with('photos')->get(); //Obteber producto por sku

                if($product->count() == 0) //Condicion para conocer si existe el producto en la base de datos
                {
                    
                    if($inventario > 0) //Condicion para conocer si existe inventario del producto
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

                if($band) //Condicion para ingresar o actualizar el producto si existe inventario
                {
                    $product->company_id=1;

                    $product->product_qty=(int)$inventario;
                    
                    $product->product_name=str_replace("/","-",$value['descripcion']);
                    $product->product_sku=$value['clave'];
                    $product->price=$value['precio'];
                    
                    if($value['PrecioDescuento']=='Sin Descuento') //Condicion para ingresar si existe descuento
                    {
                        $product->reduced_price=0;
                        $product->featured=0;
                    }
                    else
                    {
                        $product->reduced_price=$value['PrecioDescuento'];
                        $product->featured=1; //Establecer el producto destacado
                    }
                    
                    if(!empty($value['marca'])) //Condicion para ingresar si existe marca
                    {
                        $brand=Brand::where("brand_name",$value['marca'])->first();
                        $product->brand_id=$brand->id;
        
                    }
                
                    if(!empty($value['grupo'])) //Condicion para ingresar si existe categoria
                    {
                        $category=Category::where("category",$value['grupo'])->first();
                        if($category)
                        {
                            $product->cat_id=$category->id;
                        }
                    }
                    
                    $ficha="";
                    if(!empty($value['ficha_comercial'])) //Condicion para ingresar si existe descripcion
                    {
                        $ficha=$value['ficha_comercial'];
                    }
                    $product->description=$ficha;
                    
                    $ficha="";
                    if(!empty($value['ficha_tecnica'])) //Condicion para ingresar si existe especificaciones
                    {
                        $ficha=$value['ficha_tecnica'];
                    }
                    $product->product_spec=$ficha;
                    
                    $product->save(); //Salvar el producto
        
                    if($product->photos()->count() == 0) //Conocer si existe fotos del producto
                    {
                        $productphoto=new ProductPhoto();
                    }
                    else
                    {
                        $productphoto=$product->photos()->first();
                    }

                    if(!empty($value['imagen'])) //Condicion para guardar la imagen
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
}
