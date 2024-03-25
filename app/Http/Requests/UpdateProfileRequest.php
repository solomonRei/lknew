<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'fullname' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'passport' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Поле имени обязательно для заполнения.',
            'fullname.string' => 'Имя должно быть строкой.',
            'fullname.max' => 'Имя не должно превышать 255 символов.',
            'city.string' => 'Город должен быть строкой.',
            'city.max' => 'Город не должен превышать 255 символов.',
            'passport.string' => 'Паспортные данные должны быть строкой.',
            'passport.max' => 'Паспортные данные не должны превышать 255 символов.',
            'email.email' => 'Поле email должно содержать корректный электронный адрес.',
            'email.max' => 'Email не должен превышать 255 символов.',
        ];
    }

}
