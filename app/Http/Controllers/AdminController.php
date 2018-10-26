<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use App\Order;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller {

   


    /**
     * Show the Admin Dashboard
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view("admin.dash");       
    }

    public function showEdit(Category $category)
    {
        return view("admin.products.categories.edit-categories", compact("category"));
    }
    
    public function showCategories()
    {
        $categories=Category::where("parent_id",0)->get();
        return view("admin.products.categories.index", compact("categories"));
    }

    public function addCategory(Request $request)
    {
        $request->validate(
        [
            'category_name' => 'required'
        ],
        [
            'category_name.required' => 'Ingresar el nombre de la categoría'
        ]);
        $newCategory=new Category;
        $newCategory->insertNewCategory($request->get('category_name'), $request->get("subC"));
        return back()->with("success", "La categoría ".$newCategory->category." ha sido creada"); 
    }

    public function editCategory(Request $request)
    {
        $request->validate(
            [
                'category_name' => 'required',
                'sub_name.*' => 'required'
            ],
            [
                'category_name.required' => 'Ingresar el nombre de la categoría',
                'sub_name.*.required' => 'Ingresar el nombre de la subcategoría'
            ]);
        $category=Category::find($request->get("category"));
        $category->updateCategory($request->get("category_name"), $request->get("sub_name"));
        return redirect()->route('show-edit',[$category])->with("success",'La categoría ha sido actualizada');
    }
    public function addSubcategories(Request $request)
    {
        \Session::put('numSubC', $request->get("subcategorias"));
        \Session::save();
        $request->validate(
            [
                'subC.*' => 'required'
            ],
            [
                'subC.0.required' => 'Ingresar el nombre de la subcategoría 1',
                'subC.1.required' => 'Ingresar el nombre de la subcategoría 2',
                'subC.2.required' => 'Ingresar el nombre de la subcategoría 3',
                'subC.3.required' => 'Ingresar el nombre de la subcategoría 4',
                'subC.4.required' => 'Ingresar el nombre de la subcategoría 5'

            ]);
        \Session::forget('numSubC');
        
        $category=Category::find($request->get("category"));
        $category->addSubcategories($request->get("subC"));
        return back();
    }
    public function deleteSubcategories(Request $request)
    {
        $category=Category::find($request->get("cat_id"));
        $category_name=$category->category;
        $category->delete();
        return response("La subcategoría ".$category_name." ha sido eliminada",200);
    }
    public function deleteCategory(Request $request)
    {
        $category=Category::find($request->get("cat_id"));
        $category_name=$category->category;
        $category->delete();
        return response("La categoría ".$category_name." ha sido eliminada",200);
    }

  

    

}