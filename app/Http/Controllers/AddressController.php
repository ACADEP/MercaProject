<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Address;
use App\Sepomex;
use App\Http\Requests\ValidacionAddress;
use Aftab\Sepomex\Contracts\SepomexContract;

class AddressController extends Controller
{
    public function address() {
        $useraddresses = Auth::user()->address()->get();
        // dd(\Sepomex::getStates());
        $previousURL = url()->previous();
        return view('customer.pages.address',compact('useraddresses', 'previousURL'));
    }

    public function Update(Address $id)
    {
        $address = $id;
        $previousURL = url()->previous();
        // $address = Auth::user()->address()->find($id);
        return view('customer.partials.update-address',compact('address', 'previousURL'));
    }

    public function showUpdate()
    {
        return view('customer.partials.update-address');
    }

    public function addAddress(ValidacionAddress $request) {
        if (Sepomex::where("d_codigo",$request->postalcode)->count()) {
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
           
            return redirect()->back()->with("msg","Dirección actualizada!!");
        } else {
            
            return back()->with('flash','Código postal no valido.');
        }    


    }

    public function updateAddress(ValidacionAddress $request)
    {
        // dd($request);
        $address = Auth::user()->address()->find($request->product_id);
        if($address!=null)
        {
            if (\Sepomex::getByPostal($request->postalcode)) {
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
                return redirect()->back()->with("msg","Dirección actualizada!!");
            } else {
                return back()->with('flash','Código postal no valido.');
            }    

        }
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
        foreach($useraddresses as $address){
            $address->activo = 0;
            $address->update();
        }
        $address = Auth::user()->address()->find($request->radioactivo);
        $address->activo = 1;
        $address->update();
    }

    public function updateAddressActive(Request $request)
    {
       $addressActive= Auth::user()->updateAddressActive($request->address_id);
       return response($addressActive,200);
       
    }


}
