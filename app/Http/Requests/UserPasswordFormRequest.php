<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordFormRequest extends FormRequest
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
            'password' => 'nullable|min:8|confirmed'
        ];
    }
    public function messages()
    {
        return [
            'confirmed' => 'A mesma senha deve ser digitada nos 2 campos'
        ];
    }
}
