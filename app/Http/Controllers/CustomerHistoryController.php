<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerHistory;
use App\PhotosReclame;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CustomerHistoryController extends Controller
{
    public function show()
    {
        $sales=Auth::user()->sale()->orderBy("date","desc")->paginate(5);
        return view('customer.pages.customer_history',compact("sales"));
    }
    public function reclame(Request $request)
    {
        $sale=Auth::user()->sale()->where("id",$request->sale)->first();
        if($sale!=null)
        {
            $sale->reclame_text=$request->get("reclame_text");
            $sale->status_reclamo="En espera";
            $sale->date_reclame=Carbon::now();
            $sale->update();
            return back()->with("sale-success",$request->sale);
        }
        else
        {
            return back();
        }
    }

    public function store(Request $request) {

        $sale=Auth::user()->sale()->where("id",$request->sale_id)->first();
        
        $this->validate(request(),[
            'photoProducto'=>'image|max:2048'
        ]);
        if($sale->photosReclame()->count()<5)
        {
            $file=request()->file('photoProducto');
            $photourl=$file->store("reclames");       
            $imageSales=PhotosReclame::create([
                'sale_id'=>$request->sale_id,
                'path'=>"/images/".(string)$photourl,
            ]);
            // $url=route('delete-Photo',$imageProduct->id);
            return response(['imageUrl'=>$imageSales->path],200);
        }
        else
        {
            return response(['imageUrl'=>null,"url"=>null],200);
        }
    }


}
