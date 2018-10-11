<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class EnviaYa extends Model
{
    public function makeShipment($carrie_name, $carrier_code)
    {
        $endpoint = "https://enviaya.com.mx/api/v1/shipments";
        $client = new \GuzzleHttp\Client();

        $api_key = 'c3704460afdf5f0a6e53b71c48a2f736';
        $origin=[   'company'=> "Acadep",
                    'country_code'=> "MX",
                    'postal_code'=> "23000",
                    'direction_1'=> "Allende",
                    'city'=> "La Paz",
                    'phone'=> "6121225174"];
        $destination=[  'full_name'=> Auth::user()->customer->nombre." ".Auth::user()->customer->apellidos,
                        'country_code'=> "MX",
                        'postal_code'=> Auth::user()->addressActive()->cp,
                        'direction_1'=> Auth::user()->addressActive()->calle,
                        'direction_2'=> Auth::user()->addressActive()->calle2,
                        'direction_3'=> Auth::user()->addressActive()->calle3,
                        'city'=> Auth::user()->addressActive()->ciudad,
                        'phone'=> Auth::user()->customer->telefono];
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
       
        return json_decode($res->getBody());
    }

    public function getRates()
    {
        $url = "https://enviaya.com.mx/api/v1/rates";
        $client = new \GuzzleHttp\Client();

        $api_key = 'c3704460afdf5f0a6e53b71c48a2f736';
        $origin=[   'country_code'=> "MX",
                    'postal_code'=> "23000" ];
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
        
        dd(json_decode($res->getBody()));
        return $res->getStatusCode();
    }
}
