<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'numtarjeta'=>'required|numeric|max:16|min:13|regex:/^((4[0-9]{12})|(4[0-9]{15})|(5[1-5][0-9]{14}))',
            'titular'=>'required|integer|max:100|min:3',
            'vigencia'=>'required',
            'cvc'=>'required|numeric|max:3|min:3',

        ];
    }

    /**
    * Get the error messages for the defined validation rules.
        *
    * @return array
    */
    public function messages()
    {
        return [
            //Campos vacios
            'numtarjeta.required'=>'Ingresar el número de tarjeta',
            'titular.required'=>'Ingresar el nombre del titular de la tarjeta',
            'vigencia.required'=>'Ingresar la fecha de vigencia de la tarjeta',
            'cvc.required'=>'Ingresar el código de seguridad',
            

            //Maximos y minimos
            'titular.max'=>'El nombre del titular de la tarjeta debe tener un maximo de 100 caracteres',
            
        ];
    }
    
}
