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

        $api_key = '91fd302dde92bf5160e6b261b680b1c1';
        $origin=[   'company'=> "Acadep",
                    'country_code'=> "MX",
                    'postal_code'=> "23000",
                    'direction_1'=> "Allende",
                    'city'=> "La Paz",
                    'phone'=> "6121225174"];
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
        if($carrie_name=="dhl")
        {
                $url_carrie="http://www.dhl.com.mx/es/express/rastreo.html";
        }
        else if($carrie_name=="fedex")
        {
                $url_carrie="https://www.fedex.com/apps/fedextrack/?action=track&cntry_code=mx";
        }
        else if($carrie_name=="ups")
        {
                $url_carrie="https://www.ups.com/track?loc=es_MX&requester=WT/";
        }
        else if($carrie_name=="redpack")
        {
            $url_carrie="http://www.redpack.com.mx/";
        }
        $response=json_decode($res->getBody());
        $response->{"carrie_url"} = $url_carrie;
        return $response;
    }

    function cmp($a, $b)
    {
        return $a->total_amount-$b->total_amount;
    }
    public function getRates()
    {
        $url = "https://enviaya.com.mx/api/v1/rates";
        $client = new \GuzzleHttp\Client();

        $api_key = '91fd302dde92bf5160e6b261b680b1c1';
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

        $api_key = '91fd302dde92bf5160e6b261b680b1c1';
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
