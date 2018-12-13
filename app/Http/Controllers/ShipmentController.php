<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shippo;

class ShipmentController extends Controller
{
    public function test()
    {
        $shipment = \Shippo_Shipment::all();
        dd($shipment);
        $fromAddress = array(
            'name' => 'Shawn Ip',
            'street1' => '215 Clayton St.',
            'city' => 'San Francisco',
            'state' => 'CA',
            'zip' => '94117',
            'country' => 'MX'
        );
        
        $toAddress = array(
            'name' => 'Mr Hippo"',
            'street1' => 'San David',
            'city' => 'La Paz',
            'state' => 'CA',
            'zip' => '23000',
            'country' => 'MX',
            'phone' => '+1 555 341 9393'
        );
        $parcel = array(
            'length'=> '5',
            'width'=> '5',
            'height'=> '5',
            'distance_unit'=> 'in',
            'weight'=> '2',
            'mass_unit'=> 'lb',
        );
        
        $shipment = \Shippo_Shipment::create( array(
            'address_from'=> $fromAddress,
            'address_to'=> $toAddress,
            'parcels'=> array($parcel),
            'async'=> false
            )
        );

        dd($shipment);
    }
}
