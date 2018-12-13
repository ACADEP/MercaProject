<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

use App\Http\Traits\CartTrait;
use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use Illuminate\Support\Facades\Auth;


class CategoriesController extends Controller {

    use BrandAllTrait, CategoryTrait, CartTrait;


    /**
     * Return all categories with their sub-categories
     *
     * @return $this
     */
    public function showCategories() {

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $categories = $this->categoryAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.category.show', compact('cart_count'))->with('categories', $categories);
    }


    /**
     * Return all Products under sub-categories
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProductsForSubCategory($id) {

        // Get the Category name under this category
        $categories = Category::where('id', '=', $id)->get();

        // Get all products under this sub-category
        $products = Product::where('cat_id', '=', $id)->get();

        // Count to see if there are any products under this category
        $count = Product::where('cat_id', '=', $id)->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.category.show_products', compact('categories', 'products', 'count', 'cart_count'));
    }


    /**
     * Return the view for add new category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addCategories() {

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.category.add', compact('cart_count'));
    }


    /**
     * Add a new category to database
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addPostCategories(CategoryRequest $request) {
        // Assign $category to the Category Model, and request all validation rules
        $category = new Category($request->all());


        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot create Category because you are signed in as a test user.');
        } else {
            // Then save the newly created category in DB
            $category->save();

            // Flash a success message
            flash()->success('Success', 'Category added successfully!');
        }

        // Redirect back to Show all categories page.
        return redirect()->route('admin.category.show');
    }


    /**
     * Get the view ot edit a category
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editCategories($id) {
        // Select all from categories where the id = the id on the page
        $category = Category::where('id', '=', $id)->find($id);

        // If no category exists with that particular ID, then redirect back to Show Category Page.
        if (!$category) {
            return redirect('admin/categories');
        }

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.category.edit', compact('category', 'cart_count'));
    }


    /**
     * Update a Category.
     *
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateCategories($id, CategoryRequest $request) {
        // Find the category id being updated
        $category = Category::findOrFail($id);

        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot edit Category because you are signed in as a test user.');
        } else {
            // Update the category with all the validation rules from CategoryRequest.php
            $category->update($request->all());
            // Flash a success message
            flash()->success('Success', 'Category updated successfully!');
        }

        // Redirect back to Show all categories page.
        return redirect()->route('admin.category.show');
    }


    /**
     * Delete a Category
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCategories($id) {
        // Find the category id and delete it from DB.
        $delete = Category::findOrFail($id);

        // Get all sub categories where the parent_id = to the category id
        $sub_category = Category::where('parent_id', '=', $id)->count();

        // If there are any sub-categories under a parent category, then throw
        // a error overlay message, saying to delete all sub categories under the parent
        // category, else delete the parent category
        if ($sub_category > 0) {
            // Flash a error overlay message
            flash()->customErrorOverlay('Error', 'There are sub-categories under this parent category. Cannot delete this category until all sub-categories under this parent category are deleted');
        } elseif (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot delete Category because you are signed in as a test user.');
        } else {
            $delete->delete();
        }

        // Then redirect back.
        return redirect()->back();
    }


    /************************************ ****Sub-Categories below ****************************************************/


    /**
     * Return the view for add new sub category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addSubCategories($id) {

        $category = Category::findOrFail($id);

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.category.addsub', compact('category', 'cart_count'));
    }


    /**
     * Add a sub category to a parent category
     *
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPostSubCategories($id, CategoryRequest $request) {

        // Find the Parent Category ID
        $category = Category::findOrFail($id);

        // Create the new Subcategory
        $subcategory = new Category($request->all());

        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot create Sub-Category because you are signed in as a test user.');
        } else {
            // Save the new subcategory into the relationship
            $category->children()->save($subcategory);

            // Flash a success message
            flash()->success('Success', 'Sub-Category added successfully!');
        }

        // Redirect back to Show all categories page.
        return redirect()->route('admin.category.show');
    }


    /**
     * Get the view ot edit a sub-category
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editSubCategories($id) {
        // Select all from categories where the id = the id on the page
        $category = Category::where('id', '=', $id)->find($id);

        // If no sub-category exists with that particular ID, then redirect back to Show Category Page.
        if (!$category) {
            return redirect('admin/categories');
        }

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.category.editsub', compact('category', 'cart_count'));
    }


    /**
     * Update a Sub-Category.
     *
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateSubCategories($id, CategoryRequest $request) {
        // Find the category id being updated
        $category = Category::findOrFail($id);

        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot edit Sub-Category because you are signed in as a test user.');
        } else {
            // Update the category with all the validation rules from CategoryRequest.php
            $category->update($request->all());

            // Flash a success message
            flash()->success('Success', 'Sub-Category updated successfully!');
        }

        // Redirect back to Show all categories page.
        return redirect()->route('admin.category.show');
    }

    /**
     * Delete a Sub-Category
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSubCategories($id) {

        // Find the sub-category id and delete it from DB.
        $delete_sub = Category::findOrFail($id);

        // Get all sub categories where the parent_id = to the category id
        $products = Product::where('cat_id', '=', $id)->count();


        // If there are any sub-categories under a parent category, then throw
        // a error overlay message, saying to delete all sub categories under the parent
        // category, else delete the parent category
        if ($products > 0) {
            // Flash a error overlay message
            flash()->customErrorOverlay('Error', 'There are products under this sub-category. Cannot delete this sub-category until all products under this sub-category are deleted');
        } elseif (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot delete Sub-Category because you are signed in as a test user.');
        } else {
            $delete_sub->delete();
        }


        // Then redirect back.
        return redirect()->back();
    }





    /* ******************************** filtros de las categorias ******************************** */
    public function filtros(Category $category, Request $request) {
        // dd($request);
        $categoryFil = Category::find($request->catid);
        // dd($categoryFil);
        $brandFilter = $request->brand;
        $catFilter = $request->categories;
        $minFilter = $request->desde;
        $maxfilter = $request->hasta;
        $labels = 1;
        $ordenamiento = "Ordenar Por";

        $querybrands = $categoryFil->products();

        $querybrands = $querybrands->join('brands', 'brand_id', '=', 'brands.id');  

        $marcas = array();
        $marcas['id'] = $querybrands->select("brands.id")->groupBy('brands.id')->pluck('brands.id');
        $marcas['brand_name'] = $querybrands->select("brand_name")->groupBy('brand_name')->pluck('brand_name');

        $hasta = $request->hasta;
        $desde = $request->desde;
        $d = $request->desde;
        $h = $request->hasta;

        $brand = $request->brand;

        $marc = array();
        $marca =  array();
        $cat = array();
        $categoria = array();

        if($request->fil == 0) {
            $categoryFil = Category::find($request->catid);
            $desde = json_decode($d);
            $hasta = json_decode($h);
            // dd($request->brand);
            if($request->brand) {
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
            } else {
                $marca = null;
            }
            // dd($marca);

            if($request->categories) {
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
                $categoria = Category::wherein('category', $cat)->get();    
            } else {
                $categoria = null;
            }

            // dd($marca);

            $brandFilter = $marca;
            $catFilter = $categoria;
            $minFilter = $desde;
            $maxfilter = $hasta;
            $labels = 0;
        }
        // dd($marca);

        // Filtro por Precio Maximo
        if($brand==null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = $categoryFil->products()->OrderByRaw('(price - reduced_price) DESC')->where('cat_id', $request->catid)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = $categoryFil->products()->OrderByRaw('(price - reduced_price) DESC')->where('cat_id', $request->catid)->where('price', '<=', $hasta)->paginate(12);
            }        

        } // Filtro por Precio Minimo
        else if($brand==null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = $categoryFil->products()->orderByRaw('(price - reduced_price) ASC')->where('cat_id', $request->catid)->where('price', '>=', $request->desde)->paginate(12);
            } else {
                $products = $categoryFil->products()->orderByRaw('(price - reduced_price) ASC')->where('cat_id', $request->catid)->where('price', '>=', $desde)->paginate(12);
            }       

        } // Filtro por Precio Minimo y Precio Maximo
        else if($brand==null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = $categoryFil->products()->orderByRaw('(price - reduced_price) ASC')->where('cat_id', $request->catid)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)->paginate(12);
            } else {
                $products = $categoryFil->products()->orderByRaw('(price - reduced_price) ASC')->where('cat_id', $request->catid)
                ->where('price', '>=', $desde)->where('price', '<=', $hasta)->paginate(12);
            }            

        } // Filtro por Marca
        else if($brand!=null && $desde==null && $hasta==null)
        {
            if ($request->fil == 1) {
                // dd($request->brand);
                $products = $categoryFil->products()->where('cat_id', $request->catid)->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = $categoryFil->products()->where('cat_id', $request->catid)->whereIn('brand_id', $marca)->paginate(12);
            }       
            // dd($products);
        } 
        // Filtro por Marca y Precio Minimo
        else if($brand!=null && $desde!=null && $hasta==null)
        {
            if ($request->fil == 1) {
                $products = $categoryFil->products()->orderByRaw('(price - reduced_price) ASC')->where('cat_id', $request->catid)
                ->where('price', '>=', $request->desde)->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = $categoryFil->products()->orderByRaw('(price - reduced_price) ASC')->where('cat_id', $request->catid)
                ->where('price', '>=', $desde)->whereIn('brand_id', $marca)->paginate(12);
            }  

        } // Filtro por Marca y Precio Maximo
        else if($brand!=null && $desde==null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = $categoryFil->products()->orderByRaw('(price - reduced_price) DESC')->where('cat_id', $request->catid)
                ->where('price', '<=', $request->hasta)->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = $categoryFil->products()->orderByRaw('(price - reduced_price) DESC')->where('cat_id', $request->catid)
                ->where('price', '<=', $hasta)->whereIn('brand_id', $marca)->paginate(12);
            }
            
        }
        // Filtro por Marca, Precio Minimo y Precio Maximo
        else if($brand!=null && $desde!=null && $hasta!=null)
        {
            if ($request->fil == 1) {
                $products = $categoryFil->products()->orderByRaw('(price - reduced_price) ASC')->where('cat_id', $request->catid)
                ->where('price', '>=', $request->desde)->where('price', '<=', $request->hasta)
                ->whereIn('brand_id', $request->brand)->paginate(12);
            } else {
                $products = $querybadge->where('price', '>=', $desde)->where('price', '<=', $hasta)
                ->WhereIn('brand_name', $marca)->where('cat_id', $request->catid)
                ->orderByRaw('(price - reduced_price) ASC')->paginate(12);
            }
        }
        else if($brand==null && $desde==null && $hasta==null) {
            $products = $categoryFil->products()->orderByRaw('(price - reduced_price) ASC')->where('cat_id', $request->catid)->paginate(12);
        } else if ($request->clear == 'clear') {
            $products = $categoryFil->products()->orderByRaw('(price - reduced_price) ASC')->where('cat_id', $request->catid)->paginate(12);
        }
        // dd($request);

        return view("pages.products-category", compact('products', 'ordenamiento', 'brandFilter', 'catFilter', 'minFilter', 'maxfilter', 'labels', 'marcas'));
    }


}