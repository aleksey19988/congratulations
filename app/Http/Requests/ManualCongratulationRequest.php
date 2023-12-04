<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManualCongratulationRequest extends FormRequest
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
            'employee_id' => 'required',
            'mail_template_id' => 'required',
            'company_name' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'Поле "Сотрудник" обязательно',
            'mail_template_id.required' => 'Поле "Шаблон поздравления" обязательно',
            'company_name.required' => 'Поле "Имя компании" обязательно',
        ];
    }
}
