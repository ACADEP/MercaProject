<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateProducts extends FormRequest
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
            'product_name'=>'required|max:75|min:3|regex:/^[\pL\s\-]+$/u',
            'product_qty'=>'required|integer|max:999|min:1',
            'product_sku'=>'required|integer|min:1|max:9999999',
            'product_price'=>'required|numeric|between:0,9999999999999.99',
            'product_reduced'=>'max:20||min:1',
            'categoria'=>'required|not_in:-1',
            'marca'=>'required|not_in:-1',
            'product_des'=>'required|max:250|min:10',
            'product_spec'=>'required|max:250|min:10',


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
            'product_name.required'=>'Ingresar el nombre del producto',
            'product_qty.required'=>'Ingresar la cantidad del producto',
            'product_sku.required'=>'Ingresar el codigo sku del producto',
            'product_price.required'=>'Ingresar el precio del producto',
            'categoria.required'=>'Ingresar la categoria del producto',
            'categoria.not_in'=>'Ingresar la categoria del producto',
            'marca.required'=>'Ingresar la marca del producto',
            'marca.not_in'=>'Ingresar la marca del producto',
            'product_des.required'=>'Ingresar la descripción del producto',
            'product_spec.required'=>'Ingresar las especificacones del producto',

            //Maximos y minimos
            'product_name.max'=>'El nombre de producto debe tener un maximo de 75 caracteres',
            'product_qty.max'=>'La cantidad debe tener un maximo de 2 digitos',
            'product_sku.max'=> 'El SKU debe tener un maximo de 7 digitos',
            'product_price.max'=>'El precio debe tener un maximo de 9 digitos',
            'reduced_price.max'=>'El descuento debe tener un maximo de 9 digitos',
            'product_des.max'=>'La descripcion debe tener un maximo de 2500 caracteres',
            'product_spec.max'=>'Las especificaciones debe tener un maximo de 2500 caracteres',
            'product_qty.max'=>'La cantidad maxima es de 999',
            'product_sku.min'=> 'El SKU debe tener un minimo de 3 digitos',

            //Numeros enteros
            'product_qty.integer'=>'La cantidad debe ser numero entero',
            'product_price.numeric'=>'El precio debe ser numerico',
            'product_sku.integer'=>'El codigo SKU debe ser numerico',


            //letras y numeros
            'product_name.regex'=> 'El nombre del producto solo permite letras y numeros',
            
        ];
    }
    
}
