<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Поле Email обязательно для заполнения.',
            'email.email' => 'Email должен быть действительным адресом электронной почты.',
            'email.max' => 'Email не должен быть длиннее 255 символов.',
            'email.unique' => 'Такой Email уже используется.',
            'password.required' => 'Поле Пароль обязательно для заполнения.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];
    }
}
