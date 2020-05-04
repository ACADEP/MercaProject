<?php 

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;

use App\Http\Requests\BrandsRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;

use File;
use Illuminate\Support\Facades\Input;

use App\Http\Traits\CartTrait;
use App\Http\Traits\BrandAllTrait;
use Illuminate\Support\Facades\Auth;


class BrandsController extends Controller {

    use BrandAllTrait, CartTrait;


    public function showBrands() 
    {
        $brands = Brand::select("*")->paginate(config('configurations.paginate_general'));
        return view('admin.brands.index', compact('brands'));
    }

    public function showEdit($brand)
    {
        $brand=Brand::find($brand);
        return view('admin.brands.edit', compact('brand'));
    }


    /**
     * Return all Products under brands
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProductsForBrand($id) {

        // Get the Brand name under this id
        $brands = Brand::where('id', '=', $id)->get();

        // Get all products under this brand
        $products = Product::where('brand_id', '=', $id)->get();

        // Count to see if there are any products under this brand
        $count = Product::where('brand_id', '=', $id)->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.brand.show_products', compact('brands', 'products', 'count', 'cart_count'));
    }

    public function addBrand(Request $request)
    {
        $request->validate([
            'brand_name'=>'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $file=$request->file('logo')->store('/Brands');

        $brand=new Brand;
        $brand->brand_name=$request->brand_name;
        $brand->banner="img-".$request->brand_name;
        $brand->path="/images/".$file;
        $brand->thumbnail_path="/images/".$file;
        $brand->save();

        return back()->with("success", "Marca creada");
    }


    /**
     * Store the Brands in DB
     *
     * @param BrandsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BrandsRequest $request) {

        // Get all the validation rules for Brands and assign it to the Brand Model
        $brands = new Brand($request->all());

        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot create Brand because you are signed in as a test user.');
        } else {
            // Save the Brands in DB
            $brands->save();

            // Flash a success message
            flash()->success('Success', 'Brand created successfully!');
        }

        // Redirect back to Show all brands page.
        return redirect('admin/brands');
    }


   
    public function edit(Request $request) 
    {
        
        $request->validate([
            'brand_name'=>'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        

        $brand=Brand::find($request->brand);
        $brand->brand_name=$request->brand_name;
        $brand->banner="img-".$request->brand_name;
        
        if($request->file('logo')!=null)
        {
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if($brand->path!=null)
            {
                File::delete(public_path($brand->path));
                $file=$request->file('logo')->store('/images/Brands');
                $brand->path="/".$file;
                $brand->thumbnail_path="/".$file;
            }
           
        }
        
        $brand->save();

        return back()->withFlash("Marca actualizada");
    }


    /**
     * Update a Brand
     *
     * @param $id
     * @param BrandsRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, BrandsRequest $request) {

        // Find the brand ID in URL route
        $brands = Brand::findOrFail($id);


        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot edit Brand because you are signed in as a test user.');
        } else {
            // Update the brand with Request rules
            $brands->update($request->all());

            // Flash success message
            flash()->success('Success', 'Brand update successfully!');
        }

        return redirect('admin/brands');
    }


    public function deleteBrand(Request $request) 
    {
        $brand=Brand::find($request->brand_id);
        $brand_name=$brand->brand_name;
        File::delete(public_path($brand->path));
        $brand->delete();
        return response("La marca ".$brand_name." ha sido eliminada");
    }



    public function filtros(Request $request) {
        $brand = Brand::find($request->id);
        
        $query = Product::where('brand_id', '=', $request->id);
                   
        $categorias = Category::select("*")->whereIn("id",$query->select("cat_id"))->get();
        $marcas = Brand::select("*")->whereIn("id",$query->select("brand_id"))->get();


        $filter=Product::whereIn("id",$query->select("products.id"));


        if($request->desde > 0)
        {
        $filter->whereRaw('IF(reduced_price > 0, reduced_price, price) >= ?', [$request->desde]);
        }

        if($request->hasta > 0)
        {
        $filter->whereRaw('IF(reduced_price > 0, reduced_price, price) <= ?', [$request->hasta]);
        }

        if($request->brand != null)
        {
        $filter->whereIn("brand_id",$request->brand);
        }

        if($request->categories != null)
        {
        $filter->whereIn("cat_id",$request->categories);
        }      

        if ($request->order != null) 
        {
            switch ($request->order) {
                case 'Menor':
                $filter->orderByRaw("IF(reduced_price > 0, reduced_price, price)");
                break;
                case 'Mayor':
                $filter->orderByRaw("IF(reduced_price > 0, reduced_price, price) desc");
                break;
                case 'AZ':
                $filter->orderBy("product_name");
                break;
                case 'ZA':
                $filter->orderBy("product_name","desc");
                break;
                default:
                $filter->orderBy("product_name");
                break;
            }
        }

        $old_inputs=$request;
        $products=$filter->paginate(12);

        return view('brand.show', compact('products', 'brand', 'marcas','categorias','old_inputs'));
    }



}