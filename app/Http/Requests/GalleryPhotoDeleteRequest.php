<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryPhotoDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('delete_galleries');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
        ];
    }
    public function messages()
    {
        return [
            'required'  => 'Este campo é obrigatório.',
//            'min'         => 'Campo deve ter no mínimo :min caracteres.',
        ];
    }
}
