<?php

namespace App\Http\Controllers;
use App\Product;
use App\User;
use App\Customer;
use App\MarketRates;
use App\MarketRatesDetail;
use App\Sale;
use App\CustomerHistory;
use App\Order;
use App\Http\Requests\MarketRateRequest;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mailers\AppMailers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MarketRatesController extends Controller
{
    public function market_rates()
    {
        
        $market_rates=MarketRates::select("*")->orderBy("created_at", "desc")->paginate(10);
        $clients=Customer::orderBy("nombre")->get();
        return view("admin.market_rates.index", compact('market_rates', 'clients'));
    }

    //Mostrar informacion del producto a editar  
    public function showinfoproduct(Request $request)
    {
        $marketRateDetail=MarketRatesDetail::findOrFail($request->detail_id);

       return response($marketRateDetail, 200);
    }

    //Editar producto de la cotizacion
    public function editdetail(Request $request)
    {    
        $marketRateDetail=MarketRatesDetail::findOrFail($request->detail);

        
        $marketRateDetail->qty=$request->product_qty;
        $marketRateDetail->product_sku=$request->product_sku;

        $description=$request->product_name;
        //Agregar tiempo de entrega en caso de ingresarse
        if($request->product_delevery)
        {
            $description.="<br> Tiempo de entrega: <strong>".$request->product_delevery."</strong>";
        }

        $marketRateDetail->description=$description;
        $marketRateDetail->price=$request->product_price;
        $marketRateDetail->subtotal=($request->product_price)*$request->product_qty;
        
        $marketRateDetail->save();

        return back();



    }

    //Mostrar creacion de cotizaciones
    public function showCreate()
    {
        $clients=Customer::orderBy("nombre")->get();
       
        $marketrate=new MarketRates;
        return view("admin.market_rates.create", compact('marketrate', "clients"));
    }

    //Mostrar informacion 
    public function showEdit($id)
    {
        $clients=Customer::orderBy("nombre")->get();
        $marketrate=MarketRates::findOrFail($id);
        return view("admin.market_rates.edit", compact('marketrate',"clients"));
    }
    
    //Buscar productos en crear cotizacion
    public function searchMarket_rates(Request $request)
    {
        $search=null;
        $search_find=$request->search;

        if( $search_find!=null)
        {
            $query=Product::select("*")->with('brand')->with("category");  
                          
            $query->orWhere("products.product_sku", 'like', "%".$search_find."%");
            $query = $query->orWhereHas('brand', function( $query ) use ( $search_find ){
                $query->where('brand_name', "like" , "%".$search_find."%" );
            });

           
            $query = $query->orWhereHas('category', function( $query ) use ( $search_find ){
                $query->where('category',"like" ,"%".$search_find."%" );
            });
            
            $query = $query->orWhere("product_name", 'LIKE', "%".$search_find."%");
            
            $query = $query->orWhere("description", 'LIKE', "%".$search_find."%");

            $search = $query
                        ->orderBy("products.product_qty", "desc")
                        ->orderBy("products.product_name")->paginate(10);
           
            
        }
        session()->flashInput($request->input());
        $marketrate=new MarketRates;
        $clients=Customer::orderBy("nombre")->get();
        return view("admin.market_rates.create", compact('search','marketrate', "clients"));
        
    }
    



    public function searchMarket_ratesedit(Request $request)
    {
       
        $search=null;
        $search_find=$request->search;
        if( $search_find!=null)
        {
            $query=Product::select("*")->with('brand')->with("category");  
                          
            $query->orWhere("products.product_sku", 'like', "%".$search_find."%");
            $query = $query->orWhereHas('brand', function( $query ) use ( $search_find ){
                $query->where('brand_name', "like" , "%".$search_find."%" );
            });

           
            $query = $query->orWhereHas('category', function( $query ) use ( $search_find ){
                $query->where('category',"like" ,"%".$search_find."%" );
            });
            
            $query = $query->orWhere("product_name", 'LIKE', "%".$search_find."%");
            
            $query = $query->orWhere("description", 'LIKE', "%".$search_find."%");

            $search = $query->orderBy("products.product_qty", "desc")
                            ->orderBy("products.product_name")->paginate(10);
           
            
        }

        
        session()->flashInput($request->input());
        $marketrate=MarketRates::find($request->market);

        $clients=Customer::orderBy("nombre")->get();
        return view("admin.market_rates.edit", compact('search', 'marketrate', "clients"));
        
       
    }

    //Crear un nueva cotizacion
    public function createMarket_rates(MarketRateRequest $request)
    {
        
        //Crear JSON para la configuracion del PDF a guardar en la base de datos
        $json='{"timedelivery":"'.$request->time_delivery.'",'; //Agregar el tiempo de entrega
        $json.='"conditions":"'.$request->conditions.'", '; //Agregar las condiciones
        
        $json.='"notas":{'; //Agregar las notas
        $i=1;
        foreach ($request->note as $value) {
            if(count($request->note) == $i ) //Agregar la coma al ultimo elemento
            {
                $json.='"nota'.$i.'":"'.$value.'"';
            }
            else
            {
                $json.='"nota'.$i.'":"'.$value.'",';
            }
            $i++;
        }
        $json.="}";

        $json.="}";

        $request["pdf_info"]=$json;
        
        $request["date"]=Carbon::now();

        $market_rate=MarketRates::find($request->marketRate);
        if($market_rate->MarketRatesDetails()->count()>0)
        {
            $market_rate->update($request->all());
            return redirect("/admin/market_rates")->with("success", "Nueva cotizacion creada");
        }
        else
        {
            return redirect("/admin/market_rates/create")->with("fail", "Agregar productos para crear la cotización")->withInput();
        }
        
    }

    public function updateMarket_rates(MarketRateRequest $request)
    {
        //Crear JSON para la configuracion del PDF a guardar en la base de datos
        $json='{"timedelivery":"'.$request->time_delivery.'",'; //Agregar el tiempo de entrega
        $json.='"conditions":"'.$request->conditions.'", '; //Agregar las condiciones
        
        $json.='"notas":{'; //Agregar las notas
        $i=1;
        foreach ($request->note as $value) 
        {
            if(count($request->note) == $i ) //Agregar la coma al ultimo elemento
            {
                $json.='"nota'.$i.'":"'.$value.'"';
            }
            else
            {
                $json.='"nota'.$i.'":"'.$value.'",';
            }
            $i++;
        }
        $json.="}";

        $json.="}";

        $request["pdf_info"]=$json;

        $market_rate=MarketRates::find($request->marketRate);
        
        $market_rate->update($request->all());
        $market_rate->save();

        return redirect("/admin/market_rates")->with("success", "Cotizacion actualizada");
    }

    //Eliminar productos desde el editar
    public function deleteProductMarket_ratesEdit(Request $request)
    {
       
        
        $market_rate_detail=MarketRatesDetail::find($request->detail_id);


        $market_rate=MarketRates::find($market_rate_detail->market_rates_id);
        $market_rate->total= $market_rate->total-$market_rate_detail->subtotal;
        $market_rate->save();

        $market_rate_detail->delete();
        return response("Producto eliminado de cotización",200);
    }

    public function addMarket_rates(Request $request)
    {
       
        $market_rate_detail=null;
        $market_rate=null;
        if($request->market_id==null || $request->market_id=='undefined')   //Nueva cotización
        {
            $market_rate=new MarketRates;
           
        }
        else
        {
            $market_rate=MarketRates::findOrFail($request->market_id);
        }
       
        
        $market_rate->total=($request->product_price*$request->product_qty)+$market_rate->total;
        
        
        $market_rate->save();
        
        $market_rate_detail=new MarketRatesDetail;
        $market_rate_detail->market_rates_id=$market_rate->id;
       
        $market_rate_detail->thumbnail=$request->product_photo;
        $market_rate_detail->unity="pza";
        $market_rate_detail->qty=$request->product_qty;
        $market_rate_detail->product_sku=$request->product_sku;
        $market_rate_detail->description=$request->product_name;
        $market_rate_detail->price=$request->product_price;
        $market_rate_detail->subtotal=($request->product_price)*$request->product_qty;
        
        
        $market_rate_detail->save();
        
        return response(["detail"=>$market_rate_detail, "market_id"=>$market_rate->id],200);
    }

    //Agregar nuevo producto o servicio
    public function addNewMarket_rates(Request $request)
    {
        $market_rate_detail=null;
        $market_rate=null;
        if($request->market_id==null || $request->market_id=='undefined')   //Nueva cotización
        {
            $market_rate=new MarketRates;
        }
        else
        {
            $market_rate=MarketRates::find($request->market_id);
        }
       
        if($request->tab_active=="service")
        {
            $market_rate->total=($request->service_price*$request->qty_service)+$market_rate->total;
        }
        else if($request->tab_active=="int")
        {
            $market_rate->total=($request->int_price*$request->qty_int)+$market_rate->total;
        }
        else
        {
            $market_rate->total=($request->product_price*$request->qty_product)+$market_rate->total;
        }
        
        $market_rate->save();
        
        $market_rate_detail=new MarketRatesDetail;
        $market_rate_detail->market_rates_id=$market_rate->id;
        
        if($request->tab_active=="service")
        {
            $request->validate([
                "unity"=>"required",
                "qty_service"=>"required",
                "summary"=>"required",
                "service_price"=>"required"
            ],
            [
                "unity.required"=>"Ingresar la unidad del servicio",
                "qty_service.required"=>"Ingresar la cantidad del servicio",
                "summary.required"=>"Igresar una descripción ",
                "service_price.required"=>"Ingresar un costo al servicio"
            ]);
            $market_rate_detail->thumbnail="/images/service.png";
            
            $unity=$request->unity;
            if($unity=="Servicio")
            {
                $unity="srv";
            }

            $market_rate_detail->unity=$unity;
            $market_rate_detail->qty=$request->qty_service;
            $market_rate_detail->product_sku="Servicio";
            $market_rate_detail->description=$request->summary;
            $market_rate_detail->price=$request->service_price;
            $market_rate_detail->subtotal=($request->service_price)*$request->qty_service;
        }
        if($request->tab_active=="int")
        {
            $request->validate([
                "qty_int"=>"required",
                "int_summary"=>"required",
                "int_price"=>"required"
            ],
            [
                "qty_int.required"=>"Ingresar la cantidad de la integración",
                "int_summary.required"=>"Igresar una descripción ",
                "int_price.required"=>"Ingresar un costo al la integración"
            ]);
            $market_rate_detail->thumbnail="/images/integration.png";
        

            $market_rate_detail->unity="int";
            $market_rate_detail->qty=$request->qty_int;
            $market_rate_detail->product_sku="Integración";
            $market_rate_detail->description=$request->int_summary;
            $market_rate_detail->price=$request->int_price;
            $market_rate_detail->subtotal=($request->int_price)*$request->qty_int;
        }
        else
        {
            $request->validate([
                
                "qty_service"=>"required",
                "product_name"=>"required",
                "product_price"=>"required"
            ],
            [
               
                "qty_service.required"=>"Ingresar la cantidad del servicio",
                "product_name.required"=>"Igresar un nombre del producto",
                "product_price.required"=>"Ingresar un costo al servicio"
            ]);
            $market_rate_detail->thumbnail="/images/no-image-found.jpg";
            $market_rate_detail->unity="pza";
            $market_rate_detail->qty=$request->qty_product;
            $market_rate_detail->product_sku=$request->product_sku ? $request->product_sku : "No ingresado";

            $description=$request->product_name;
            //Agregar tiempo de entrega en caso de ingresarse
            if($request->product_delevery)
            {
                $description.="<br> Tiempo de entrega: <strong>".$request->product_delevery."</strong>";
            }

            $market_rate_detail->description=$description;
            $market_rate_detail->price=$request->product_price;
            $market_rate_detail->subtotal=($request->product_price)*$request->qty_product;
        }
        
        $market_rate_detail->save();
        
        
        
        return response(["detail"=>$market_rate_detail, "market_id"=>$market_rate->id],200);
    }
    public function addMarket_ratesEdit(Request $request)
    {
        
       
            $product=Product::find($request->product_id);
            $market_rate=MarketRates::find($request->market_id);
            
           
            if(!$market_rate->productRepeat($product->id))
            {
              
                $market_rate->total=($product->mr_price*$request->qty)+$market_rate->total;
                $market_rate->save();

                $market_rate_detail=new MarketRatesDetail;
                $market_rate_detail->market_rates_id=$request->market_id;
               
                $market_rate_detail->thumbnail="/images/no-image-found.jpg";
                $market_rate_detail->qty=$request->qty;
                $market_rate_detail->product_sku=$product->product_sku;
                $market_rate_detail->description=$product->description;
                $market_rate_detail->price=$product->mr_price;
                $market_rate_detail->subtotal=($product->mr_price)*$request->qty;
                $market_rate_detail->save();
                
                return back();
            }
            else
            {
                return back()->with("alert", "Este Producto ya se encuentra en la cotización");
            }

            
    }

    //Eliminar productos desde el crear
    public function deleteProductMarket_rates(Request $request)
    {
        $market_rate_detail=MarketRatesDetail::findOrFail($request->detail_id);


        $market_rate=MarketRates::find($market_rate_detail->market_rates_id);
        $market_rate->total= $market_rate->total-$market_rate_detail->subtotal;
        $market_rate->save();

        $market_rate_detail->delete();
        return response("Producto eliminado de cotización",200);
    }

    public function deleteMarket_rates(Request $request)
    {
        
        if($request->market_id!=null)
        {
            $market_rate=MarketRates::find($request->market_id);

            if($market_rate)
            {
                $market_rate->MarketRatesDetails()->delete();
                $market_rate->delete();
            }
            
        }
        
        
        return response("Cotizacion eliminada",200);
    }

    public function PDF(MarketRates $marketrate)
    {

        $items=$marketrate;

        $pdf = PDF::loadView('admin.market_rates.pdf-template',compact('items'));
        return $pdf->stream('Cotización'.$items->date.'.pdf');
      
    }

    public function sendMarketRate(AppMailers $mailer, MarketRates $marketrate)
    {
        if($marketrate->email!="" || $marketrate->email!=null)
        {
            $mailer->sendMarketRateReceipt($marketrate);
            if($mailer)
            {
                return back()->with("email-sended","Correo enviado con éxito");
            }
            else
            {
                return back()->with("fail","Correo no enviado favor de verificar el correo o intentar de nuevo");
            }
        }
        else
        {
            return back()->with("fail","Ingresar un correo valido");
        }
        
        
    }

    public function searchMarketRates(Request $request)
    {
        $search=null;
        $search_find=$request->search;

        $query=MarketRates::select("*");

        if($request->client)
        {
            $query=$query->where("client", $request->client);
        }

        if( $search_find!=null || $search_find!="")
        {
            $query = $query->where("company", 'LIKE', "%$search_find%")
                            ->orWhere("email", 'LIKE', "%$search_find%");

        }

        if($request->order)
        {
            switch ($request->order) {
                case '1':
                    $query=$query->orderBy("created_at", "desc");
                    break;

                case '2':
                    $query=$query->orderBy("created_at");
                    break;
                
                default:
                    $query=$query->orderBy("created_at", "desc");
                    break;
            }
        }
        
        $market_rates=$query->orderBy("created_at", "desc")->paginate(10);
        $clients=Customer::orderBy("nombre")->get();
        $old_inputs=$request->all();
       
        return view("admin.market_rates.index", compact('market_rates', 'clients', 'old_inputs'));
    }

    public function sendEmailMarketRate(AppMailers $mailer, Request $request)
    {
        
        $market_rate=MarketRates::find($request->markerate);
        $market_rate->company=$request->company;
        $market_rate->email=$request->email;
        if($market_rate->date==null)
        {
            $market_rate->date=Carbon::now();
        }
        $market_rate->save();

        $mailer->sendMarketRateReceipt($market_rate);
        if($mailer)
        {
            return back()->with("email-sended","Correo enviado con éxito");
        }
        else
        {
            return back()->with("fail","Correo no enviado favor de verificar el correo o intentar de nuevo");
        }
    }

    public function addOrder(Request $request)
    {
       
        $market_rate=MarketRates::find($request->marketrate);
         $sale= new Sale;
         $sale->Insert($market_rate->total,"","","Pago por acreditar",null,"Pago por acreditar","Cotización");
        $items=$market_rate;
        
        //PDF RECIBO
        $pdf = PDF::loadView('admin.market_rates.pdf-template-receipt',compact('items'));
        
        Session::put('pay-marketrate',  $pdf->stream('Recibo-pago.pdf'));
        Session::save(); 
        
        foreach($market_rate->MarketRatesDetails()->get() as $detail)
        {
            $history= new CustomerHistory;
            $history->sale_id=$sale->id;
            $history->product_id=$detail->id;
            $history->product_name=$detail->description;
            $history->product_price=$detail->price;
            $history->amount=$detail->qty;
            $history->save();
        }
        $orOxxo=new Order;
        $orOxxo->insert(Auth::user()->id,$sale->id, $market_rate->id);

        return back();
    }
    public function showPDFPay()
    {
        if(Session::has('pay-marketrate'))
        {
            $pdf=session("pay-marketrate");
            Session::forget('pay-marketrate');
            return $pdf;
        }
        else
        {
            return back();
        }
    }
}
