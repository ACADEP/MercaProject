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
            //Obtener productos disponibles
            if (!array_key_exists("disponible", $data["item"])) {
                return $data['item'];
            }

            //
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

    //Checar precio antes de compra
    public static function checkPrice($product_sku)
    {
        $endpoint = "https://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?dt=1&dc=1&cliente=35152&clave=".$product_sku."&marca=%25&MonedaPesos=1&promos=1&sucursales=1&porcentaje=".config("configurations.general.pct");
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
        
       
        $product=null;
        
       
        if($data->count()>0)
        {
            $dataArray=$data["item"];
           
            if (array_key_exists("disponible", $dataArray)) {
                $inventario=$dataArray['disponible']+$dataArray['VENTAS_GUADALAJARA'];
                
                if($inventario > 0)
                {
                    $product=$dataArray;
                }
            }
        }

        $price_checked=0;

        if($product)
        {
            $price_checked=$product['precio'];
                        
            if(!$product['PrecioDescuento']=='Sin Descuento') //Condicion para ingresar si existe descuento
            {
                $price_checked=$product['PrecioDescuento'];
            }
        }

        // dd($price_checked);
        return $price_checked;
    }

        //Checar producto en el api al agregar al carrito
        public static function checkProductFromApi($request)
        {
           
            $productInfo=Product::find($request->product_id); //Obtener el producto

            $endpoint = "https://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?dt=1&dc=1&cliente=35152&clave=".$productInfo->product_sku."&marca=%25&MonedaPesos=1&promos=1&sucursales=1&porcentaje=".config("configurations.general.pct");
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
           
            $product=null;
           
            if($data->count()>0) //Checar contenido obtenido del api
            {
                $dataArray=$data["item"];
               
                if (array_key_exists("disponible", $dataArray)) {
                    $inventario=$dataArray['disponible']+$dataArray['VENTAS_GUADALAJARA'];
                    
                    if($inventario > 0)
                    {
                        $product=$dataArray;
                    }
                }
            }
    
            $price_checked=false; //Producto disponible para agregar al carrito
    
            if($product)
            {
                $productInfo->price=$product['precio'];
                
                $price_checked=true;
                            
                if(!$product['PrecioDescuento']=='Sin Descuento') //Condicion para ingresar si existe descuento
                {
                    $productInfo->reduced_price=$product['PrecioDescuento'];
                    $productInfo->featured=1;
                
                }
                
                $productInfo->save();
            }
    
            return $price_checked;
        }
}
