<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubsectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return $this->user()->can('create_subsections');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|max:255',
            'address'         => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'required'  => 'Este campo é obrigatório.',
            'max' => 'Atingiu o limite máximo de 255 caracteres.',
//            'min'         => 'Campo deve ter no mínimo :min caracteres.',
            'unique' => 'Título já cadastrado anteriormente.'
        ];
    }
}
