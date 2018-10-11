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
use App\Address;
use App\Customer;
use App\PaymentInformation;


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

        return view('customer.dash', compact('search', 'cart_count', 'username', 'orders'));
    }

    public function personal() {
        $userpersonal = Auth::user()->customer;
        // dd($userpersonal);
        return view('customer.pages.persanaldate', compact('userpersonal'));
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
        return view('customer.pages.profile');
    }

}
