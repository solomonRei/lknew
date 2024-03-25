<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'password' => 'required',
            'new-password' => 'required|min:8|confirmed',
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
            'password.required' => 'Текущий пароль обязателен.',
            'new-password.required' => 'Новый пароль обязателен.',
            'new-password.min' => 'Новый пароль должен быть не менее 8 символов.',
            'new-password.confirmed' => 'Новые пароли не совпадают.',
        ];
    }
}
