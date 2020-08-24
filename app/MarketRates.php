<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketRates extends Model
{
    protected $fillable = [ 'company','client','contact','address','phone','email','date', "pdf_info"];
    
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, "client")->withTrashed();
    }

    public function MarketRatesDetails()
    {
        return $this->hasMany(MarketRatesDetail::class);
    }

    public function productRepeat($id)
    {
        $band=false;
        $details = $this->MarketRatesDetails()->get();
        foreach($details as $detail)
        {
            if($detail->product_id==$id)
            {
                $band=true;
            }
        }
        return $band;
    }

    public function getTotalWithIvaAttribute()
    {
        $iva=$this->total*0.16;
        return $this->total+$iva;
    }

    //Configuracion del pdf

    //Tiempo de entrega
    public function getTimedeliveryAttribute()
    {
        $result="5 días hábiles después del finiquito";
    
        if($this->pdf_info)
        {
            $data=json_decode($this->pdf_info, true);
            if($data["timedelivery"] != "")
            {
                $result=$data["timedelivery"];
            }
        }

        return $result;
    }

    //Condiciones
    public function getConditionsAttribute()
    {
        $result="100% a la orden";
    
        if($this->pdf_info)
        {
            $data=json_decode($this->pdf_info, true);
            if($data["conditions"] != "")
            {
                $result=$data["conditions"];
            }
        }

        return $result;
    }

    //Notas
    public function getNotesAttribute()
    {
        $result=[
            "1.- Esta cotización está sujeta a número de piezas en existencia y/o vigencia de promoción.",
            "2.- Esta cotización está sujeta a cambio de precio.",
            "3.-Lo que no se especifica en esta cotización tiene un costo adicional."
        ];
    
        if($this->pdf_info)
        {
            $data=json_decode($this->pdf_info, true);

            $i=0;
            foreach ($data["notas"] as $value) 
            {
                if($value!="")
                {
                    $result[$i]=$value;
                }
                $i++;
            }
        }
       
        return $result;
    }
}
