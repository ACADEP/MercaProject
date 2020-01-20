<?php

use Illuminate\Database\Seeder;
use App\ApiRequest;
use App\Product;
use App\ProductPhoto;
use App\Brand;
use App\Category;

class DBProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandsAPI=ApiRequest::AllBrands();

        foreach ($brandsAPI as $brand)
        {
            $br=new Brand;
            $br->brand_name=$brand;
            $br->save();
        }

        $categoriesAPI=ApiRequest::AllCategories();

        foreach ($categoriesAPI as $category)
        {
            $br=new Category;
            $br->category=$category;
            $br->parent_id=0;
            $br->save();
        }

       
       
        $brands=Brand::select("*")->get();
        foreach ($brands as $brand) 
        {
            var_dump($brand->brand_name);
            $requestAPI=ApiRequest::ProductbyBrand($brand->brand_name);
           
            foreach ($requestAPI as $value) {
               
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
                        if($category)
                        {
                            $product->cat_id=$category->id;
                        }
        
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
                        $foto=$value['imagen'];
                    }
                    
                    $productphoto->name=$value['descripcion'];
                    $productphoto->path=$foto;
                    $productphoto->thumbnail_path=$foto;
                    $productphoto->save();
                    
                }
    
            }
        }

        
    }
}
