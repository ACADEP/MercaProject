<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentInformation;
use App\Http\Requests\CardsRequest;

class PaymentInformationController extends Controller
{
    public function payments() {
        $usercards = Auth::user()->paymentscard()->get();
        //  dd($usercards);
        return view('customer.pages.payments',compact('usercards'));
    }

    public function addCard(Request $request) {
        // dd($request);
        $card = new PaymentInformation;
        $card->usuario = Auth::user()->id;
        $card->numtarjeta = $request->numcard;
        $card->titular = $request->name;
        $card->vigencia = $request->mes .'/'. $request->año;
        $card->cvc = $request->cvccode;
        $card->save();
        
        return back()->with("msg",$card->id);

    }

    public function deleteCard(Request $request)
    {
        $cards=Auth::user()->paymentscard;
        $card=null;
        foreach($cards as $card)
        {
            if($card->id == $request->id)
            {
                PaymentInformation::where('id',$card->id)->delete();
            }
        }
        
    }

}
