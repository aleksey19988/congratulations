<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\MailTemplate;

class MailService
{
    public const EMPLOYEE_NAME_PLUG = '[именинник]';
    public const COMPANY_NAME_PLUG = '[имя компании]';

    private Employee $employee;
    private MailTemplate $mailTemplate;
    private string $companyName;
    public function __construct(Employee $employee, MailTemplate $mailTemplate, string $companyName)
    {
        $this->employee = $employee;
        $this->mailTemplate = $mailTemplate;
        $this->companyName = $companyName;
    }

    /**
     * Получение темы и тела письма с реальными данными для отправки
     *
     * @return array
     */
    public function getSubstitutedData(): array
    {
        return array_merge($this->replacePlugs(), ['mailTemplate' => $this->mailTemplate]);
    }

    /**
     * Замена заглушек из шаблона на реальные значения
     *
     * @return array
     */
    private function replacePlugs(): array
    {
        $mailBodyWithCompanyName = str_replace(self::COMPANY_NAME_PLUG, $this->companyName, $this->mailTemplate->body);

        return [
            'subject' => str_replace(self::EMPLOYEE_NAME_PLUG, $this->employee->first_name, $this->mailTemplate->subject),
            'body' => str_replace(self::EMPLOYEE_NAME_PLUG, $this->employee->first_name, $mailBodyWithCompanyName),
        ];
    }
}
