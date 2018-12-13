<?php

namespace App\Exports;

use App\seleHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SellerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $ids;

    public function __construct($seleIds)
    {
       
        $this->ids = $seleIds;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $itemsOrden=$this->ids;
        $seleHistories=SeleHistory::whereIn('id',explode( ", ", $this->ids))->orderByRaw(\DB::raw("FIELD(id,".$itemsOrden.")"))->get();
        $data= collect();
        foreach($seleHistories as $history)
        { $data->push([ 'Nombre del producto' =>  $history->product->product_name,
                        'Precio unt' => $history->product->price,
                        'Cliente' => $history->client,
                        'Fecha de la venta' => $history->date,
                        'Cantidad'=>$history->amount,
                        'Total'=>$history->total
                    ] );
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Nombre del producto',
            'Precio unt',
            'Cliente',
            'Fecha de la venta',
            'Cantidad',
            'Total'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
