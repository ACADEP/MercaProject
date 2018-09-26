<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Address;

class AddressController extends Controller
{
    public function address() {
        $useraddresses = Auth::user()->address()->get();
        return view('customer.pages.address',compact('useraddresses'));
    }

    public function Update(Address $id)
    {
        $address = $id;
        // $address = Auth::user()->address()->find($id);
        return view('customer.partials.update-address',compact('address'));
    }

    public function showUpdate()
    {
        return view('customer.partials.update-address');
    }

    public function addAddress(Request $request) {
        $address = new Address;
        $address->usuario = Auth::user()->id;
        $address->calle = $request->mainstreet;
        $address->ciudad = $request->city;
        $address->estado = $request->state;
        $address->colonia = $request->colony;
        $address->cp = $request->postalcode;
        $address->calle2 = $request->streetsecond;
        $address->calle3 = $request->streetthird;
        $address->numInterior = $request->numinterior;
        $address->numExterior = $request->numexterior;
        $address->referencias = $request->references;
        if(Auth::user()->address()->count() == 0) {
            $address->activo = 1;
        } 
        $address->save();

        return back()->with("msg",$address->id);

    }

    public function updateAddress(Request $request)
    {
        $address = Auth::user()->address()->find($request->product_id);
        // dd($address);
        if($address!=null)
        {
            $address = Address::find($address->id);
            $address->calle = $request->mainstreet;
            $address->ciudad = $request->city;
            $address->estado = $request->state;
            $address->colonia = $request->colony;
            $address->cp = $request->postalcode;
            $address->calle2 = $request->streetsecond;
            $address->calle3 = $request->streetthird;
            $address->numInterior = $request->numinterior;
            $address->numExterior = $request->numexterior;
            $address->referencias = $request->references;
            $address->update();
        }
        return redirect()->back()->with("msg","Dirección actualizada!!");
    }

    public function deleteAddress(Request $request)
    {
        $addresses=Auth::user()->address;
        $address = null;
        foreach($addresses as $address)
        {
            if($address->id == $request->id)
            {
                Address::where('id',$address->id)->delete();
            }
        }
        
    }

    public function activeAddress(Request $request){
        $useraddresses = Auth::user()->address()->get();
        // dd($useraddresses);
        foreach($useraddresses as $address){
            $address->activo = 0;
            $address->update();
        }
        $address = Auth::user()->address()->find($request->radioactivo);
        $address->activo = 1;
        $address->update();
    }


}
