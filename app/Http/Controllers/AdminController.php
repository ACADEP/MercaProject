<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use App\Order;
use App\Product;
use App\Category;
use App\Sale;
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
use Illuminate\validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SellerExport;
use App\Mailers\AppMailers;

class AdminController extends Controller {

    
    public function index() {
        $sales=Auth::user()->selehistories()->paginate(10);
        $histories=Auth::user()->selehistories()->get();
        $ventas = Auth::user()->sale()->paginate(10);
        return view("admin.sales.index", compact("sales", "histories", "ventas"));
        // return view("admin.dash");       
    }

    public function showSales() {
        $sales = Auth::user()->selehistories()->paginate(10);
        $ventas = Auth::user()->sale()->paginate(10);
        $histories = Auth::user()->selehistories()->get();
        // dd($ventas);
        foreach ($ventas as $sale) {
            // dd($sale->sellerHistories()->get());
        }
        return view("admin.sales.index", compact("sales", "ventas", "histories"));       
    }

    public function showPermissions()
    {
        $permissions=Permission::all();
        return view('admin.users.permissions', compact('permissions'));
    }
    public function showEditPermissions(Permission $permission)
    {
        return view('admin.users.edit-permission', compact('permission'));
    }

    public function showEdit(Category $category)
    {
        return view("admin.products.categories.edit-categories", compact("category"));
    }

    public function showEditRoles(Role $role)
    {
        $permissions=Permission::all();
        return view('admin.users.edit-roles', compact('role', 'permissions'));
    }

    public function showOrderOxxo()
    {
        $orders=OrderOxxo::all();
        return view("admin.orderoxxo.index", compact("orders"));
    }
    
    public function showCategories()
    {
        $categories=Category::where("parent_id",0)->get();
        return view("admin.products.categories.index", compact("categories"));
    }
    public function showRolesAPermissions()
    {
        // $roles=Role::all();
        $roles=Role::with('permissions')->get();
        $permissions=Permission::all();
        return view("admin.users.roles-permissions", compact("roles","permissions"));
    }

    public function addRole(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles',
            'display_name'=>'required'
        ]);

        $role=new Role;
        $role->name=$request->get('name');
        $role->display_name=$request->get('display_name');
        $role->guard_name='web';
        $role->save();

        if($request->has('permissions'))
        {
            $role->givePermissionTo($request->get('permissions'));
        }
        return back()->withFlash('El role ha sido creado');
    }
    public function updateRole(Request $request)
    {
        $request->validate([
            'display_name'=>'required'
        ]);

        $role=Role::find($request->get('role')); 
        $role->display_name=$request->get('display_name');
        $role->guard_name='web';
        $role->save();

        $role->permissions()->detach();
        if($request->has('permissions'))
        {
            $role->givePermissionTo($request->get('permissions'));
        }
        return back()->withFlash('El rol ha sido actualizado');

    }

    public function deleteRole(Request $request)
    {
        $role=Role::find($request->get("role_id"));
        $cUserRol=User::role($role->name)->count();
        $respose;
        if($role->id==1 || $role->id==2)
        {
            $respose=["msg_type"=>0,"msg"=>"Este rol no puede ser eliminado"];
        }
        else if($cUserRol>0)
        {
            $respose=["msg_type"=>0,"msg"=>"Este rol no puede ser eliminado porque esta ligado a ".$cUserRol." usuario(s)"];
        }
        else
        {
            $role_name=$role->name;
            $role->delete();
            $respose=["msg_type"=>1,"msg"=>"El rol ".$role_name." ha sido eliminado"];
        }
       
        return response($respose,200);
    }
    public function showUsers()
    {
        $users=User::all();
        $roles=Role::with('permissions')->get();
        // $roles=Role::pluck('name','id');
        $permissions=Permission::all();
        return view("admin.users.index", compact("users","roles","permissions"));
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
                $saleHistory->insert_pCustomer($item,$productseller->id,$client->customer->nombre,$sale->id);
            }
            else
            {
                $admins=User::where("admin",1)->get();
                foreach($admins as $admin)
                {   
                    $saleHistory=new SeleHistory;
                    $saleHistory->insert_pCustomer($item,$admin->id,$client->customer->nombre,$sale->id);
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
        $user=User::find($request->get("user_id"));
        $user_name=$user->username;
        $user->delete();
        return response("El usuario ".$user_name." ha sido eliminado",200);
    }

    public function showUpdateUser(User $user)
    {
        $roles=Role::with('permissions')->get();
        // $roles=Role::pluck('name','id');
        $permissions=Permission::all();
        return view("admin.users.edit", compact('user', 'roles','permissions'));
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'username' => 'required|max:20|min:3|alpha_dash|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6|max:16',
            'roles'=>'required',
        ],
        [
            'roles.required'=>'Debe de asignarle un rol a este usuario'
        ]);
        
        $newUser=new User;
        $newUser->insert($request->get('username'), $request->get('email'), $request->get('password'));
        $newUser->assignRole($request->get('roles'));
        $newUser->givePermissionTo($request->get('permissions'));
        return back()->withFlash('El usuario ha sido creado');
        
    }
    public function updatePermission(Request $request)
    {
        $request->validate([
            'display_name'=>'required'
        ]);

       $permission=Permission::find($request->get('permission')); 
       $permission->display_name=$request->get('display_name');
       $permission->save();

        
        return back()->withFlash('El permiso ha sido actualizado');

    }

    public function updateUser(Request $request)
    {
        $rules=[
            'username'=>'required',
            'email'=>['required', Rule::unique('users')->ignore($request->get('user'))]
        ];
        if($request->filled('password'))
        {
            $rules["password"]= ['confirmed'];
        }
        $request->validate($rules);
        $user=User::find($request->get('user'));
        $user->updateU($request->get('username'), $request->get('email'), $request->get('password'));
        return back()->withFlash('El usuario ha sido actualizado');
    }

    public function updateRoleUser(Request $request, User $user)
    {
       $user->syncRoles($request->get("roles"));
       return back()->withFlash('Los roles han sido actualizados');
    }

    public function updatePermissionUser(Request $request, User $user)
    {
        $user->permissions()->detach();
        if($request->filled('permissions'))
        {
            $user->givePermissionTo($request->get('permissions'));
        }
        return back()->withFlash('Los permisos han sido actualizados');
    }

    public function orderDate(Request $request)
    { 
        $sales;
        $histories;
        $ventas = null;
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
        return view('admin.sales.index',compact('sales','histories','ventas'));
    }
    public function orderSales($order)
    {   
       
        $sales="";
        $histories="";
        $ventas = null;
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
       
        return view('admin.sales.index',compact('sales','histories','ventas'));
    }

    
    public function showInvoice() {
        return view('admin.invoice.invoice');
    }

    public function storeInvoice(Request $request) {
        $file = request()->file('file');
        $urlFac = $file->store('facturas');       
        $url = "/images/".$urlFac;
        $sale = Sale::find($request->get("factura"));
        // dd($sale->url_fact);
        if ($url != $sale->url_fact) {
            if ($sale->url_fact == '#') {
            }
            $sale->url_fact = $url;
            $sale->update();
            return response(['FacUrl'=>$sale->url_fact,"url"=>$url],200);
        } else {
            $sale->url_fact = $url;
            $sale->update();
            return response(['FacUrl'=>$sale->url_fact,"url"=>$url],200);
        }
    }

    public function deleteInvoice($sale_id) {
        // Find the photo and delete it.
        $productPhoto=ProductPhoto::find($sale_id);
        if(File::delete(public_path($productPhoto->path)))
        {
            $productPhoto->delete();
        }
        
        // Then return back;
        return back();        
    }

    

}