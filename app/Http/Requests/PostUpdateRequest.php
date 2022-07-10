<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return $this->user()->can('update_posts');
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
            'description'         => 'required',
            'body'         => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required'  => 'Este campo é obrigatório.',
            'max'  => 'Máximo de 255 caracteres antigido!',
//            'min'         => 'Campo deve ter no mínimo :min caracteres.',
        ];
    }
}
