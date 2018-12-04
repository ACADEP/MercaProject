<?php

namespace App\Http\Controllers;
use App\Product;
use App\MarketRates;
use App\MarketRatesDetail;
use App\Sale;
use App\CustomerHistory;
use App\OrderOxxo;
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
        $market_rates=MarketRates::all();
        return view("admin.market_rates.index", compact('market_rates'));
    }

    public function showCreate()
    {
        
        return view("admin.market_rates.create");
    }

    public function showEdit(MarketRates $marketrate)
    {
        return view("admin.market_rates.edit", compact('marketrate'));
    }
    
    public function searchMarket_rates(Request $request)
    {
        $search=null;
        $search_find=$request->search;
        if( $search_find!=null)
        {
            // Returns an array of products that have the query string located somewhere within
            // our products product name. Paginate them so we can break up lots of search results.
            $query=Product::select("products.*")->join('brands', 'brand_id', '=', 'brands.id')
                                        ->join('categories', 'cat_id', '=', 'categories.id');  
                                                 
            $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%");
            $query = $query->orWhere("category", 'LIKE', "%$search_find%");
            $query = $query->orWhere("product_name", 'LIKE', "%$search_find%");
            $query = $query->orWhere("description", 'LIKE', "%$search_find%");
            $search = $query->get();
           
            
        }
        
       
            return view("admin.market_rates.create", compact('search'));
        
       
    }
    public function searchMarket_ratesedit(Request $request)
    {
        $search=null;
        $search_find=$request->search;
        if( $search_find!=null)
        {
            // Returns an array of products that have the query string located somewhere within
            // our products product name. Paginate them so we can break up lots of search results.
            $query=Product::select("products.*")->join('brands', 'brand_id', '=', 'brands.id')
                                        ->join('categories', 'cat_id', '=', 'categories.id');  
                                                 
            $query = $query->orWhere("brand_name", 'LIKE', "%$search_find%");
            $query = $query->orWhere("category", 'LIKE', "%$search_find%");
            $query = $query->orWhere("product_name", 'LIKE', "%$search_find%");
            $query = $query->orWhere("description", 'LIKE', "%$search_find%");
            $search = $query->get();
           
            
        }
        $marketrate=MarketRates::find($request->market);
        return view("admin.market_rates.edit", compact('search', 'marketrate'));
        
       
    }
    public function createMarket_rates(Request $request)
    {
        $request->validate([
            'company'=>'required',
            'email'=>'required|email',
            'marketRate'=>'required'
        ],
        [
            'company.required'=>'Ingresar el nombre de la empresa',
            'email.required'=>'Ingresar un email a enviar',
            'marketRate.required'=>'Agregar productos para crear la cotización'
        ]);

        $market_rate=MarketRates::find($request->marketRate);
        if($market_rate->MarketRatesDetails()->count()>0)
        {
            $market_rate->company=$request->company;
            $market_rate->email=$request->email;
            $market_rate->date=Carbon::now();
            $market_rate->save();
            return redirect("/admin/market_rates")->with("success", "Cotizacion creada");
        }
        else
        {
            return redirect("/admin/market_rates/create")->with("fail", "Agregar productos para crear la cotización")->withInput();
        }
        

       

    }
    public function updateMarket_rates(Request $request)
    {
        $request->validate([
            'company'=>'required',
            'email'=>'required|email',
        ],
        [
            'company.required'=>'Ingresar el nombre de la empresa',
            'email.required'=>'Ingresar un email a enviar',
        ]);

        $market_rate=MarketRates::find($request->marketRate);
        $market_rate->company=$request->company;
        $market_rate->email=$request->email;
        $market_rate->save();

        return redirect("/admin/market_rates")->with("success", "Cotizacion actualizada");
    }
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
        
        $product=Product::find($request->product_id);
        $market_rate_detail=null;
        $market_rate=null;
        if($request->market_id==null || $request->market_id=='undefined')   //Nueva cotización
        {
            $market_rate=new MarketRates;
            $market_rate->total=($product->price-$product->reduced_price)+$market_rate->total;
            $market_rate->save();
            
            $market_rate_detail=new MarketRatesDetail;
            $market_rate_detail->market_rates_id=$market_rate->id;
            $market_rate_detail->product_id=$product->id;
            $market_rate_detail->thumbnail=$product->photos()->first()->path;
            $market_rate_detail->qty=$request->product_qty;
            $market_rate_detail->product_sku=$product->product_sku;
            $market_rate_detail->description=$product->description;
            $market_rate_detail->price=$product->price-$product->reduced_price;
            $market_rate_detail->subtotal=($product->price-$product->reduced_price)*$request->product_qty;
            $market_rate_detail->save();
        }
        else    //Agregar productos a la cotización ya creada
        {
            $market_rate=MarketRates::find($request->market_id);
            
           
            if($market_rate->productRepeat($product->id)==false)
            {
                $market_rate->total=($product->price-$product->reduced_price)+$market_rate->total;
                $market_rate->save();

                $market_rate_detail=new MarketRatesDetail;
                $market_rate_detail->market_rates_id=$request->market_id;
                $market_rate_detail->product_id=$product->id;
                $market_rate_detail->thumbnail=$product->photos()->first()->path;
                $market_rate_detail->qty=$request->product_qty;
                $market_rate_detail->product_sku=$product->product_sku;
                $market_rate_detail->description=$product->description;
                $market_rate_detail->price=$product->price-$product->reduced_price;
                $market_rate_detail->subtotal=($product->price-$product->reduced_price)*$request->product_qty;
                $market_rate_detail->save();
            }
            
        }
        
        return response(["detail"=>$market_rate_detail, "market_id"=>$market_rate->id],200);
    }
    public function addMarket_ratesEdit(Request $request)
    {
        
            $product=Product::find($request->product_id);
            $market_rate=MarketRates::find($request->market_id);
            
           
            if(!$market_rate->productRepeat($product->id))
            {
              
                $market_rate->total=($product->price-$product->reduced_price)+$market_rate->total;
                $market_rate->save();

                $market_rate_detail=new MarketRatesDetail;
                $market_rate_detail->market_rates_id=$request->market_id;
                $market_rate_detail->product_id=$product->id;
                $market_rate_detail->thumbnail=$product->photos()->first()->path;
                $market_rate_detail->qty=$request->qty;
                $market_rate_detail->product_sku=$product->product_sku;
                $market_rate_detail->description=$product->description;
                $market_rate_detail->price=$product->price-$product->reduced_price;
                $market_rate_detail->subtotal=($product->price-$product->reduced_price)*$request->qty;
                $market_rate_detail->save();
                
                return back();
            }
            else
            {
                return back()->with("alert", "Este Producto ya se encuentra en la cotización");
            }

            
    }

    public function deleteProductMarket_rates(Request $request)
    {
       
        $market_rate_detail=MarketRatesDetail::find($request->detail_id);

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
            $market_rate->MarketRatesDetails()->delete();
            $market_rate->delete();
        }
        
        
        return response("Cotizacion eliminada",200);
    }

    public function PDF(MarketRates $marketrate)
    {
        $items=$marketrate;
        $pdf = PDF::loadView('admin.market_rates.pdf-print',compact('items'));
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
        if( $search_find!=null || $search_find!="")
        {
           
            $query=MarketRates::select("*");
                                                 
            $query = $query->orWhere("id", 'LIKE', "%$search_find%");
            $query = $query->orWhere("company", 'LIKE', "%$search_find%");
            $query = $query->orWhere("email", 'LIKE', "%$search_find%");
            $market_rates = $query->get();
           
            
        }
        else
        {
            $market_rates=MarketRates::all();
        }
       
        return view("admin.market_rates.index", compact('market_rates'));
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
        $sale->Insert($market_rate->total,"","","Pago por acreditar",null,"Pago por acreditar");
        $items=$market_rate;
        $pdf = PDF::loadView('admin.market_rates.pdf-pay',compact('items'));
        Session::put('pay-marketrate',  $pdf->stream('Recibo-pago.pdf'));
        Session::save(); 
        foreach($market_rate->MarketRatesDetails()->get() as $detail)
        {
            $history= new CustomerHistory;
            $history->sale_id=$sale->id;
            $history->product_id=$detail->product_id;
            $history->product_name=$detail->product->product_name;
            $history->product_price=$detail->price;
            $history->amount=$detail->qty;
            $history->save();
        }
        $orOxxo=new OrderOxxo;
        $orOxxo->insert(Auth::user()->id,$sale->id, $market_rate->id);

        $market_rate->MarketRatesDetails()->delete();
        $market_rate->delete();

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
