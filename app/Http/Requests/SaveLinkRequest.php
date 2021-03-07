<?php

namespace App\Http\Requests;

use App\Rules\DateTimeAfterNow;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveLinkRequest extends FormRequest
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
            'url' => ['required', 'url'],
            'link' => ['nullable', Rule::unique('links'), 'regex:/^[0-9a-zA-Z_\-]+$/'],
            'expires_at.date' => ['nullable', 'date', 'after_or_equal:today'],
            'expires_at' => [new DateTimeAfterNow()],
            'is_commercial' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'Поле URL обязательно для заполнения.',
            'url.url' => 'Поле URL должно содержать корректный URL-адрес.',
            'link.unique' => 'Введенный текст для короткой ссылки уже существует.',
            'link.regex' => 'Текст для короткой ссылки может содержать только латинские буквы, цифры и символы: "-" и "_".',
            'expires_at.date.date' => 'Неверный формат введенной даты.',
            'expires_at.date.after_or_equal' => 'Введенная дата должна быть позже, чем сейчас',
        ];
    }
}
