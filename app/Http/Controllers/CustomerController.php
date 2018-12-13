<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;
use App\User;
use App\Order;
use App\Product;
use App\Shop;
use App\Favorite;
use App\Sale;
use App\EnviaYa;
use App\Address;
use App\Customer;
use App\PaymentInformation;

use Barryvdh\DomPDF\Facade as PDF;


class CustomerController extends Controller
{
    use SearchTrait, CartTrait;

    /**
     * Display Profile contents
     *
     * @return mixed
     */
    public function index() {
        // From Traits/SearchTrait.php
        // ( Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        // Get the currently authenticated user
        $username = \Auth::user();

        // Set user_id to the currently authenticated user ID
        $user_id = $username->id;

        // Select all from "Orders" where the user_id = the ID og the signed in user to get all their Orders
        $orders = Order::where('user_id', '=', $user_id)->get();

        $sales=Auth::user()->sale()->orderBy("date","desc")->paginate(5);

        return view('customer.pages.customer_history', compact('search', 'cart_count', 'username', 'orders', 'sales'));
    }

    public function personal() {
        $userpersonal = Auth::user()->customer;
        // dd($userpersonal);
        return view('customer.pages.persanaldate', compact('userpersonal'));
    }

    public function favorites()
    {
        $favorites=Auth::user()->favorites()->paginate(5);
        return view('customer.pages.favorites', compact('favorites'));
    }

    public function addpersonal(Request $request) {
        $customer = new Customer;
        $customer->usuario = Auth::user()->id;
        $customer->nombre = $request->name;
        $customer->apellidos = $request->firstname.' '.$request->secondname;
        $customer->telefono = $request->phone;
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
        return back()->with("msg",$customer->id);
    }

    public function showUpdate(Customer $id) {
        $customer = $id;
        // dd($customer);
        return view('customer.partials.update-personaldate', compact('customer'));
    }

    public function personalUpdate(Request $request) {
        // dd($request);
        $customer = Auth::user()->customer()->find($request->customer_id);
        // dd($customer);
        if($customer!=null)
        {
            $customer = Customer::find($customer->id);
            $customer->nombre = $request->name;
            $customer->apellidos = $request->firstname.' '.$request->secondname;
            $customer->telefono = $request->phone;
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
        }
        return redirect()->back()->with("msg","Datos Personales actualizados!!");
    }

    public function profile() {
        $user = Auth::user();
        return view('customer.pages.profile', compact('user'));
    }

    public function profileUpdate(Request $request) {
        // dd($request);
        $user = Auth::user();
        $this->validate($request, [
            'username'    => 'required',
            'email' => 'required|email|unique:users'
        ]);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->update();
        return redirect()->back()->with("msg","Datos de Cuenta Cambiados");
    }

    public function profileUpdatePassword(Request $request) {
        $user = Auth::user();
        $this->validate($request, [
            'password_actual' => 'required',
            'password' => 'required',
            'password_confirmed' => 'required'
        ]);
        if (\Hash::check($request->password_actual, $user->password)) {
            if ($request->password == $request->password_confirmed) {
                $user->password = bcrypt($request->input('password'));
                $user->update();    
                return redirect()->back()->with("msg","Datos de Cuenta Cambiados");
            } else {
                return redirect()->back()->with("msg1","La nueva contraseña no coincide con repetir contraseña");
                //$hola = 'jonatan cesela arnquezs';
                                //$asdasddddd = 'jonatan cesela arnquezs';
                //$asdasd = 'jonatan cesela arnquezs';

            }
        } else {
            return redirect()->back()->with("msg1","La contraseña actual no coincide");
        }
    }

    public function tracking(Request $request)
    {   
        if($request->method()=="GET")
        {
            return redirect('/customer/profile');
        }
        else if($request->method()=="POST"){
            $sale=Sale::find($request->get('sale'));
            if($sale->shipment_tracking != null)
            {
                $enviaYa= new EnviaYa;
                $carrie = $sale->shipment_method;
                $track=json_encode($enviaYa->getTracking($carrie,$sale->shipment_tracking));
            
                return view('customer.partials.tracking', compact('track', 'carrie'));
            }
            else
            {
                return back()->with("flash","No existe número de guía");
            }
        }
        
    }

    public function getStatus(Request $request)
    {
        $sale=Sale::find($request->get('sale'));
        $enviaYa= new EnviaYa;
        if($sale->shipment_tracking!=null)
        {
            $track=$enviaYa->getTracking($sale->shipment_method,$sale->shipment_tracking);
            $sale->updateStatusShip($track->shipment_status);
            return response($track->shipment_status,200);
        }
        else
        {
            return response($sale->status_envio,200);
        }
        


    }

    public function PDF(Request $request)
    {
        $sale = Auth::user()->sale()->find($request->get('sale'));
        $pdf = PDF::loadView('customer.partials.recibe-download',compact('sale'));
        return $pdf->download('Recibo de pago.pdf');
    }
    
    public function addFavorite(Request $request)
    {
        $favorite_repeat=Auth::user()->valFavorite($request->get("product_id"));
       
        if($favorite_repeat)
        {
            $favorite= New Favorite;
            $favorite->insert($request->get("product_id"));
        }
        
        return response(["favorite_val"=>$favorite_repeat],200);
    }
    public function deleteFavorite(Request $request)
    {
        $favorite= Favorite::find($request->get("favorite"));
        $product_name=$favorite->product->product_name;
        $favorite->delete();
        return back()->with('success','El producto con nombre '.$product_name.' ha sido borrado de favoritos');
    }

    public function Invoice(Request $request) {
        
        $sale = Auth::user()->sale()->find($request->get('sale_id'));
       
        if($sale->url_fact==null || $sale->url_fact=="#")
        {
            return back()->with('fail', "No existe factura contacte a administración");
        }
        else
        {
            return response()->download(public_path($sale->url_fact));
        }
       
    }


}
