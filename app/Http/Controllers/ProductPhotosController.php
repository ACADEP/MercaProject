<?php 

namespace App\Http\Controllers;

use App\Product;
use App\ProductPhoto;
use App\AddPhotoToProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ProductPhotoRequest;

class ProductPhotosController extends Controller {

    public function store(Request $request) {

        
        $product=Product::where('id',$request->get("product_id"))->with("category")->first();
        $this->validate(request(),[
            'photoProducto'=>'image|max:2048'
        ]);
        
        if($product->photos()->count()<5)
        {
            $file=request()->file('photoProducto');
            $photourl=$file->store($product->category->category);       
            $imageProduct=ProductPhoto::create([
                'product_id'=>$product->id,
                'name'=>$file,
                'path'=>"/images/".(string)$photourl,
                'thumbnail_path'=>"/images/".(string)$photourl,
                'featured'=>0
            ]);
            $url=route('delete-Photo',$imageProduct->id);
            return response(['imageUrl'=>$imageProduct->path,"url"=>$url],200);
        }
        else
        {
            return response(['imageUrl'=>null,"url"=>null],200);
        }
        
    
       
        
    }


   
    public function delete($id) {
        // Find the photo and delete it.
        $productPhoto=ProductPhoto::find($id);
  
        if(File::delete(public_path($productPhoto->path)))
        {
            $productPhoto->delete();
        }
        
        // Then return back;
        return back();
    }


    /**
     * Store and update the featured photo for a product
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeFeaturedPhoto($id, Request $request) {
        // Validate featured button
        $this->validate($request, [
            'featured' => 'required|exists:product_images,id'
        ]);

        // Grab the ID of the Image being featured from radio button
        $featured = Input::get('featured');

        // Select from "product_images" where the 'product_id' = the ID in the URL, and update "featured" column to 0
        ProductPhoto::where('product_id', '=', $id)->update(['featured' => 0]);

        // Find the $featured result and update "featured" column to 1
        ProductPhoto::findOrFail($featured)->update(['featured' => 1]);


        // Return redirect back
        return redirect()->back();
    }


}