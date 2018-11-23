<?php

namespace App\Http\Controllers;

use App\Cart;
use Validator;
use App\Product;
use App\User;
use App\Sale;
use App\Address;
use App\CustomerHistory;
use App\SeleHistory;
use App\Customer;
use App\ProductSeller;
use App\Webhook;
use App\OrderOxxo;
use Carbon\Carbon;
use App\EnviaYa;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

use Laravel\Cashier\CashierServiceProvider;
use Laravel\Cashier\Cashier;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


use App\Mailers\AppMailers;
use App\PaymentInformation;

use Barryvdh\DomPDF\Facade as PDF;

class CartController extends Controller {

    use BrandAllTrait, CategoryTrait, SearchTrait;
    
    protected $mailer;
    public function showCart() {
    
        // $envia=new EnviaYa;
        // dd($envia->getRates());
        return view('cart.cart'); 
            
    }

    public function payCart()
    {
        $addresses=Auth::user()->address()->get();
        $cartItems=Auth::user()->carts()->get();
        $subtotal=Auth::user()->total;
        $customer=Auth::user()->customer;
        if(Auth::user()->addressActive() != null)
        {
            $cpUser=Auth::user()->addressActive()->cp;
        }
        else
        {
            $cpUser="";
        }
        
        return view('cart.pay-cart', compact('addresses','cartItems','subtotal','customer','cpUser'));
    }

   

    /**
     * Agregar productos al carrito
     */
    public function addCart(Request $request) {

        //Buscar el producto para agregar al carrito
        $product_id=Product::find($request->product_id);
        //$product_id=Product::where("id",$request->product_id);
        $product_id->setAttribute('qty', 1);
        $img_product=$product_id->photos()->first()->path;
        $product_id->setAttribute('img', $img_product);
        // Identificar si es visitante o usuario registrado
        $user=0;
        $itemCount=0;
        if(Auth::check())
        { 
            $user=1;
            if(Auth::user()->productIs($product_id->id))
            {  
                
            }
            else
            {
                $product_total=$product_id->price-$product_id->reduced_price;
                $cart=new Cart;
                $cart->user_id=Auth::user()->id;
                $cart->status="Active";
                $cart->product_id=$product_id->id;
                $cart->product_price=$product_total;
                $cart->qty=1;
                $cart->total=$product_total;
                $cart->save();
                $itemCount=Auth::user()->carts->count();
                $product_id->setAttribute('total', Auth::user()->total);
            }
            
        }
        
        return response(['item'=>$product_id,'user' =>$user,'itemcount'=>$itemCount, 'img_product'=>$img_product],200);
    

    }

    public function changeqty(Request $request){
        $cart=Cart::where('id',$request->cart_id)->where('user_id',Auth::user()->id);
        $product_price=Cart::where('id',$request->cart_id)->where('user_id',Auth::user()->id)->get();
        
        $cart->update(array(
            'qty'        => $request->qty,
            'total'      => $request->qty*$product_price[0]->product_price,
        ));

        $cartUser=Auth::user()->cart->where('id',$request->cart_id)->get();
        $totalCart=Auth::User()->total;
        return response(['cartUser'=>$cartUser,'totalCart'=>$totalCart],200);
    }
    public function PDF(Request $request)
    {
        $items;
        if(Auth::check())
        {
            $items=Auth::user()->cart->with("product")->get();
        }
        else
        {
            $items=json_decode($request->get('Items'));
        }
       
        $pdf = PDF::loadView('cart.Print-cart',compact('items'));
        return $pdf->stream('Carrito.pdf');
      
    }

    /**
     * Update the Cart
     * 
     * @return mixed
     */
    public function update() {
        
        // Set $user_id to the currently signed in user ID
        $user_id = Auth::user()->id;

        // Set the $qty to the quantity of products selected
        $qty = Input::get('qty');

        // Set $product_id to the hidden product input field in the update cart from
        $product_id = Input::get('product');

        // Set $cart_id to the hidden cart_id input field in the update cart from
        $cart_id = Input::get('cart_id');
        
        // Find the ID of the products in the Cart
        $product = Product::find($product_id);

        if ($product->reduced_price == 0) {
            $total = $qty * $product->price;
        } else {
            $total = $qty * $product->reduced_price;
        }

        // Select ALL from cart where the user ID = to the current logged in user, product_id = the current product ID being updated, and the cart_id = to the cartId being updated
        $cart = Cart::where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->where('id', '=', $cart_id);

        // Update your cart
        $cart->update(array(
            'user_id'    => $user_id,
            'product_id' => $product_id,
            'qty'        => $qty,
            'total'      => $total
        ));

        return redirect()->route('cart');
    }
    
    
    
    public function delete(Request $request) {
        // Find the Carts table and given ID, and delete the record
       
        $cartDestroy=Cart::destroy($request->cart_id);
        $cartItems;
        if(Auth::check())
        {
            $cartItems=Auth::user()->cart->with('product')->with('product.photos')->get();
            $TotalUser=Auth::user()->total;
        }
       
        
        // Then redirect back
        return response(['cartItems'=>$cartItems,'totalUser'=>$TotalUser ],200);
    }

    public function showPaymentCardCredit() {
        return view('cart.cart-payment');
    }

    public function showPaymentCardCreditSuccess(Request $request) {
        //dd($request);
        return back()->with('flash','Pago exitoso');
    }


    
    
    public function paypal(Request $request) {
        return view('cart.cart-confirmation');
    }
    public function progressConfirmation()
    {
        return response(['progress'=>Session::get('progress')],200);
    }

    public function confirmation(Request $request, AppMailers $mailer) {
        
        Session::put('progress', "Preparando envío");
        Session::save(); 
        
        $sale= new Sale;
        $enviaYa=new EnviaYa;
        $envio=$enviaYa->makeShipment($request->get('carrie'),$request->get('carrie_id'),Auth::user());
       
        Session::put('progress', $envio->status_message);
        Session::save();

        $sale->insert(Auth::user()->total,$request->get('carrie'),$request->get("carrie_id"),$envio->shipment_status,$envio->carrier_shipment_number,"Acreditado");
        $cartItems=Auth::user()->carts();
        foreach($cartItems->get() as $cartItem)
        {
            $productseller=ProductSeller::find( $cartItem->product->id);
           
            if($productseller != null)
            {
                $saleHistory=new SeleHistory;
                $saleHistory->insert($cartItem,$productseller->id,Auth::user()->customer->nombre);
            }
            else
            {
                $admins=User::where("admin",1)->get();
                foreach($admins as $admin)
                {   
                    $saleHistory=new SeleHistory;
                    $saleHistory->insert($cartItem,$admin->id,Auth::user()->customer->nombre);
                }
            }
            $customerHistory=new CustomerHistory;
            $customerHistory->insert($cartItem,$sale);
        }

        
        //Administrador
        $user=User::find(6);
        
        $mailer->sendReceiptPayment($user,Auth::user(), null);
        if($mailer)
        {
            
            $mailer->sendReceiptPaymentClient(Auth::user(),$envio->carrier_shipment_number, $envio->carrie_url, $envio->rate->carrier_logo_url,null);
            if($mailer)
            {
                //borrar productos del carrito
                Auth::user()->carts()->delete();
                Session::forget('progress');
                return redirect("/")->with('pay-success','Pago exitoso');
            }
            else
            {
                echo("Mensaje no enviado");
            } 
        }
        else
        {
            echo("Mensaje no enviado");
        }
        
    }

    //Pruebas de vista de recibo de pago
    public function showRecibe()
    {
        $cartItems=Auth::user()->carts()->get();
        $subtotal=Auth::user()->total; 
        $user=Auth::user();
        $address=Auth::user()->address()->where("Activo",1)->first();
        return view('customer.partials.recibe',compact('user','cartItems','subtotal','address'));
    }

    public function sendReceipt(AppMailers $mailer)
    {
        $user=User::find(7);
        $sale= new Sale;
        $sale->insert(Auth::user()->total);
        Auth::user()->carts()->delete();
        dd($sale);
        $mailer->sendReceiptPayment($user);
        if($mailer)
        {
            return back();
        }
        else
        {
            echo("Mensaje no enviado");
        }
    }

    public function addUserOpenpay() {

        $openpay = \Openpay::getInstance('mk5lculzgzebbpxpam6x', 'sk_d90dcb48c665433399f3109688b76e24');

        $usercustomer = Customer::where("usuario",Auth::user()->id)->first();
        $useraddresses = Address::where("usuario",Auth::user()->id)->first();
            $customerData = array(
            'external_id' => Auth::user()->id,
            'name' => $usercustomer->nombre,
            'last_name' => $usercustomer->apellidos,
            'email' => Auth::user()->email,
            'phone_number' => $usercustomer->telefono,
            'address' => array(
                    'line1' => $useraddresses->calle,
                    'line2' => $useraddresses->calle2,
                    'line3' => $useraddresses->calle3,
                    'postal_code' => $useraddresses->cp,
                    'state' => $useraddresses->estado,
                    'city' => $useraddresses->ciudad,
                    'country_code' => 'MX'));
        $customer = $openpay->customers->add($customerData);

    }

    //Pagos en banco
    public function PagosBanco(Request $request) {

      
        $openpay = \Openpay::getInstance('mk5lculzgzebbpxpam6x', 'sk_d90dcb48c665433399f3109688b76e24');
        $usercustomer = Customer::where("usuario",Auth::user()->id)->first();
        $useraddresses = Address::where("usuario",Auth::user()->id)->first();
     
        try {
        $random = rand(0, 99999);

        $customerData = array(
            // 'external_id' => Auth::user()->id,
            'name' => $usercustomer->nombre,
            'last_name' => $usercustomer->apellidos,
            'email' => Auth::user()->email,
            'phone_number' => $usercustomer->telefono,
            'address' => array(
                    'line1' => $useraddresses->calle,
                    'line2' => $useraddresses->calle2,
                    'line3' => $useraddresses->calle3,
                    'postal_code' => $useraddresses->cp,
                    'state' => $useraddresses->estado,
                    'city' => $useraddresses->ciudad,
                    'country_code' => 'MX'));
        // $sale= new Sale;
        // $sale->Insert($request->get("ship_rate_total"),$request->get("carrie"),$request->get("carrie_id"),"Pago por acreditar",null,"Pago por acreditar");
        // $cartItems=Auth::user()->carts();
        // foreach($cartItems->get() as $cartItem)
        // {
        //     $customerHistory=new CustomerHistory;
        //     $customerHistory->insert($cartItem,$sale);
        // }
        // Auth::user()->carts()->delete();
        $chargeData = array(
            'method' => 'bank_account',
            'amount' => Auth::user()->total + 200,  //$request->get("ship_rate_total"),
            'description' => 'Cargo con Bancomer',
            'order_id' => $random,  //$sale->id, //oid-00051 id del carrito
            'due_date' => substr(Carbon::now()->addDay(3), 0 , 10),
            'customer' => $customerData );
        $charge = $openpay->charges->create($chargeData);
        // dd($charge);
        
        if($charge){

            $ship_rate = 200;
            $date_ship = '12/12/18';
            $cartItems=Auth::user()->cart->with("product")->get();
            $ship_rate_total = $ship_rate + Auth::user()->total;
            $Items = $cartItems;
            // dd($charge->payment_method->agreement);
            $subtotal = $charge->amount;
    
            $pdf = PDF::loadView('cart.Print-Bank',compact('cartItems','ship_rate','ship_rate_total','date_ship', 'charge'));
            return $pdf->stream('Recibo-Banco.pdf');  
            // return redirect('/')->with("recibe", 'https://sandbox-dashboard.openpay.mx/spei-pdf/mk5lculzgzebbpxpam6x/'.$charge->id);
        }
        
        } catch (OpenpayApiTransactionError $e) {
            error_log('ERROR on the transaction: ' . $e->getMessage() . 
                  ' [error code: ' . $e->getErrorCode() . 
                  ', error category: ' . $e->getCategory() . 
                  ', HTTP code: '. $e->getHttpCode() . 
                  ', request ID: ' . $e->getRequestId() . ']', 0);
            echo "ERROR A";
        
        } catch (OpenpayApiRequestError $e) {
            error_log('ERROR on the request: ' . $e->getMessage(), 0);
            echo "ERROR B";
            echo $e;
        
        } catch (OpenpayApiConnectionError $e) {
            error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
            echo "ERROR C";
        
        } catch (OpenpayApiAuthError $e) {
            error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
            echo "ERROR D";
        } catch (OpenpayApiError $e) {
            error_log('ERROR on the API: ' . $e->getMessage(), 0);
            echo "ERROR E";
            
        } catch (Exception $e) {
            error_log('Error on the script: ' . $e->getMessage(), 0);
            echo "ERROR F";
        }
        
    }

    //Pagos en tienda
    public function PagosStore(Request $request) {
        $openpay = \Openpay::getInstance('mk5lculzgzebbpxpam6x', 'sk_d90dcb48c665433399f3109688b76e24');
        $usercustomer = Customer::where("usuario",Auth::user()->id)->first();
        $useraddresses = Address::where("usuario",Auth::user()->id)->first();
        Carbon::createFromFormat('Y-m-d H', '1975-05-21 22')->toDateTimeString();
        $random = rand(0, 99999);

        try {
       

        $customerData = array(
            'name' => $usercustomer->nombre,
            'last_name' => $usercustomer->apellidos,
            'email' => Auth::user()->email,
            'phone_number' => $usercustomer->telefono,
            'address' => array(
                    'line1' => $useraddresses->calle,
                    'line2' => $useraddresses->calle2,
                    'line3' => $useraddresses->calle3,
                    'postal_code' => $useraddresses->cp,
                    'state' => $useraddresses->estado,
                    'city' => $useraddresses->ciudad,
                    'country_code' => 'MX'));

        // $sale= new Sale;
        // $sale->Insert($request->get("ship_rate_total"),$request->get("carrie"),$request->get("carrie_id"),"Pago por acreditar",null,"Pago por acreditar");
        // $cartItems=Auth::user()->carts();
        // foreach($cartItems->get() as $cartItem)
        // {
        //     $customerHistory=new CustomerHistory;
        //     $customerHistory->insert($cartItem,$sale);
        // }
        Auth::user()->carts()->delete();
        $chargeData = array(
            'method' => 'store',
            'amount' =>  Auth::user()->total + 200,  //$request->get("ship_rate_total"),
            'description' => 'Cargo a tienda',
            'order_id' => $random,  //$sale->id, 
            'due_date' => substr(Carbon::now()->addDay(1), 0 , 10),
            'customer' => $customerData );
        
        $charge = $openpay->charges->create($chargeData);
       
        if($charge){
            $ship_rate = 200;
            $date_ship = '12/12/18';
            $cartItems=Auth::user()->cart->with("product")->get();
            $ship_rate_total = $ship_rate + Auth::user()->total;
            $Items = $cartItems;
            $subtotal = $charge->amount;
    
            $pdf = PDF::loadView('cart.Print-Store',compact('cartItems','ship_rate','ship_rate_total','date_ship', 'charge'));
            return $pdf->stream('Recibo-Tiendas.pdf');  
            // return view('cart.Print-Store',compact('cartItems','ship_rate','ship_rate_total','date_ship', 'charge'));
            // return redirect('/')->with("recibe",'https://sandbox-dashboard.openpay.mx/paynet-pdf/mk5lculzgzebbpxpam6x/'.$charge->payment_method->reference);
        }
        
        } catch (OpenpayApiTransactionError $e) {
            error_log('ERROR on the transaction: ' . $e->getMessage() . 
                  ' [error code: ' . $e->getErrorCode() . 
                  ', error category: ' . $e->getCategory() . 
                  ', HTTP code: '. $e->getHttpCode() . 
                  ', request ID: ' . $e->getRequestId() . ']', 0);
            echo "ERROR A";
        
        } catch (OpenpayApiRequestError $e) {
            error_log('ERROR on the request: ' . $e->getMessage(), 0);
            echo "ERROR B";
            echo $e;
        
        } catch (OpenpayApiConnectionError $e) {
            error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
            echo "ERROR C";
        
        } catch (OpenpayApiAuthError $e) {
            error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
            echo "ERROR D";
        } catch (OpenpayApiError $e) {
            error_log('ERROR on the API: ' . $e->getMessage(), 0);
            echo "ERROR E";
            
        } catch (Exception $e) {
            error_log('Error on the script: ' . $e->getMessage(), 0);
            echo "ERROR F";
        }

    }

    public function OpnepayWebhookCatch(Request $request, AppMailers $mailer) 
    {
        echo "HTTP 200 OK"; 
        if($request != null)
        { 
            $json = file_get_contents("php://input");
            $transfer = json_decode($json);
             if($transfer->type=="charge.succeeded")
             {
                 $sale=Sale::find($transfer->transaction->order_id);
                 if($sale->status_pago=="Acreditado")
                 { }
                 else
                 {
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
                }
                 
            }
         }
       
       
       

        // header('HTTP/1.1 200 OK');        

        // $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        // $json = file_get_contents("php://input");
        // $a = json_decode($json);
        //     fwrite($myfile, json_encode($a));
        // fclose($myfile); 

    }

    //pago con targeta de crédito o débito
    public function CardOpenpay(Request $request) {
        Session::put('progress', "Generando el cargo");
        Session::save(); 
        try {
            $openpay = \Openpay::getInstance('mk5lculzgzebbpxpam6x', 'sk_d90dcb48c665433399f3109688b76e24');
            $usercustomer = Customer::where("usuario",Auth::user()->id)->first();
            $useraddresses = Address::where("usuario",Auth::user()->id)->first();
            $random = rand(0, 99999);

            $customer = array(
                'name' => $usercustomer->nombre,
                'last_name' => $usercustomer->apellidos,
                'phone_number' => $usercustomer->telefono,
                'email' => Auth::user()->email,);

            
            $chargeData = array(
                'method' => 'card',
                'source_id' => $_POST["token_id"],
                'amount' => $request->get("ship_rate_total"),
                'description' => 'Compra',
                'order_id' => 'ORDEN-'.$random,
                // 'use_card_points' => $_POST["use_card_points"], // Opcional, si estamos usando puntos
                'device_session_id' => $_POST["deviceIdHiddenFieldName"],
                'customer' => $customer);
            
            

            $charge = $openpay->charges->create($chargeData);
           if($charge->status=='completed')
           {
                return redirect()->action(
                    'CartController@confirmation', ['carrie' => $request->get('carrie'), 'carrie_id'=> $request->get('carrie_id')]
                );
           }
        } catch (OpenpayApiTransactionError $e) {
            error_log('ERROR on the transaction: ' . $e->getMessage() . 
                ' [error code: ' . $e->getErrorCode() . 
                ', error category: ' . $e->getCategory() . 
                ', HTTP code: '. $e->getHttpCode() . 
                ', request ID: ' . $e->getRequestId() . ']', 0);
            // if ($e->getErrorCode() == 3001) {
            //     echo($e->getMessage());
            // }
        
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

    public function AddClientOpenpay(Request $request) {
        try {
            $openpay = \Openpay::getInstance('mk5lculzgzebbpxpam6x', 'sk_d90dcb48c665433399f3109688b76e24');
            $usercustomer = Customer::where("usuario",Auth::user()->id)->first();
            $useraddresses = Address::where("usuario",Auth::user()->id)->first();

            $customerData = array(
                // 'external_id' => auth::user()->id,
                'name' => $_POST["client_name"],
                'last_name' => $usercustomer->apellidos,
                'email' => $_POST["cliente_email"],
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

           $cardData = array(
            'token_id' => $_POST["token_id"],
            'device_session_id' => $_POST["device_session_id"]
            );
          
          $card = $customer->cards->add($cardData);

          $tarjeta = new PaymentInformation;
          $tarjeta->usuario = Auth::user()->id;
          $tarjeta->idCardOpenpay = $card->id;
          $tarjeta->idCustomerOpenpay = $card->customer_id;
          $tarjeta->save();

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

    public function pruevasRecibos($charge) {
        $ship_rate = 200;
        $ship_rate_total;
        $date_ship = '12/12/18';
        $cartItems=Auth::user()->cart->with("product")->get();
        $ship_rate_total = $ship_rate + Auth::user()->total;
        $Items = $cartItems;
        // dd($charge->payment_method->agreement);
        $subtotal = $charge->amount;

        $pdf = PDF::loadView('cart.Print-Bank',compact('cartItems','ship_rate','ship_rate_total','date_ship'));
        return $pdf->stream('Recibo-Banco.pdf');

        // $pdf = PDF::loadView('cart.Print-Store',compact());
        // return $pdf->stream('Recibo-Tiendas.pdf');


        // $pdf = PDF::loadView('cart.Print-Oxxo',compact('cartItems','ship_rate','ship_rate_total','date_ship'));
        // $pdf = PDF::loadView('cart.Print-Receipt',compact('cartItems','ship_rate','ship_rate_total','date_ship', 'Items', 'subtotal'));
        // $pdf = PDF::loadView('cart.Cotizacion',compact('cartItems','ship_rate','ship_rate_total','date_ship', 'Items', 'subtotal'));
        // return $pdf->stream('Recibo-Oxxo.pdf');
        // return view('cart.Print-Oxxo',compact('cartItems','ship_rate','ship_rate_total','date_ship'));
    }

    //Pagos por Oxxo
    public function PagosOxxo(Request $request, AppMailers $mailer) {
        $ship_rate=$request->get("ship_rate");
        $ship_rate_total=$request->get("ship_rate_total");
        $date_ship=$request->get("date_ship");
        if(Auth::check())
        {
            $cartItems=Auth::user()->cart->with("product")->get();
        }
        
        $pdf = PDF::loadView('cart.Print-Oxxo',compact('cartItems','ship_rate','ship_rate_total','date_ship'));
        $mailer->sendOxxoReceipt(Auth::user(),$pdf);
        $sale= new Sale;
        $sale->Insert($request->get("ship_rate_total"),$request->get("carrie"),$request->get("carrie_id"),"Pago por acreditar",null,"Pago por acreditar");
        $cartItems=Auth::user()->carts();
        foreach($cartItems->get() as $cartItem)
        {
            $customerHistory=new CustomerHistory;
            $customerHistory->insert($cartItem,$sale);
        }
        $admins=User::where("admin",1)->get();
        foreach($admins as $admin)
        {   
            $orOxxo=new OrderOxxo;
            $orOxxo->insert($admin->id,$sale->id);
        }
        Auth::user()->carts()->delete();
        Session::put('pay-oxxo',  $pdf->stream('Recibo-Oxxo.pdf'));
        Session::save(); 
        return redirect("/");
    }

    public function showPDFOxxo()
    {
        if(Session::has('pay-oxxo'))
        {
            $pdf=session("pay-oxxo");
            Session::forget('pay-oxxo');
            return $pdf;
        }
        else
        {
            return redirect("/");
        }
    }

    public function PaypalWebhook() {
        $webhook = new \PayPal\Api\Webhook();

        // Set webhook notification URL     
        $webhook->setUrl("https://mercageek.com/notificacions/paypal" . uniqid());
        
        // # Event Types
        // Event types correspond to what kind of notifications you want to receive on the given URL.
        $webhookEventTypes = array();
        $webhookEventTypes[] = new \PayPal\Api\WebhookEventType(
            '{
                "name":"PAYMENT.AUTHORIZATION.CREATED"
            }'
        );
        $webhookEventTypes[] = new \PayPal\Api\WebhookEventType(
            '{
                "name":"PAYMENT.AUTHORIZATION.VOIDED"
            }'
        );
        // dd($webhookEventTypes);
        $webhook->setEventTypes($webhookEventTypes);
        // dd($webhook);

        // For Sample Purposes Only.
        $request = clone $webhook;
        // ### Create Webhook
        try {
            $output = $webhook->create($apiContext);
            dd($output);
        } catch (Exception $ex) {
            if ($ex instanceof \PayPal\Exception\PayPalConnectionException) {
                $data = $ex->getData();
                if (strpos($data, 'WEBHOOK_NUMBER_LIMIT_EXCEEDED') !== false) {
                    // require 'DeleteAllWebhooks.php';
                    try {
                        $output = $webhook->create($apiContext);
                        dd($output);
                    } catch (Exception $ex) {
                        exit(1);
                    }
                } else {
                    exit(1);
                }
            } else {
                exit(1);
            }
        }
        return $output;

    } 

    
    public function notify(Request $request)
    {
        dd($request);
    } 

    
}
