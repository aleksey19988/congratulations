<?php

namespace App\Rules;

use App\Services\MailService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class MailTemplateSubject implements ValidationRule
{
    /**
     * Проверка на содержание в поле "Тема письма" текста-заглушки, чтобы поздравление было универсальным
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!str_contains($value, MailService::EMPLOYEE_NAME_PLUG)) {
            $fail("Поле 'Тема' обязательно должно содержать текст '" . MailService::EMPLOYEE_NAME_PLUG . "'");
        }
    }
}
