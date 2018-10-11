<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentInformation;
use App\Http\Requests\CardsRequest;
use App\Customer;
use App\Address;
use App\User;

class PaymentInformationController extends Controller
{
    public function payments() {
        $openpay = \Openpay::getInstance('mk5lculzgzebbpxpam6x', 'sk_d90dcb48c665433399f3109688b76e24');
        $usercustomer = Customer::where("usuario",Auth::user()->id)->first();
        $usercards = Auth::user()->paymentscard()->get();
        $cardList = null;
        if ($usercustomer != null) {
            if ($usercustomer->idCustomerOpenpay != null) {
                $findDataRequest = array(
                    // 'creation[gte]' => '2020-01-01',
                    // 'creation[lte]' => '2013-12-31',
                    'offset' => 0,
                    'limit' => 10);
                
                $customer = $openpay->customers->get($usercustomer->idCustomerOpenpay);
                $cardList = $customer->cards->getList($findDataRequest);
    
                return view('customer.pages.payments',compact('cardList', 'usercards', 'usercustomer'));
            } 
            else {
                return view('customer.pages.payments',compact('cardList', 'usercards', 'usercustomer'));
            }    
        } else {
            return view('customer.pages.payments', compact('cardList', 'usercards', 'usercustomer'));
        }
    }

    public function paymentsShow() {
        $usercards = Auth::user()->paymentscard()->get();
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

    public function AddCardOpenpay() {
        try {
            $openpay = \Openpay::getInstance('mk5lculzgzebbpxpam6x', 'sk_d90dcb48c665433399f3109688b76e24');
            $usercustomer = Customer::where("usuario",Auth::user()->id)->first();
            $useraddresses = Address::where("usuario",Auth::user()->id)->first();

            if ($usercustomer->idCustomerOpenpay == null) {
                $customerData = array(
                    'external_id' => Auth::user()->id,
                    'name' => $usercustomer->nombre,
                    'last_name' => $usercustomer->apellidos,
                    'email' => Auth::user()->email,
                    'requires_account' => false,
                    'phone_number' => $usercustomer->telefono,
                    'address' => array(
                        'line1' => $useraddresses->calle,
                        'line2' => $useraddresses->colonia,
                        'line3' => $useraddresses->calle2,
                        'state' => $useraddresses->estado,
                        'city' => $useraddresses->ciudad,
                        'postal_code' => $useraddresses->cp,
                        'country_code' => 'MX'
                     )
                  );
               
               $customer = $openpay->customers->add($customerData);    

               $usercustomer = Customer::find($usercustomer->id);
               $usercustomer->idCustomerOpenpay = $customer->id;
               $usercustomer->update();

            } else {
                $customer = $openpay->customers->get($usercustomer->idCustomerOpenpay);
            }

           $cardData = array(
            'token_id' => $_POST["token_id"],
            'device_session_id' => $_POST["device_session_id"]
            );
          
          $card = $customer->cards->add($cardData);

          $tarjeta = new PaymentInformation;
          $tarjeta->usuario = Auth::user()->id;
          $tarjeta->idCardOpenpay = $card->id;
          $tarjeta->save();
          return back()->with("msg",$tarjeta->id);

        } catch (OpenpayApiRequestError $e) {
            error_log('ERROR on the request: ' . $e->getMessage(), 0);
        
        } catch (OpenpayApiConnectionError $e) {
            error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
        
        } catch (OpenpayApiAuthError $e) {
            error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
            
        } catch (OpenpayApiError $e) {
            error_log('ERROR on the API: ' . $e->getMessage(), 0);
            
        } catch (Exception $e) {
            error_log('Error on the script: ' . $e->getMessage(), 0);
        }        
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
