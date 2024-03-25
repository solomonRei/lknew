<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Номер телефона обязателен к заполнению.',
            'phone.regex' => 'Введите корректный номер телефона.',
        ];
    }
}
