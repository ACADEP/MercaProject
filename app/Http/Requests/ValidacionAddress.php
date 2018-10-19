<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionAddress extends FormRequest
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
            'mainstreet'=>'required|max:100|regex:/^[\w\pL\s\-]+$/u',
            'streetsecond'=>'max:100',
            'streetthird'=>'max:100',
            'state'=>'required|max:100|regex:/^[\pL\s\-]+$/u',
            'city'=>'required|max:100|regex:/^[\pL\s\-]+$/u',
            'colony'=>'required|max:100|regex:/^[\w\pL\s\-]+$/u',
            'postalcode'=>'required|min:5|numeric|integer',
            'numinterior'=>'max:6',
            'numexterior'=>'max:5',

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
            'mainstreet.required'=>'Ingresar el nombre de la calle principal',
            'state.required'=>'Ingresar el nombre del estado',
            'city.required'=>'Ingresar el nombre de la ciudad',
            'colony.required'=>'Ingresar el nombre de la colonia, fraccionamiento, etc.',
            'postalcode.required'=>'Ingresar el Código postal',

            //Maximos y minimos
            'mainstreet.max'=> 'El nombre de la calle principal debe tener un maximo de 100 caracteres',
            'streetsecond.max'=> 'El nombre de la segunda calle debe tener un maximo de 100 caracteres',
            'streetthird.max'=> 'El nombre de la tercera calle debe tener un maximo de 100 caracteres',
            'state.max'=> 'El nombre del estado debe tener un maximo de 100 caracteres',
            'city.max'=> 'El nombre de la ciudad calle debe tener un maximo de 100 caracteres',
            'colony.max'=> 'El nombre de la colonia, fraccionamiento, etc, debe tener un maximo de 100 caracteres',
            'postalcode.min'=> 'El Código postal debe tener un minimo de 5 digitos',
            'numinterior.max'=> 'El número interior debe tener un maximo de 5 digitos',
            'numexterior.max'=> 'El número exterior debe tener un maximo de 6 digitos',

            //Numeros enteros
            'postalcode.integer'=>'El Código postal debes ser números enteros',
            'postalcode.numeric'=>'El Código postal debe ser numerico',

            //letras y numeros
            'mainstreet.regex'=> 'El nombre de la calle principal solo permite letras y numeros',
            'state.regex'=> 'El nombre del estado solo permite letras',
            'city.regex'=> 'El nombre de la ciudad solo permite letras',
            'colony.regex'=> 'El nombre de la colonia, fraccionamiento, etc, solo permite letras y numeros',

        ];
    }

}


