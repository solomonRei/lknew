<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderItemRequest extends FormRequest
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
            'link' => 'required|url',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'is_photo_report' => 'nullable|boolean',
            'is_measure' => 'nullable|boolean',
            'is_lathing' => 'nullable|boolean',
            'is_bubble_wrap' => 'nullable|boolean',
            'is_comment' => 'nullable|boolean',
            'comment' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'link.required' => 'Ссылка на товар обязательна для заполнения.',
            'link.url' => 'Ссылка должна быть валидным URL.',
            'name.required' => 'Название позиции обязательно для заполнения.',
            'price.required' => 'Цена обязательна для заполнения.',
            'price.numeric' => 'Цена должна быть числом.',
            'quantity.required' => 'Количество обязательно для заполнения.',
            'quantity.integer' => 'Количество должно быть целым числом.',
            'file.nullable' => 'Загрузка файла не обязательна.',
            'file.file' => 'Необходимо загрузить файл.',
            'file.mimes' => 'Файл должен быть одного из следующих типов: jpg, jpeg, png, bmp, gif, svg.',
            'file.max' => 'Максимальный размер файла не должен превышать 2048 килобайт.',
        ];
    }
}
