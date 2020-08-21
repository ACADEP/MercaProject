<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;

use App\Product;
use App\Category;
use App\Customer;
use App\Sale;
use App\ProductSeller;
use App\SeleHistory;
use App\Order;
use App\EnviaYa;
use File;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SellerExport;
use App\Mailers\AppMailers;

 

class AdminController extends Controller {

    
    public function index() 
    {

        $seller = Auth::user()->selehistories();
        
        $sales = SeleHistory::select('*')->paginate(config('configurations.paginate_general'));
        $histories = SeleHistory::select('*')->get();
        $ventas = SeleHistory::select('sale_id', "created_at")->distinct('sale_id')->orderBy('created_at', "desc")->paginate(config('configurations.paginate_general'), ['sale_id']);
        
        return view("admin.sales.index", compact("sales", "histories", "ventas"));   
    }

    public function showSales() 
    {
        $seller = Auth::user()->selehistories();
        $sales = Auth::user()->selehistories()->paginate(config('configurations.paginate_general'));
        $histories = Auth::user()->selehistories()->get();
        $ventas = $seller->select('sale_id', "created_at")->distinct()->orderBy('created_at', "desc")->paginate(config('configurations.paginate_general'));
        return view("admin.sales.index", compact("sales", "ventas", "histories"));       
    }

    public function showSalesAll(Request $request)
    {
        $orderAll=$request->get('s-show-sales');
        if($request->get('s-show-sales')==1)
        {
            $seller = Auth::user()->selehistories();
            $sales = Auth::user()->selehistories()->paginate(config('configurations.paginate_general'));
            $histories = Auth::user()->selehistories()->get();
            $ventas = $seller->select('sale_id', "created_at")->distinct()->orderBy('created_at', "desc")->paginate(config('configurations.paginate_general'));
            return view("admin.sales.index", compact("sales", "ventas", "histories", 'orderAll'));       
        }
        else if($request->get('s-show-sales')==2)
        {
            if(Auth::user()->can('view_all_sales'))
            {
                $sales = SeleHistory::select('*')->paginate(config('configurations.paginate_general'));
                $histories = SeleHistory::select('*')->get();
                $ventas = SeleHistory::select('sale_id', "created_at")->distinct('sale_id')->orderBy('created_at', "desc")->paginate(config('configurations.paginate_general'), ['sale_id']);
                return view("admin.sales.index", compact("sales", "ventas", "histories", 'orderAll'));
            }
            else
            {
                return back()->with('no-permission','No tienes permiso para esta acción');
            }       
        }
      
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

    public function showOrder()
    {
        $orders=Order::all();
        return view("admin.orders.index", compact("orders"));
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
        $pdf = PDF::loadView('admin.sales.print-pdf',compact('seleHistories'));
        return $pdf->stream('Ventas.pdf');
    }

    public function printExcel(Request $request)
    { 
        $export=new SellerExport($request->get("histories"));
        return Excel::download( $export, 'Ventas.xlsx');
    }

    public function accreditedPay(Request $request, AppMailers $mailer)
    {
        $order=Order::find($request->get("order"));
        if($order->receipt_url !=null){
            $sale=$order->sale;
            // $enviaYa=new EnviaYa;
            $client=$sale->client;
            // $envio=$enviaYa->makeShipment($sale->shipment_method,$sale->shipment_rate_id,$client);
            // $sale->updateStatusShip($envio->shipment_status);
            // $sale->updateTracking($envio->carrier_shipment_number);
            $sale->updatePay();

            //Admin
            $userAdmin=User::role('Admin')->first();
            
            //Enviar correos
            // $mailer->sendReceiptClientAdmin($userAdmin,$client,$envio->carrier_shipment_number, $envio->carrie_url, $envio->rate->carrier_logo_url, $sale);
            foreach($sale->customerHistories()->get() as $item)
            {
                $productseller=ProductSeller::find($item->product_id);
                if($productseller != null)
                {
                    $saleHistory=new SeleHistory;
                    $saleHistory->insert_pCustomer($item,$productseller->id,$client->username,$sale->id);
                }
                else
                {
                    $admin = User::role('Admin')->first();
                    $saleHistory=new SeleHistory;
                    $saleHistory->insert_pCustomer($item,$admin->id,$client->username,$sale->id);
                    
                }
            }
            $order->delete();
            return back()->with("success", "Pago acreditado a ".$client->username." la orden se paso a ventas");
        }
        else
        {
            return back()->with("fail", "Debe ingresar el comprobante correspondiente para esta orden");
        }
    }

    public function deleteOrder(Request $request)
    {
       
        $order=Order::find($request->get("order_id"));
        $sale=$order->sale;
        $name=$sale->client->username;
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
        return redirect()->route('show-edit-category',[$category])->with("success",'La categoría ha sido actualizada');
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
        $newUser->insert($request->get('username'), $request->get('email'), $request->get('password'), Auth::user()->company_id);
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
        if($request->typeSales==null || $request->typeSales == 1 || $request->typeSales != 2)
        {
            if($request->get("dia")==null && $request->get("mes")==null && $request->get("año")!=null)
            {
                $años=$request->get("año");
                $sales=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(config('configurations.paginate_general'));
                $histories=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->get();
                
            }
            else if($request->get("dia")==null && $request->get("mes")!=null && $request->get("año")==null)
            {
                $meses=$request->get("mes");
                $sales=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->paginate(config('configurations.paginate_general')); 
                $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->get();   
            }
            else if($request->get("dia")!=null && $request->get("mes")==null && $request->get("año")==null)
            {
                $dias=$request->get("dia");
                $sales=Auth::user()->selehistories()->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(config('configurations.paginate_general'));
                $histories=Auth::user()->selehistories()->whereIn(\DB::raw('DAY(date)'), $dias)->get();
            
            }
            else if($request->get("dia")==null && $request->get("mes")!=null && $request->get("año")!=null)
            {
                $meses=$request->get("mes");
                $años=$request->get("año");
                $sales=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(config('configurations.paginate_general'));
                $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('YEAR(date)'), $años)->get();
                
            }
            else if($request->get("dia")!=null && $request->get("mes")==null && $request->get("año")!=null)
            {
                $años=$request->get("año");
                $dias=$request->get("dia");
                $sales=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(config('configurations.paginate_general'));
                $histories=Auth::user()->selehistories()->whereIn(\DB::raw('YEAR(date)'), $años)->whereIn(\DB::raw('DAY(date)'), $dias)->get();
                
            }
            else if($request->get("dia")!=null && $request->get("mes")!=null && $request->get("año")==null)
            {
                $meses=$request->get("mes");
                $dias=$request->get("dia");
                $sales=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(config('configurations.paginate_general'));
                $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->get();
                
            }
            else if($request->get("dia")!=null && $request->get("mes")!=null && $request->get("año")!=null)
            {
                $meses=$request->get("mes");
                $dias=$request->get("dia");
                $años=$request->get("año");
                $sales=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(config('configurations.paginate_general'));
                $histories=Auth::user()->selehistories()->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->whereIn(\DB::raw('YEAR(date)'), $años)->get();
                
            }
            else
            {
                $sales=Auth::user()->selehistories()->paginate(config('configurations.paginate_general'));
                $histories=Auth::user()->selehistories()->get();
            }
            return view('admin.sales.index',compact('sales','histories','ventas'));
        }
        else if($request->typeSales==2)
        {
            if(Auth::user()->can('view_all_sales'))
            {
                if($request->get("dia")==null && $request->get("mes")==null && $request->get("año")!=null)
                {
                    $años=$request->get("año");
                    $sales=SeleHistory::select('*')->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(config('configurations.paginate_general'));
                    $histories=SeleHistory::select('*')->whereIn(\DB::raw('YEAR(date)'), $años)->get();
                    
                }
                else if($request->get("dia")==null && $request->get("mes")!=null && $request->get("año")==null)
                {
                    $meses=$request->get("mes");
                    $sales=SeleHistory::select('*')->whereIn(\DB::raw('MONTH(date)'), $meses)->paginate(config('configurations.paginate_general')); 
                    $histories=SeleHistory::select('*')->whereIn(\DB::raw('MONTH(date)'), $meses)->get();   
                }
                else if($request->get("dia")!=null && $request->get("mes")==null && $request->get("año")==null)
                {
                    $dias=$request->get("dia");
                    $sales=SeleHistory::select('*')->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(config('configurations.paginate_general'));
                    $histories=SeleHistory::select('*')->whereIn(\DB::raw('DAY(date)'), $dias)->get();
                
                }
                else if($request->get("dia")==null && $request->get("mes")!=null && $request->get("año")!=null)
                {
                    $meses=$request->get("mes");
                    $años=$request->get("año");
                    $sales=SeleHistory::select('*')->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(config('configurations.paginate_general'));
                    $histories=SeleHistory::select('*')->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('YEAR(date)'), $años)->get();
                    
                }
                else if($request->get("dia")!=null && $request->get("mes")==null && $request->get("año")!=null)
                {
                    $años=$request->get("año");
                    $dias=$request->get("dia");
                    $sales=SeleHistory::select('*')->whereIn(\DB::raw('YEAR(date)'), $años)->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(config('configurations.paginate_general'));
                    $histories=SeleHistory::select('*')->whereIn(\DB::raw('YEAR(date)'), $años)->whereIn(\DB::raw('DAY(date)'), $dias)->get();
                    
                }
                else if($request->get("dia")!=null && $request->get("mes")!=null && $request->get("año")==null)
                {
                    $meses=$request->get("mes");
                    $dias=$request->get("dia");
                    $sales=SeleHistory::select('*')->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->paginate(config('configurations.paginate_general'));
                    $histories=SeleHistory::select('*')->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->get();
                    
                }
                else if($request->get("dia")!=null && $request->get("mes")!=null && $request->get("año")!=null)
                {
                    $meses=$request->get("mes");
                    $dias=$request->get("dia");
                    $años=$request->get("año");
                    $sales=SeleHistory::select('*')->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->whereIn(\DB::raw('YEAR(date)'), $años)->paginate(config('configurations.paginate_general'));
                    $histories=SeleHistory::select('*')->whereIn(\DB::raw('MONTH(date)'), $meses)->whereIn(\DB::raw('DAY(date)'), $dias)->whereIn(\DB::raw('YEAR(date)'), $años)->get();
                    
                }
                else
                {
                    $sales=SeleHistory::select('*')->paginate(config('configurations.paginate_general'));
                    $histories=SeleHistory::select('*')->get();
                }
                $orderAll=$request->typeSales;
                return view('admin.sales.index',compact('sales','histories','ventas', 'orderAll'));
            }
            else
            {
                return back()->with('no-permission','No tienes permiso para esta acción');
            } 
        }
    }
    public function orderAllSales($order)
    {
       
        if(Auth::user()->can('view_all_sales'))
        {
            $sales="";
            $histories="";
            $ventas = null;
            $orderAll=2;
            if($order==1)
            {
                $sales=SeleHistory::select('*')->orderBy('amount',"desc")->paginate(config('configurations.paginate_general'));
                $histories=SeleHistory::select('*')->orderBy('amount',"desc")->get();
            }
            else if($order==2)
            {
                $sales=SeleHistory::select('*')->orderBy('date',"desc")->paginate(config('configurations.paginate_general'));
                $histories=SeleHistory::select('*')->orderBy('date',"desc")->get();
            }
            else if($order==3)
            {
                $sales=SeleHistory::select('*')->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.price', 'desc')->paginate(config('configurations.paginate_general'));
                $histories=SeleHistory::select('*')->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.price', 'desc')->get();
                
            }
            else if($order==4)
            {
                $sales=SeleHistory::select('*')->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.product_name', 'asc')->paginate(config('configurations.paginate_general'));
                $histories=SeleHistory::select('*')->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.product_name', 'asc')->get();
            }
            else if($order==5)
            {
                $sales=SeleHistory::select('*')->orderBy('client')->paginate(config('configurations.paginate_general'));
                $histories=SeleHistory::select('*')->orderBy('client')->get();
            }
            else if($order==6)
            {
                $sales=SeleHistory::select('*')->orderByDesc('total')->paginate(config('configurations.paginate_general'));
                $histories=SeleHistory::select('*')->orderBy('total','desc')->get();
            
            }
            else if($order==7)
            {
                $sales=SeleHistory::select('*')->paginate(config('configurations.paginate_general'));
                $histories=SeleHistory::select('*')->get();
            
            }
            else
            {
                $sales=SeleHistory::select('*')->paginate(config('configurations.paginate_general'));
                $histories=SeleHistory::select('*')->get();
            }
            
            return view('admin.sales.index',compact('sales','histories','ventas','orderAll'));
        }
        else
        {
            return back()->with('no-permission','No tienes permiso para esta acción');
        }
    }
    public function orderSales($order)
    {   
       
        $sales="";
        $histories="";
        $ventas = null;
        if($order==1)
        {
            $sales=Auth::user()->selehistories()->orderBy('amount',"desc")->paginate(config('configurations.paginate_general'));
            $histories=Auth::user()->selehistories()->orderBy('amount',"desc")->get();
        }
        else if($order==2)
        {
            $sales=Auth::user()->selehistories()->orderBy('date',"desc")->paginate(config('configurations.paginate_general'));
            $histories=Auth::user()->selehistories()->orderBy('date',"desc")->get();
        }
        else if($order==3)
        {
            $sales=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.price', 'desc')->paginate(config('configurations.paginate_general'));
            $histories=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.price', 'desc')->get();
            
        }
        else if($order==4)
        {
            $sales=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.product_name', 'asc')->paginate(config('configurations.paginate_general'));
            $histories=Auth::user()->selehistories()->select('sele_histories.*')->join('products', 'sele_histories.product_id', '=', 'products.id')->orderBy('products.product_name', 'asc')->get();
        }
        else if($order=5)
        {
            $sales=Auth::user()->selehistories()->orderBy('client')->paginate(config('configurations.paginate_general'));
            $histories=Auth::user()->selehistories()->orderBy('client')->get();
        }
        else if($order==6)
        {
            $sales=Auth::user()->selehistories()->orderBy('total','desc')->paginate(config('configurations.paginate_general'));
            $histories=Auth::user()->selehistories()->orderBy('total','desc')->get();
        }
        else if($order==7)
        {
            $sales=Auth::user()->selehistories()->paginate(config('configurations.paginate_general'));
            $histories=Auth::user()->selehistories()->get();
        }
        else
        {
            $sales=Auth::user()->selehistories()->paginate(config('configurations.paginate_general'));
            $histories=Auth::user()->selehistories()->get();
        }
       
        return view('admin.sales.index',compact('sales','histories','ventas'));
    }
    public function searchOrder(Request $request)
    {
        $search_find=$request->search;
        $orders=null;
        if($search_find!=null)
        {
            $query=Order::select("*");                                  
            $query = $query->orWhere("market_id", 'LIKE', "%$search_find%");
            $orders = $query->get();
        }
        else
        {
            $orders=Order::all();
        }
        
        return view("admin.orders.index", compact("orders"));
    }

    
    public function showInvoice() {
        return view('admin.invoice.invoice');
    }

    public function storeInvoice(Request $request) {
        $file = request()->file('file');
        $urlFac = $file->store('Facturas');       
        $sale = Sale::find($request->get("factura"));
        // dd($sale->url_fact);
        if (public_path($urlFac) != $sale->url_fact) {
            if ($sale->url_fact == '#') {
                $sale->url_fact =$urlFac;
                $sale->update();
                return response(200);    
            } else {
                if(File::delete(public_path($sale->url_fact)))
                {
                    $sale->url_fact =$urlFac;
                    $sale->update();
                    return response(200);        
                }        
            }
        } else {
            $sale->url_fact = $urlFac;
            $sale->update();
            return response(200);
        }
    }

    public function deleteInvoice(Request $request) {
        // Find the invoice and delete it.
        $sale = Sale::find($request->sale_id);
        if(File::delete(public_path($sale->url_fact)))
        {
            $sale->url_fact = '#';
            $sale->update();
        } else {

        }
        return back();        
    }

    public function salesPayPDF($id)
    {
        
       $sale=Sale::find($id);
       $items=SeleHistory::where('sale_id',$sale->id)->get();
        $pdf = PDF::loadView('admin.sales.print-pdf-sale',compact('items','sale'));
        return $pdf->stream('Recibo de pago'.$sale->date.'.pdf');
    }

    public function showReclames()
    {
        $sales=Sale::where('status_reclamo','En espera')->with("client")->get();
        return view('admin.reclames.index', compact("sales"));
    }

    public function respondReclame(Request $request)
    {
        $sale=Sale::where("id",$request->sale)->first();
        if($sale!=null)
        {
            $sale->respond_reclame=$request->reclame_text;
            $sale->status_reclamo=$request->reclame_state;
            $sale->update();
            
        }
        return back();
    }

    public function storeReceipt(Request $request)
     {
        $file = $request->file('file');
        $urlRec = $file->store('Comprobantes');    
        $order = Order::find($request->get("receipt"));
        if ($order->receipt_url == null) 
        {
            $order->receipt_url = "/".$urlRec;
            $order->update();
            return response(['El comprobante fue subido con exito'],200);    
        } 
        else 
        {
            File::delete(public_path($order->receipt_url));
            $order->receipt_url = "/".$urlRec;
            $order->update();
            return response(['El comprobante fue remplazado con exito'],200);            
        }
    }

    //Clientes
    public function showclients()
    {
        $clients=Customer::all();

        return view("admin.clients.index", compact("clients"));
    }

    public function showclientupdate($id)
    {
        $customer=Customer::findOrFail($id);
        return view("admin.clients.update", compact("customer"));
    }

    public function showclientcreate()
    {
        $customer=new Customer;
        return view("admin.clients.create", compact("customer"));
    }

    public function clientcreate(Request $request)
    {
        $request->validate(
            ["email"=>"unique:customers"],
            ["email.unique" => "Correo registrado, Intente con uno nuevo"]
        );
        
        $customer = new Customer;
        // $customer->usuario = Auth::user()->id;
        $customer->nombre = $request->firstname;
        $customer->apellidos = $request->secondname;
        $customer->telefono = $request->phone;
        $customer->email = $request->email;
        $customer->razonSocial = $request->socialname;
        $customer->tipoFacturacion = $request->facturacion;
        $customer->rfc = $request->rfc;
        $customer->calle = $request->mainstreet;
        $customer->numInterior = $request->interior;
        $customer->numExterior = $request->exterior;
        $customer->cp = $request->cp;
        $customer->estado = $request->state;
        $customer->ciudad = $request->city;
        $customer->colonia = $request->colony;
        $customer->cfdi = $request->cfdi;
        $customer->save();

        return redirect("/admin/clients/index")->with("success", "El cliente ".$customer->nombre." ha sido editado");
    }

    public function clientupdate(Request $request, $id)
    {
        $request->validate(
            [
                "email"=> Rule::unique('customers')->ignore($id)
            ],
            [ "email.unique" => "Correo registrado, Intente con uno nuevo", ]
        );

        $customer = Customer::findOrFail($id);
        // $customer->usuario = Auth::user()->id;
        $customer->nombre = $request->firstname;
        $customer->apellidos = $request->secondname;
        $customer->telefono = $request->phone;
        $customer->email = $request->email;
        $customer->razonSocial = $request->socialname;
        $customer->tipoFacturacion = $request->facturacion;
        $customer->rfc = $request->rfc;
        $customer->calle = $request->mainstreet;
        $customer->numInterior = $request->interior;
        $customer->numExterior = $request->exterior;
        $customer->cp = $request->cp;
        $customer->estado = $request->state;
        $customer->ciudad = $request->city;
        $customer->colonia = $request->colony;
        $customer->cfdi = $request->cfdi;
        $customer->update();

        return redirect("/admin/clients/index")->with("success", "Nuevo cliente ".$customer->nombre." ha sido creado");
    }

    public function clientdelete(Request $request)
    {
        $customer = Customer::findOrFail($request->id);

        $customer->delete();

        return response("Cliente eliminado con éxito", 200);


    }


    

}