<?php

namespace App\Http\Requests;

use App\Rules\MailTemplateBody;
use App\Rules\MailTemplateSubject;
use Illuminate\Foundation\Http\FormRequest;

class MailTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:255', new MailTemplateSubject],
            'body' => ['required', 'string', 'min:10', new MailTemplateBody],
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'Поле "Тема" обязательно',
            'subject.string' => 'Поле "Тема" должно быть строкой',
            'subject.max:255' => 'Поле "Тема" не может быть длиннее 255 символов',
            'body.required' => 'Поле "Текст поздравления" обязательно',
            'body.string' => 'Поле "Текст поздравления" должно быть строкой',
            'body.min' => 'Поле "Текст поздравления" не может быть короче 10 символов',
        ];
    }
}
