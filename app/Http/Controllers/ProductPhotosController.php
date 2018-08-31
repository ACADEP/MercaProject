<?php 

namespace App\Http\Controllers;

use App\Product;
use App\ProductPhoto;
use App\AddPhotoToProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ProductPhotoRequest;

class ProductPhotosController extends Controller {

    public function store($id) {

        
        $product=Product::find($id)->get();
        $this->validate(request(),[
            'photoProducto'=>'image|max:2048'
        ]);
        $file=request()->file('photoProducto');
        $photourl=$file->store($product->category->category);
        $imageProduct=ProductPhoto::create([
            'product_id'=>$product->id,
            'name'=>$file,
            'path'=>Storage::url($photourl),
            'thumbnail_path'=>Storage::url($photourl),
            'featured'=>0
        ]);
        
        return back();
       
        
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        // Find the photo and delete it.
        ProductPhoto::findOrFail($id)->delete();
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