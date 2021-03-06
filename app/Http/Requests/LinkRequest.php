<?php

namespace App\Http\Requests;

use App\Rules\DateTimeAfterNow;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LinkRequest extends FormRequest
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
            'link' => [Rule::unique('links')],
            'expires_at.date' => ['nullable', 'date', 'after_or_equal:today'],
            'expires_at' => [new DateTimeAfterNow()],
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'Поле URL обязательно для заполнения.',
            'url.url' => 'Поле URL должно содержать корректный URL-адрес.',
            'link.unique' => 'Введенный текст для короткой ссылки уже существует.',
            'expires_at.date.date' => 'Неверный формат введенной даты.',
            'expires_at.date.after_or_equal' => 'Введенная дата должна быть позже, чем сейчас',
        ];
    }
}
