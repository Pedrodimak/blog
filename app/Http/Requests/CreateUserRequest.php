<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the s is authorized to make this request.
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
            'name' => 'required',
            'nickname' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Necesitas ingresar tu nombre completo',
            'nickname.required' => 'Necesitas ingresar tu nombre de pila',
            'email.required' => 'Necesitas ingresar un email',
            'password.required' => 'Necesitas ingresar una contraseña'
        ];
    }
}
