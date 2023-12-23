<?php

namespace App\Rules;

use App\Services\MailService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class MailTemplateBody implements ValidationRule
{
    /**
     * Проверка на содержание в поле "Тело письма" текста-заглушки, чтобы поздравление было универсальным
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!str_contains($value, MailService::COMPANY_NAME_PLUG)) {
            $fail("Поле 'Текст поздравления' обязательно должно содержать текст '" . MailService::COMPANY_NAME_PLUG . "'");
        }
    }
}
