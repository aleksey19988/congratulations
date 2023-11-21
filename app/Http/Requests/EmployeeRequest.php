<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'patronymic' => ['nullable', 'string'],
            'birthday' => ['required', 'date'],
            'email' => ['required', 'email'],
            'position_id' => ['required', 'int'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Поле "Имя" обязательно',
            'first_name.string' => 'Поле "Имя" должно быть строкой',
            'first_name.max:255' => 'Поле "Имя" не может быть длиннее 255 символов',
            'last_name.required' => 'Поле "Фамилия" обязательно',
            'last_name.string' => 'Поле "Фамилия" должно быть строкой',
            'last_name.max:255' => 'Поле "Фамилия" не может быть длиннее 255 символов',
            'patronymic.string' => 'Поле "Отчество" должно быть строкой',
            'birthday.required' => 'Поле "Дата рождения" обязательно',
            'birthday.date' => 'Поле "Дата рождения" должно быть датой',
            'email.required' => 'Поле "Электропочта" обязательно',
            'position_id' => 'Поле "Должность" обязательно',
        ];
    }
}
