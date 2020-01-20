<?php

use Illuminate\Database\Seeder;
use App\ApiRequest;
use App\Product;
use App\ProductPhoto;
use App\Brand;
use App\Category;

class UpdateProductsApi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
       
       $brands=Brand::select("*")->get();
       foreach ($brands as $brand) 
       {
        $brand=Brand::findOrFail($brand->id);
        Product::setQtybyBrand($brand->id);
        $inventario=0;
        var_dump($brand->brand_name);
        $requestAPI=ApiRequest::ProductbyBrand($brand->brand_name);
      
            
            foreach ($requestAPI as $value) 
            {
                $band=false;
                $inventario=$value['disponible']+$value['VENTAS_GUADALAJARA'];
                if(count($value) > 0)
                {
                    $product=Product::where("product_sku", $value["clave"])->with('photos')->get();
                   
                    if($product->count() == 0)
                    {
                       
                        if($inventario > 0)
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
    
                        $product->product_qty=(int)$inventario;
                       
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
           
       }
    }
}
