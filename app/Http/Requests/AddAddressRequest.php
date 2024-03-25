<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAddressRequest extends FormRequest
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
            'delivery-country' => 'required|string|max:255',
            'delivery-city' => 'required|string|max:255',
            'delivery-street' => 'required|string|max:255',
            'delivery-building' => 'required|string|max:255',
            'delivery-apartment' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'delivery-country.required' => 'Страна обязательна к заполнению.',
            'delivery-city.required' => 'Город обязателен к заполнению.',
            'delivery-street.required' => 'Улица обязательна к заполнению.',
            'delivery-building.required' => 'Корпус/дом обязателен к заполнению.',
            'delivery-apartment.nullable' => 'Квартира/офис не обязателен к заполнению.',
        ];
    }
}
