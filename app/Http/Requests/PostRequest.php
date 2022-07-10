<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return $this->user()->can('create_posts');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|unique:posts,title|max:255',
            'description'         => 'required',
            'body'         => 'required',
            'photo'         => 'required',
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
