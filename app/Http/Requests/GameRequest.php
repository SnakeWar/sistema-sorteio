<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
//        return $this->user()->can('create_games');
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
            'games'         => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required'  => 'Este campo é obrigatório.',
            'max'  => 'Máximo de 255 caracteres antigido!',
//            'min'         => 'Campo deve ter no mínimo :min caracteres.',
            'unique' => 'Título já cadastrado anteriormente.'
        ];
    }
}
