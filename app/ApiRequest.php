<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiRequest extends Model
{
    public static function ApiCall()
    {
        $endpoint = "https://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?dt=1&dc=1&cliente=35152&marca=hp&MonedaPesos=1&promos=1";
        $client = new \GuzzleHttp\Client();

        
        $requestContent = [
            'headers' => [
                'Content-type'     => 'application/x-www-form-urlencoded',
                'Accept' =>'*/*'
            ],
            
        ]; 
       $res=$client->request('GET', $endpoint, $requestContent);
       
        $xml=simplexml_load_string($res->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
        $response=json_encode($xml);

       
        return collect(json_decode($response, true)['item']);
    }

    public static function ProductbyBrand($brand)
    {
        $endpoint = "https://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?dt=1&dc=1&cliente=35152&marca=".strtolower($brand)."&MonedaPesos=1&promos=1&sucursales=1&porcentaje=".config("configurations.general.pct");
        $client = new \GuzzleHttp\Client();
        
        $requestContent = [
            'headers' => [
                'Content-type'     => 'application/x-www-form-urlencoded',
                'Accept' =>'*/*'
            ],
            
        ]; 
       $res=$client->request('GET', $endpoint, $requestContent);
       
        $xml=simplexml_load_string($res->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
        $response=json_encode($xml);

        $data=collect(json_decode($response, true));
        
        if($data->count()>0)
        {
            if (!array_key_exists("disponible", $data["item"])) {
                return $data['item'];
            }
        }
        return $data;
    }

    public static function AllBrands()
    {
        $endpoint = "http://www.grupocva.com/catalogo_clientes_xml/marcas.xml";
        $client = new \GuzzleHttp\Client();

        
        $requestContent = [
            'headers' => [
                'Content-type'     => 'application/x-www-form-urlencoded',
                'Accept' =>'*/*'
            ],
            
        ]; 
       $res=$client->request('GET', $endpoint, $requestContent);
       
        $xml=simplexml_load_string($res->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
        $response=json_encode($xml);

       
       

        return collect(json_decode($response, true)['marca']);
    }

    public static function AllCategories()
    {
        $endpoint = "http://www.grupocva.com/catalogo_clientes_xml/grupos.xml";
        $client = new \GuzzleHttp\Client();

        
        $requestContent = [
            'headers' => [
                'Content-type'     => 'application/x-www-form-urlencoded',
                'Accept' =>'*/*'
            ],
            
        ]; 
       $res=$client->request('GET', $endpoint, $requestContent);
       
        $xml=simplexml_load_string(utf8_encode($res->getBody()),'SimpleXMLElement',LIBXML_NOCDATA);
        $response=json_encode($xml);

       
       

        return collect(json_decode($response, true)['grupo']);
    }
}
