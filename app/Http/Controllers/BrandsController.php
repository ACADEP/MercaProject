<?php 

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
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
        if($request->file('logo')!=null)
        {
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $file=$request->file('logo')->store('/Brands');
        }
        

        $brand=Brand::find($request->brand);
        $brand->brand_name=$request->brand_name;
        $brand->banner="img-".$request->brand_name;
        if($request->file('logo')!=null)
        {
            File::delete(public_path($brand->path));
            $brand->path="/images/".$file;
            $brand->thumbnail_path="/images/".$file;
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
        $brands = Brand::find($request->id);
        $orden = $brands;
        $idbrand = $request->id;
        // dd($request);
        // $products = "";
        $relacion = false;
        $brandFilter = $request->brand;
        $catFilter = $request->categories;
        $minFilter = $request->desde;
        $maxfilter = $request->hasta;
        $labels = 1;
        // dd($brandFilter);

        $query = $brands->product();
        $querybrands = $brands->product();
        $querybadge = $brands->product();

        $query = $query->join('categories', 'cat_id', '=', 'categories.id');  
        $querybrands = $querybrands->join('brands', 'brand_id', '=', 'brands.id');  
        $querybadge = $querybadge->join('brands', 'brand_id', '=', 'brands.id')
        ->join('categories', 'cat_id', '=', 'categories.id');  

        $categorias = array();
        $categorias['id'] = $query->select("categories.id")->groupBy('categories.id')->pluck('categories.id');
        $categorias['category'] = $query->select("category")->groupBy('category')->pluck('category');

        $marcas = array();
        $marcas['id'] = $querybrands->select("brands.id")->groupBy('brands.id')->pluck('brands.id');
        $marcas['brand_name'] = $querybrands->select("brand_name")->groupBy('brand_name')->pluck('brand_name');

        $badge = Product::select("products.*")->join('brands', 'brand_id', '=', 'brands.id')
        ->join('categories', 'cat_id', '=', 'categories.id');  

        $hasta = $request->hasta;
        $desde = $request->desde;
        $brand = $request->brand;
        $d = $request->desde;
        $h = $request->hasta;
        $b = $request->brand;


        $marc = array();
        $marca =  array();
        $cat = array();
        $categoria = array();
        if($request->fil == 0) {
            // $d = $request->desde;
            // $h = $request->hasta;
            $desde = json_decode($d);
            $hasta = json_decode($h);
            $brand = json_decode($b);

            $cb = $request->brand;
            $m = null;
            $c = 0;
            for ($i=0; $i < strlen($request->brand); $i++) { 
                if($i+1 == strlen($request->brand)) {
                    $m = $m.$cb[$i];
                    $marc[$c] = $m;
                } elseif ($cb[$i] != ",") {
                    $m = $m.$cb[$i];
                } elseif ($cb[$i] == ",") {
                    $marc[$c] = $m;
                    $m = null;
                    $c++;
                }
            }
            // dd($marc);
            $marca = Brand::wherein('brand_name', $marc)->get();
            // dd($marca);

            $cc = $request->categories;
            $ca = null;
            $a = 0;
            for ($i=0; $i < strlen($request->categories); $i++) { 
                if($i+1 == strlen($request->categories)) {
                    $ca = $ca.$cc[$i];
                    $cat[$a] = $ca;
                } elseif ($cc[$i] != ",") {
                    $ca = $ca.$cc[$i];
                } elseif ($cc[$i] == ",") {
                    $cat[$a] = $ca;
                    $ca = null;
                    $a++;
                }
            }
            // dd($marc);
            $categoria = Category::wherein('category', $cat)->get();
            // dd($categoria);

            $brandFilter = $marca;
            $catFilter = $categoria;
            $minFilter = $desde;
            $maxfilter = $hasta;
            $labels = 0;
            // dd($maxfilter);
        }

        $ordenamiento = "Menor Precio";
        // $products = Product::OrderBy('price')->where('shop_id', '=', $request->id)->where('price', '>=', $request->desde)->Paginate(5);

        // Filtro por Precio Maximo
        if($brand==null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::OrderByRaw('(price - reduced_price) DESC')->where('brand_id',$request->id)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::OrderByRaw('(price - reduced_price) DESC')->where('brand_id',$request->id)->where('price', '<=', $hasta)->paginate(12);
            }        

        } // Filtro por Precio Minimo
        else if($brand==null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)->where('price', '>=', $request->desde)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)->where('price', '>=', $desde)->paginate(12);
            }       

        } // Filtro por Precio Minimo y Precio Maximo
        else if($brand==null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $desde)->where('price', '<=', $hasta)->paginate(12);
            }            

        } // Filtro por Marca
        else if($brand!=null && $request->get("categories")==null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::where('brand_id', $request->id)->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = Product::where('brand_id', $request->id)->whereIn('brand_id', $marca)->paginate(12);
            }       

        } // Filtro por Categoria
        else if($brand==null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::where('brand_id', $request->id)->whereIn('cat_id', $request->categories)->paginate(12);
                dd($products);
            } else {
                $products = Product::where('brand_id', $request->id)->whereIn('cat_id', $categoria)->paginate(12);
            }

        } // Filtro por Marca y Categoria
        else if($brand!=null && $request->get("categories")!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::where('brand_id', $request->id)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::where('brand_id', $request->id)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->paginate(12);
            }

        } // Filtro por Marca y Precio Minimo
        else if($brand!=null && $request->get("categories")==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->paginate(12);
            }  

        } // Filtro por Marca y Precio Maximo
        else if($brand!=null && $request->get("categories")==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('brand_id', $request->id)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('brand_id', $request->id)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Minimo
        else if($brand==null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $request->desde)->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $desde)->whereIn('cat_id', $categoria)->paginate(12);
            }
            
        } // Filtro por Categoria y Precio Maximo
        else if($brand==null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('brand_id', $request->id)
                ->where('price', '<=', $request->hasta)->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('brand_id', $request->id)
                ->where('price', '<=', $hasta)->whereIn('cat_id', $categoria)->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Minimo
        else if($brand!=null && $request->get("categories")!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->paginate(12);
            }
            
        } // Filtro por Marca, Categoria y Precio Maximo
        else if($brand!=null && $request->get("categories")!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('brand_id', $request->id)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) DESC')->where('brand_id', $request->id)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)
                ->whereIn('cat_id', $categoria)->paginate(12);
            }
            
        } // Filtro por Marca, Precio Minimo y Precio Maximo
        else if($brand!=null && $request->get("categories")==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = $querybadge->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_name', $marca)->where('brand_id', $request->id)
                ->orderByRaw('(price - reduced_price) ASC')->paginate(12);
            }
        }
        // Filtro por Categoria, Precio Minimo y Precio Maximo
        else if($brand==null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('cat_id', $request->categories)->paginate(12);
            } else {
                $products = $querybadge->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('cat_id', $categoria)->where('brand_id', $request->id)
                ->orderByRaw('(price - reduced_price) ASC')->paginate(12);
            }
        } // Filtro por Marca, Categoria, Precio Minimo y Precio Maximo
        else if($brand!=null && $request->get("categories")!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $request->desde)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)
                ->whereIn('cat_id', $request->categories)->where('brand_id', $request->id)->paginate(12);
            } else {
                $products = Product::orderByRaw('(price - reduced_price) ASC')->where('price', '>=', $desde)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->whereIn('cat_id', $categoria)
                ->where('brand_id', $request->id)->paginate(12);
            }
            
        } 
        else if($brand==null && $request->get("categories")==null && $desde==null && $hasta==null) {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)->paginate(12);
        } else if ($request->clear == 'clear') {
            $products = Product::orderByRaw('(price - reduced_price) ASC')->where('brand_id', $request->id)->paginate(12);
        }
        // dd($maxfilter);

        return view('brand.show', compact('products', 'brands', 'orden', 'marcas', 'categorias', 'relacion', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels', 'idbrand'));
    }



}