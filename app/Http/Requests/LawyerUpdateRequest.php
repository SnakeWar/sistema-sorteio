<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LawyerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return $this->user()->can('update_lawyers');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required',
            'subscription'         => 'required|max:255',
            'telephone'         => 'max:255',
            'cep'         => 'max:255',
            'address'         => 'max:255',
            'district'         => 'max:255',
            'city'         => 'max:255',
            'state'         => 'max:255',
        ];
    }
    public function messages()
    {
        return [
            'required'  => 'Este campo é obrigatório.',
            'max' => 'Atingiu o limite máximo de 255 caracteres.',
//            'min'         => 'Campo deve ter no mínimo :min caracteres.',
        ];
    }
}
