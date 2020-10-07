<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientAdminRequest extends FormRequest
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
            "firstname"=>"required",
            "phone"=>"required|numeric",
            "email"=>"required",
           
        ];
    }

    public function messages()
    {
        return [
            "firstname.required"=>"Ingrese un nombre",
            "phone.required"=>"Ingresar un número de teléfono",
            "email.required"=>"Ingresa un correo electroníco",

            "phone.numeric"=>"Ingresa el teléfono en digítos",

        ];
    }
}
