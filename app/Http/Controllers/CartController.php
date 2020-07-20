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
use App\Order;
use Carbon\Carbon;
use App\EnviaYa;
use App\Sepomex;
use App\ApiRequest;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;


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

use Openpay;
use Exception;
use OpenpayApiError;
use OpenpayApiAuthError;
use OpenpayApiRequestError;
use OpenpayApiConnectionError;
use OpenpayApiTransactionError;

use App\Mailers\AppMailers;
use App\PaymentInformation;

use Barryvdh\DomPDF\Facade as PDF;

class CartController extends Controller {

    use BrandAllTrait, CategoryTrait, SearchTrait;
    
    protected $mailer;

    public function showCart() {
    
        return view('cart.cart');     
    }

    public function payCart()
    {
        if(!auth()->check())
        {
           return redirect("/login")->with("log-to-pay", "Inicie sesión o regístrese para completar su compra");
        }

        // $envia=new EnviaYa; //Envios
        $addresses=Auth::user()->address()->get();
        $cartItems=Auth::user()->carts()->get();

        $date_now=Carbon::now();
       
        //Obtener el total al checar con el api
         //$subtotal=Auth::user()->total_checked;
        $subtotal=Auth::user()->total;
        $customer=Auth::user()->customer;
        $rates=collect([]);

        $addressActive;
        if(Auth::user()->addressActive() != null)
        {
            $addressActive=Auth::user()->addressActive();
            $cpUser=$addressActive->cp;
            //Revisar ciudad del codigo postal
            $sepomex_register=Sepomex::where("d_codigo",$cpUser)->first();
            if ($sepomex_register->count()) {
                if($sepomex_register->d_ciudad=="La Paz") //Revisar si el codigo postal es de la paz
                {
                    $rates=collect(["rate"=>0]);
                }
            }

            // $rates=$envia->getRates();
        }
        else
        {
            $cpUser="";
        }

        return view('cart.pay-cart', compact('addresses','addressActive','cartItems','subtotal','customer','cpUser','rates'));
    }

   

    /**
     * Agregar productos al carrito
     */
    public function addCart(Request $request) {
        
        //Checar el producto desde el api ->precio ->disponibilidad
        // $productChecked=ApiRequest::checkProductFromApi($request);
        $productChecked=true;
        //Buscar el producto para agregar al carrito
        $product=Product::find($request->product_id);

        //Obtener fecha actual
        $current_date=Carbon::now();

        //Agregar el atributo de la cantidad para mostrarlo
        $product->setAttribute('qty', 1);

        //Agregar el atributo de la imagen para mostrarlo
        $img_product=$product->photos()->first()->path;
        
        $product->setAttribute('img', $img_product);
        //Identificar si es visitante=0 | usuario registrado=1
        $user=0;
        $itemCount=0;

        if($productChecked)
        {
            if(Auth::check())
            { 
                $user=1; 
                if(!Auth::user()->productIs($product->id)) //Prevenir que se repita el producto en el carrito
                {  
                    $cart=new Cart;
                    $cart->user_id=Auth::user()->id;
                    $cart->status="Active";
                    $cart->product_id=$product->id;
                    $cart->product_price=$product->real_price;
                    $cart->product_sku=$product->product_sku;
                    $cart->qty=1;
                    $cart->total=$product->real_price;
                    $cart->checked_date=$current_date->format("Y-m-d");
                    $cart->save();
                    $itemCount=Auth::user()->carts->count();
                    $product->setAttribute('total', Auth::user()->total);
                }
                
            }
        }
       
        
        return response([
        'item'=>$product,
        'user' =>$user,
        'itemcount'=>$itemCount, 
        'img_product'=>$img_product,
        'productChecked'=>$productChecked],200);
    

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
        return back()->with('flash','Pago exitoso');
    }


    
    
    public function paypal(Request $request) 
    {
        return view('cart.cart-confirmation');
    }
    public function progressConfirmation()
    {
        return response(['progress'=>Session::get('progress')],200);
    }

    public function confirmation(Request $request, AppMailers $mailer) 
    {
        $sale= new Sale;
        $envio;

        //Revisar tipo de envio null == Acordar con el vendedor
        if($request->carrie_id)
        {

            Session::put('progress', "Preparando envío");
            Session::save(); 
            
            $enviaYa=new EnviaYa;
            $envio=$enviaYa->makeShipment($request->get('carrie'),$request->get('carrie_id'),Auth::user());
            
              
            Session::put('progress', $envio->status_message);
            Session::save();
        }
        else
        {
            $envio["shipment_status"]="Por acordar";
            $envio["carrier_shipment_number"]="Vendedor";
            $request["date_ship"]="5 dias habiles";
            $request["ship_rate"]="Acordar con el vendedor";
        }
     
        //Realizar y guardar la venta 
        $sale->insert(Auth::user()->total,$request->get('carrie'),$request->get("carrie_id"),
        $envio['shipment_status'],
        $envio['carrier_shipment_number'],"Acreditado", 
        $request->method_pay);
        
        //Obtener productos del carrito
        $cartItems=Auth::user()->carts();
        foreach($cartItems->get() as $cartItem)
        {
            //Obtener vendedor del producto
            $productseller=ProductSeller::find( $cartItem->product->id);
           
            if($productseller != null)
            {
                $saleHistory=new SeleHistory;
                $saleHistory->insert($cartItem,$productseller->id,Auth::user()->customer->nombre, $sale->id);
            }
            else
            {
                //Obtener administrador
                $admin = User::role('Admin')->first();
                //Agregar historial de venta
                $saleHistory=new SeleHistory;
                $saleHistory->insert($cartItem,$admin->id,Auth::user()->customer->nombre, $sale->id);
            
            }
            //Quitar cantidad
            $product=Product::find($cartItem->product_id);
            $product->product_qty=$product->product_qty-$cartItem->qty;
            $product->save();

            //Agregar al historial del cliente
            $customerHistory=new CustomerHistory;
            $customerHistory->insert($cartItem,$sale);
        }

        // Envio de correo
        
        //Administrador
        $admin = User::role('Admin')->first();
        
        //Enviar correo a administrador
        $mailer->sendReceiptPayment($admin,Auth::user(), $sale, $request->ship_rate, $request->date_ship, $request->method_pay);
        if($mailer)
        {
            //Enviar correo a cliente con su recibo de compra
            $mailer->sendReceiptPaymentClient(Auth::user(), $envio, $sale, $request->ship_rate,$request->date_ship, $request->method_pay);
            if($mailer)
            {
                //borrar productos del carrito
                Auth::user()->carts()->delete();
                //Borrar sesion para el mensaje de progreso
                Session::forget('progress');
                //Regresar a home con el mensaje de pago existoso
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

    //WebHook para pagos con banco y tiendas
    public function OpnepayWebhookCatch(Request $request, AppMailers $mailer) 
    {
        
        if($request != null)
        { 
            $json = file_get_contents("php://input");
            $transfer = json_decode($json);
            //Pago procesado con exito
             if($transfer->type=="charge.succeeded")
             {

              

                 //Buscar venta 
                 $sale=Sale::find($transfer->transaction->order_id);
                
                 if($sale->status_pago!="Acreditado") //Prevenir el doble envio de notificacion por parte de openpay
                 {
                
                    $client=$sale->client;
                    $envio=null;
                    //Envio acordar con el vendedor
                    if($sale->shipment_method=="A acordar con el vendedor")
                    {
                        
                        $envio["shipment_status"]="Por acordar";
                        $envio["carrier_shipment_number"]="Vendedor";
                        $request["date_ship"]="5 dias habiles";
                        $request["ship_rate"]="A acordar con el vendedor";
                    }
                    else
                    {
                        $enviaYa=new EnviaYa;
                        $envio=$enviaYa->makeShipment($sale->shipment_method,$sale->shipment_rate_id,$client);
                        $sale->updateStatusShip($envio->shipment_status);
                        $sale->updateTracking($envio->carrier_shipment_number);
                    }
                    
                    //Actualizar status de pago
                    $sale->updatePay();
   
                    //Buscar el usuario administrador
                    $userAdmin=User::role('Admin')->first();
                    //Enviar correos
                    
                    //Agregar al historial de venta
                    foreach($sale->customerHistories()->get() as $item)
                    {
                       $productseller=ProductSeller::find( $item->product_id); //Buscar si existe el vendedor
                       if($productseller != null)
                       {
                           $saleHistory=new SeleHistory;
                           $saleHistory->insert_pCustomer($item,$productseller->id,$client->customer->nombre,$sale->id);
                       }
                       else //Al no existir se le agrega al administrador
                       {
                            $saleHistory=new SeleHistory;
                            $saleHistory->insert_pCustomer($item,$userAdmin->id,$client->customer->nombre,$sale->id);
                       }

                       //Quitar cantidad al producto
                        $product=Product::find($item->product_id);
                        $product->product_qty=$product->product_qty-$item->amount;
                        $product->save();
                   }
                   
                   //envio de correos al administrador como al cliente del pago existoso
                  
                    $shipment_data=null;
                    $carrie_rate;
                    $delivery;
                    if($envio["shipment_status"]!="Por acordar") //Por acordar==Acordar con el vendedor
                    {
                        $shipment_data["guia"]= $envio->carrier_shipment_number;
                        $shipment_data["url"]=$envio->carrie_url;
                        $shipment_data["img_carrier"]=$envio->rate->carrier_logo_url;

                        $carrie_rate= $envio->rate->total_amount;
                        $delivery=$envio->rate->estimated_delivery;
                    }
                    else
                    {
                        $carrie_rate="Acordado con el vendedor";
                        $delivery="Acordar con el vendedor";
                    }
                    
                    $mailer->sendReceiptClientAdmin($userAdmin, $client, $sale, $shipment_data, $carrie_rate, $delivery);
                }
                 
            }
         }
       
         echo "HTTP 200 OK"; 
       
        //Obtener codigo de enlace para el dashboard de openpay (NO BORRAR)

        // header('HTTP/1.1 200 OK');        
        // $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        // $json = file_get_contents("php://input");
        // $a = json_decode($json);
        //     fwrite($myfile, json_encode($a));
        // fclose($myfile); 

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

    //Pagos en banco
    public function PagosBanco(Request $request) {
        
        //Conectarse con la api de openpay
        $openpay = \Openpay::getInstance(config('configurations.api.openpay_client_id'), config('configurations.api.api_key_openpay'));
        
        //Obtener el cliente
        $usercustomer = Customer::where("usuario",Auth::user()->id)->first();
        //Obtener direccion activa del cliente 
        $useraddresses = Address::where("usuario",Auth::user()->id)->first();

        //Realizar venta
        $sale= new Sale;
        $sale->Insert($request->get("ship_rate_total"),$request->get("carrie"),$request->get("carrie_id"),"Pago por acreditar",null,"Pago por acreditar",$request->method_pay);

     
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
                    
        $chargeData = array(
            'method' => 'bank_account', 
            'amount' => number_format((float) $request->get("ship_rate_total"), 2) ,
            'description' => 'Cargo con Bancomer',
            'order_id' => $sale->id, //oid-00051 id del carrito
            'due_date' => substr(Carbon::now()->addDay(3), 0 , 10),
            'customer' => $customerData );
        $charge = $openpay->charges->create($chargeData);
        
      
        $cartItems=Auth::user()->carts();
        $itemsCart = Auth::user()->cart->with("product")->get();
        foreach($cartItems->get() as $cartItem)
        {
            $customerHistory=new CustomerHistory;
            $customerHistory->insert($cartItem,$sale);
        }
        Auth::user()->carts()->delete();

        $ship_rate = $request->get("ship_rate");
        $ship_rate_total = $request->get("ship_rate_total");
        $date_ship = $request->get("date_ship");

        
        if($charge){    
            $pdf = PDF::loadView('cart.Print-Bank',compact('itemsCart','ship_rate','ship_rate_total','date_ship', 'charge'));
            //enviar por correo
            
            Session::put('pay-bank',  $pdf->stream('Recibo-Banco.pdf'));
            Session::save(); 
            return redirect("/");
            // return redirect('/')->with("recibe", 'https://sandbox-dashboard.openpay.mx/spei-pdf/mk5lculzgzebbpxpam6x/'.$charge->id);
        }
        
        } catch (OpenpayApiTransactionError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        
        } catch (OpenpayApiRequestError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        
        } catch (OpenpayApiConnectionError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        
        } catch (OpenpayApiAuthError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        } catch (OpenpayApiError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
            
        } catch (Exception $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        }
        
    }

    //Pagos en tienda
    public function PagosStore(Request $request) {
        //Conectra con el api de openpay
        $openpay = \Openpay::getInstance(config('configurations.api.openpay_client_id'), config('configurations.api.api_key_openpay'));
        
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
        
        //Generar venta por acreditar
        $sale= new Sale;
        $sale->Insert($request->get("ship_rate_total"),$request->get("carrie"),$request->get("carrie_id"),"Pago por acreditar",null,"Pago por acreditar",$request->method_pay);
        $cartItems=Auth::user()->carts();
        $itemsCart = Auth::user()->cart->with("product")->get();

        foreach($cartItems->get() as $cartItem)
        {
            $customerHistory=new CustomerHistory;
            $customerHistory->insert($cartItem,$sale);
        }
        $ship_rate = $request->get("ship_rate");
        $ship_rate_total = $request->get("ship_rate_total");
        $date_ship = $request->get("date_ship");

        Auth::user()->carts()->delete();
        $chargeData = array(
            'method' => 'store',
            'amount' => number_format((float) $request->get("ship_rate_total"), 2) ,
            'description' => 'Cargo a tienda',
            'order_id' => $sale->id, 
            'due_date' => substr(Carbon::now()->addDay(1), 0 , 10),
            'customer' => $customerData );
        
        $charge = $openpay->charges->create($chargeData);
       
        if($charge){    
            $pdf = PDF::loadView('cart.Print-Store',compact('itemsCart','ship_rate','ship_rate_total','date_ship', 'charge'));
            Session::put('pay-store',  $pdf->stream('Recibo-Tiendas.pdf'));
            Session::save(); 
            return redirect("/");
            // return redirect('/')->with("recibe",'https://sandbox-dashboard.openpay.mx/paynet-pdf/mk5lculzgzebbpxpam6x/'.$charge->payment_method->reference);
        }
        
        } catch (OpenpayApiTransactionError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        
        } catch (OpenpayApiRequestError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        
        } catch (OpenpayApiConnectionError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        
        } catch (OpenpayApiAuthError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        } catch (OpenpayApiError $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
            
        } catch (Exception $e) {
            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        }

    }


    //pago con targeta de crédito o débito
    public function CardOpenpay(Request $request) {
        
        Session::put('progress', "Generando el cargo");
        Session::save(); 
        try {
            $openpay = Openpay::getInstance(config('configurations.api.openpay_client_id'), config('configurations.api.api_key_openpay'));
            Openpay::setProductionMode(false);

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
                'amount' => number_format((float) $request->get("ship_rate_total"), 2) ,
                'description' => 'Compra',
                'order_id' => 'ORDEN-'.$random,
                // 'use_card_points' => $_POST["use_card_points"], // Opcional, si estamos usando puntos
                'device_session_id' => $_POST["deviceIdHiddenFieldName"],
                'customer' => $customer);
            
            
            $charge = $openpay->charges->create($chargeData);
           

          
           if($charge->status=='completed')
           {
               $val=$request->ship_rate;
                return redirect()->action(
                    'CartController@confirmation', ['carrie' => $request->get('carrie'), 'carrie_id'=> $request->get('carrie_id'),
                                                    'ship_rate'=>$request->get('ship_rate'), 'date_ship'=>$request->get('date_ship'),
                                                    'method_pay'=>$request->get('method_pay') ]
                );
           }
          


        } catch (OpenpayApiTransactionError $e) {

            $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
            
        } catch (OpenpayApiRequestError $e) {

             $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        } catch (OpenpayApiConnectionError $e) {

             $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        } catch (OpenpayApiAuthError $e) {

             $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        } catch (OpenpayApiError $e) {

             $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
        } catch (Exception $e) {

             $error_message="Error en la trasacción: ".Cart::error_code_openpay($e->getErrorCode());

            return back()->with("error", $error_message);
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
            $orOxxo=new Order;
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
        if(Session::has('pay-bank'))
        {
            $pdf=session("pay-bank");
            Session::forget('pay-bank');
            return $pdf;
        }
        if(Session::has('pay-store'))
        {
            $pdf=session("pay-store");
            Session::forget('pay-store');
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

  

    
}


