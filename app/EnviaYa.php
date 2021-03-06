<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class EnviaYa extends Model
{
    public function makeShipment($carrie_name, $carrier_code, $user)
    {
        $endpoint = "https://enviaya.com.mx/api/v1/shipments";
        $client = new \GuzzleHttp\Client();

        $api_key = config("configurations.api.api_key_enviaya");
        $origin=[   
                    'full_name'=> "German Leonardo Lage Suarez",
                    'company'=> config('configurations.company.name'),
                    'country_code'=> config('configurations.company.country_code'),
                    'postal_code'=> config('configurations.company.postal_code'),
                    'direction_1'=> config('configurations.company.direction_1'),
                    'city'=> config('configurations.company.city'),
                    'phone'=>config('configurations.company.phone')];

        $destination=[  'full_name'=> $user->customer->nombre." ".$user->customer->apellidos,
                        'country_code'=> "MX",
                        'postal_code'=> $user->addressActive()->cp,
                        'direction_1'=> $user->addressActive()->calle,
                        'direction_2'=> $user->addressActive()->calle2,
                        'direction_3'=> $user->addressActive()->calle3,
                        'city'=> $user->addressActive()->ciudad,
                        'phone'=> $user->customer->telefono];
        $carrier=$carrie_name;
        $carrier_service_code=$carrier_code;
        $shipment=[ 'shipment_type'=>"Package",
                    'content'=> "Productos",
                    'parcels'=>[
                            [
                            'quantity'=>"1",
                            'weight'=>"1",
                            'weight_unit'=>"kg",
                            'length'=>"5",
                            'height'=>"10",
                            'width'=>"15",
                            'dimension_unit'=>"cm"
                            ]
                        
                        ] ];
        $requestContent = [
            'headers' => [
                'Accept'     => 'application/json'
            ],
            'json' => [
                'api_key' => $api_key, 
                'origin_direction' => $origin,
                'destination_direction'=>$destination,
                'carrier'=>$carrier,
                'carrier_service_code'=>$carrier_service_code,
                'shipment'=> $shipment
                // 'debug' => true
            ]
        ]; 
       $res=$client->request('POST', $endpoint, $requestContent);
       $url_carrie="";
        if(strtolower($carrie_name)=="dhl")
        {
                $url_carrie="http://www.dhl.com.mx/es/express/rastreo.html";
        }
        else if(strtolower($carrie_name)=="fedex")
        {
                $url_carrie="https://www.fedex.com/apps/fedextrack/?action=track&cntry_code=mx";
        }
        else if(strtolower($carrie_name)=="ups")
        {
                $url_carrie="https://www.ups.com/track?loc=es_MX&requester=WT/";
        }
        else if(strtolower($carrie_name)=="redpack")
        {
            $url_carrie="http://www.redpack.com.mx/";
        }
        $response=json_decode($res->getBody());
        $response->{"carrie_url"} = $url_carrie;
        return (array) $response;
    }

    function cmp($a, $b)
    {
        return $a->total_amount-$b->total_amount;
    }
    public function getRates()
    {
        $url = "https://enviaya.com.mx/api/v1/rates";
        $client = new \GuzzleHttp\Client();

        $api_key = config('configurations.api.api_key_enviaya');
        $origin=[   'country_code'=> config('configurations.company.country_code'),
                    'postal_code'=> config('configurations.company.postal_code') ];
        $destination=[  'country_code'=> "MX",
                        'postal_code'=> Auth::user()->addressActive()->cp];
        $shipment='{ "shipment_type":"Package","parcels":[{"quantity":"1","weight":"1","weight_unit":"kg","length":"5","height":"10","width":"15","dimension_unit":"cm"}]}';
        // $res = $client->post($url, $headers, json_encode($data))->send();
        $requestContent = [
            'headers' => [
                'Accept'     => 'application/json'
            ],
            'json' => [
                'api_key' => $api_key, 
                'origin_direction' => $origin,
                'destination_direction'=>$destination,
                'shipment'=>json_decode($shipment)
                // 'debug' => true
            ]
        ];
        $res=$client->request('POST', $url, $requestContent);
        
        $resp=json_decode($res->getBody());
        $collection = collect();
        if(count($resp->dhl)>0)
        {
            usort($resp->dhl,array($this, "cmp"));
            $collection->push($resp->dhl[0]);
        }
        if(count($resp->fedex)>0)
        {
            usort($resp->fedex,array($this, "cmp"));
            $collection->push($resp->fedex[0]);
        }
        if(count($resp->ups)>0)
        {
            usort($resp->ups,array($this, "cmp"));
            $collection->push($resp->ups[0]);
        }
        if(count($resp->redpack)>0)
        {
            usort($resp->redpack,array($this, "cmp"));
            $collection->push($resp->redpack[0]);
        }
      
        return $collection;
    }
    
    public function getTracking($carrie_name, $shipment_num)
    {
        $endpoint = "https://enviaya.com.mx/api/v1/trackings";
        $client = new \GuzzleHttp\Client();

        $api_key = config("configurations.api.api_key_enviaya");
        $carrier=$carrie_name;
        $shipment_number=$shipment_num;
        $requestContent = [
            'headers' => [
                'Accept'     => 'application/json'
            ],
            'json' => [
                'api_key' => $api_key, 
                'carrier'=>$carrier,
                'shipment_number'=> $shipment_number,
            ]
        ]; 
       $res=$client->request('POST', $endpoint, $requestContent);
        return json_decode($res->getBody());
    }
}
