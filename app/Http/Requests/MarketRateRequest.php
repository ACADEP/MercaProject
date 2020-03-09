<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarketRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company'   =>'required',
            'client'    =>'required',
            'address'   =>'required',
            'contact'   =>'required',
            'phone'     =>'required',
            'email'     =>'required|email',
            'marketRate'=>'required'
        ];
        
    }

    public function messages()
    {
        return [
            'company.required'=>'Ingresar el nombre de la empresa',
            'client.required'=>'Ingresar el nombre del cliente',
            'address.required'=>'Ingresar la dirección',
            'contact.required'=>'Ingresar el contacto',
            'phone.required'=>'Ingresar el teléfono',
            'email.required'=>'Ingresar un email a enviar',
            'marketRate.required'=>'Agregar productos para crear la cotización'
        ];
    }
}
