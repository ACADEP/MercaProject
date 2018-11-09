<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use App\Order;
use App\Product;
use App\Category;
use App\ProductSeller;
use App\SeleHistory;
use App\OrderOxxo;
use App\EnviaYa;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SellerExport;
use App\Mailers\AppMailers;

class AdminController extends Controller {

   


    /**
     * Show the Admin Dashboard
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $sales=Auth::user()->selehistories()->paginate(10);
        $histories=Auth::user()->selehistories()->get();
        return view("admin.sales.index", compact("sales", "histories"));
        // return view("admin.dash");       
    }

    public function showSales() {
        $sales=Auth::user()->selehistories()->paginate(10);
        $histories=Auth::user()->selehistories()->get();
        return view("admin.sales.index", compact("sales", "histories"));       
    }


    public function showEdit(Category $category)
    {
        return view("admin.products.categories.edit-categories", compact("category"));
    }

    public function showOrderOxxo()
    {
        $orders=Auth::user()->ordersOxxo()->get();
        
        return view("admin.orderoxxo.index", compact("orders"));
    }
    
    public function showCategories()
    {
        $categories=Category::where("parent_id",0)->get();
        return view("admin.products.categories.index", compact("categories"));
    }

    public function showUsers()
    {
        $users=User::all();
        return view("admin.users.index", compact("users"));
    }

    public function printPdf(Request $request)
    { 
        
        $items=explode( ", ", $request->get("histories") );
        $itemsOrden=$request->get('histories');
        $seleHistories=SeleHistory::whereIn('id',$items)->orderByRaw(\DB::raw("FIELD(id,$itemsOrden)"))->get();
        $pdf = PDF::loadView('seller.partials.print-pdf',compact('seleHistories'));
        return $pdf->stream('Ventas.pdf');
    }

    public function printExcel(Request $request)
    { 
        $export=new SellerExport($request->get("histories"));
        return Excel::download( $export, 'Ventas.xlsx');
    }

    public function accreditedPay(Request $request, AppMailers $mailer)
    {
        $order=OrderOxxo::find($request->get("order"));
        $sale=$order->sale;
        $enviaYa=new EnviaYa;
        $client=$sale->client;
        $envio=$enviaYa->makeShipment($sale->shipment_method,$sale->shipment_rate_id,$client);
        $sale->updateStatusShip($envio->shipment_status);
        $sale->updateTracking($envio->carrier_shipment_number);
        $sale->updatePay();

        //Admin
        $userAdmin=User::find(6);
        //Enviar correos
        $mailer->sendReceiptClientAdmin($userAdmin,$client,$envio->carrier_shipment_number, $envio->carrie_url, $envio->rate->carrier_logo_url, $sale);
        foreach($sale->customerHistories()->get() as $item)
        {
            $productseller=ProductSeller::find( $item->product_id);
            if($productseller != null)
            {
                $saleHistory=new SeleHistory;
                $saleHistory->insert_pCustomer($item,$productseller->id,$client->customer->nombre);
            }
            else
            {
                $admins=User::where("admin",1)->get();
                foreach($admins as $admin)
                {   
                    $saleHistory=new SeleHistory;
                    $saleHistory->insert_pCustomer($item,$admin->id,$client->customer->nombre);
                }
            }
        }
        $order->delete();
        return back()->with("success", "Pago acreditado a ".$client->customer->nombre);
    }

    public function deleteOrder(Request $request)
    {
        $order=OrderOxxo::find($request->get("order_id"));
        $sale=$order->sale;
        $name=$sale->client->customer->nombre;
        $sale->customerHistories()->delete();
        $sale->delete();
        $order->delete();
        return response(["msg"=>"La orden con el nombre ".$name." ha sido eliminada", "num_orders"=>Auth::user()->ordersOxxo()->count()],200);
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
    public function deleteUser(Request $request)
    {
        
    }

    public function orderDate(Request $request)
    { 
        $sales;
        $histories;
        if($request->get("dia")==null && $request->get("mes")==null && $request->get("año")!=null)
        {
            $años=$request->get("año");
            $sales=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(10);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->get();
            
        }
        else if($request->get("dia")==null && $request->get("mes")!=null && $request->get("año")==null)
        {
            $meses=$request->get("mes");
            $sales=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->paginate(10); 
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->get();   
        }
        else if($request->get("dia")!=null && $request->get("mes")==null && $request->get("año")==null)
        {
            $dias=$request->get("dia");
            $sales=Auth::user()->selehistories()->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(10);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('DAY(date)'), $dias)->get();
           
        }
        else if($request->get("dia")==null && $request->get("mes")!=null && $request->get("año")!=null)
        {
            $meses=$request->get("mes");
            $años=$request->get("año");
            $sales=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(10);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('YEAR(date)'), $años)->get();
            
        }
        else if($request->get("dia")!=null && $request->get("mes")==null && $request->get("año")!=null)
        {
            $años=$request->get("año");
            $dias=$request->get("dia");
            $sales=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(10);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->whereIn(\DB::raw('DAY(date)'), $dias)->get();
            
        }
        else if($request->get("dia")!=null && $request->get("mes")!=null && $request->get("año")==null)
        {
            $meses=$request->get("mes");
            $dias=$request->get("dia");
            $sales=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(10);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->get();
            
        }
        else if($request->get("dia")!=null && $request->get("mes")!=null && $request->get("año")!=null)
        {
            $meses=$request->get("mes");
            $dias=$request->get("dia");
            $años=$request->get("año");
            $sales=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(10);
            $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->whereIn(\DB::raw('YEAR(date)'), $años)->get();
            
        }
        else
        {
            $sales=Auth::user()->selehistories()->paginate(10);
            $histories=Auth::user()->selehistories()->get();
        }
        return view('admin.sales.index',compact('sales','histories'));
    }
    public function orderSales($order)
    {   
       
        $sales="";
        $histories="";
        if($order==1)
        {
            $sales=Auth::user()->selehistories()->orderBy('amount',"desc")->paginate(10);
            $histories=Auth::user()->selehistories()->orderBy('amount',"desc")->get();
        }
        else if($order==2)
        {
            $sales=Auth::user()->selehistories()->orderBy('date',"desc")->paginate(10);
            $histories=Auth::user()->selehistories()->orderBy('date',"desc")->get();
        }
        else if($order==3)
        {
            $sales=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.price', 'desc')->paginate(10);
            $histories=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.price', 'desc')->get();
            
        }
        else if($order==4)
        {
            $sales=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.product_name', 'asc')->paginate(10);
            $histories=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.product_name', 'asc')->get();
        }
        else if($order==10)
        {
            $sales=Auth::user()->selehistories()->orderBy('client')->paginate(10);
            $histories=Auth::user()->selehistories()->orderBy('client')->get();
        }
        else if($order==6)
        {
            $sales=Auth::user()->selehistories()->orderBy('total','desc')->paginate(10);
            $histories=Auth::user()->selehistories()->orderBy('total','desc')->get();
        }
        else if($order==7)
        {
            $sales=Auth::user()->selehistories()->paginate(10);
            $histories=Auth::user()->selehistories()->get();
        }
        else
        {
            $sales=Auth::user()->selehistories()->paginate(10);
            $histories=Auth::user()->selehistories()->get();
        }
       
        return view('admin.sales.index',compact('sales','histories'));
    }

  

    

}