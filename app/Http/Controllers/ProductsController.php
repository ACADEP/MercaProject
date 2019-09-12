<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\ProductPhoto;
use App\ShopSold;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ValidateProducts;
use App\Http\Requests\ProductEditRequest;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;
use File;
use LaravelQRCode\Facades\QRCode;


class ProductsController extends Controller {

    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;


    public function showProducts() 
    {
        $products=Product::where('company_id', Auth::user()->company_id)->paginate(config('configurations.paginate_general'));
        return view('admin.products.products.index', compact('products'));
    }

    public function showEdit(Product $product)
    {
        
        return view('admin.products.products.edit',compact('product'));
    }


    public function addProduct(ValidateProducts $request) 
    {
        
        $product=new Product;
        $product->company_id=Auth::user()->company_id;
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
        if($request->get("code_mode")!=null)
        {
            $product->product_manufacturer=$request->get("code_mode");
        }
        if($request->get("guaranty")!=null)
        {
            $product->guaranty=$request->get("guaranty");
        }
        if($request->get("date_prom")!=null)
        {
            $date = strtotime($request->get("date_prom"));
            $product->date_prom=date('Y-m-d H:i:s', $date);
        }

        $product->weight=$request->weight;
        $product->length=$request->length;
        $product->height=$request->height;
        $product->width=$request->width;

        $product->save();

        return back()->with('product_added', "Producto agregado");

    }

    public function updateProduct(ValidateProducts $request)
    {
        $product=Product::find($request->product_id);
        $product->company_id=Auth::user()->company_id;
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
        if($request->get("code_mode")!=null)
        {
            $product->product_manufacturer=$request->get("code_mode");
        }
        if($request->get("guaranty")!=null)
        {
            $product->guaranty=$request->get("guaranty");
        }
        if($request->get("date_prom")!=null)
        {
            $date = strtotime($request->get("date_prom"));
            $product->date_prom=date('Y-m-d H:i:s', $date);
        }

        $product->weight=$request->weight;
        $product->length=$request->length;
        $product->height=$request->height;
        $product->width=$request->width;

        $product->save();

        return back()->with('msg-success', "Producto actualizado");
    }



    public function deleteProduct(Request $response) {

        $product=Product::find($response->product_id);
        $product->shopsold()->delete();
        $product_name=$product->product_name;
        foreach($product->photos()->get() as $photo)
        {
            File::delete(public_path($photo->path));
        }
        $product->photos()->delete();
        $product->delete();
        return response("El producto ".$product_name." ha sido eliminada");
      
        
      
       
    }


    /**
     * Display the form for uploading images for each Product
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayImageUploadPage($id) {

        // Get the product ID that matches the URL product ID.
        $product = Product::where('id', '=', $id)->get();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.product.upload', compact('product', 'cart_count'));
    }


    /**
     * Show a Product in detail
     *
     * @param $product_name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($product_name) {

          
        // Find the product by the product name in URL
        $product = Product::ProductLocatedAt($product_name);

        // From Traits/SearchTrait.php
        // Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $categories = $this->categoryAll();

        // Get brands to display left nav-bar
        $brands = $this->BrandsAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        //previous URL for breadcrumbs
        // $URL = url()->previous();
        // $URLoffers = substr($URL, 27, 7);
        // $URLnewprod = substr($URL, 27, 13);
        // $URLsearch = substr($URL, 27, 8);
        // $previousURL = substr($URL, 27);
        // dd($URLnewprod);

        //Codigo QR
        
        //previous URL for breadcrumbs
        $URL = $this->Breadcrumb();
       
        $similar_product = Product::where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('brand_id', '=', $product->brand_id)
                    ->orWhere('cat_id', '=', $product->cat_id);
            })->get();

        return view('pages.show_product', compact('product', 'URL', 'search', 'brands', 'categories', 'similar_product', 'cart_count'));
    }

    public function Breadcrumb() {
        //previous URL for breadcrumbs
        $URL = url()->previous();
        $URLoffers = substr($URL, 27, 7);
        $URLnewprod = substr($URL, 27, 13);
        $URLsearch = substr($URL, 27, 8);
        $previousURL = substr($URL, 27);
        $URLbrand = substr($URL, 27, 8);
        $URLshop = substr($URL, 27, 7);
        $URLprevious = [$URLoffers, $URLnewprod, $URLsearch, $previousURL, $URLbrand, $URLshop];

        return $URLprevious;
    }

    public function qr_code()
    {
       
        return QRCode::url(url()->previous())
        ->setSize(5)
        ->setMargin(2)
        ->png();
    }

    


}