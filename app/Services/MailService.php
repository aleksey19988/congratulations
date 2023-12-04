<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\MailTemplate;

class MailService
{
    private const EMPLOYEE_NAME_PLUG = '[именинник]';
    private const COMPANY_NAME_PLUG = '[имя компании]';

    private Employee $employee;
    private MailTemplate $mailTemplate;
    private string $companyName;
    public function __construct(Employee $employee, MailTemplate $mailTemplate, array $validatedData)
    {
        $this->employee = $employee;
        $this->mailTemplate = $mailTemplate;

        isset($validatedData['employee_id'])
            ? $this->employee = Employee::query()->findOrFail($validatedData['employee_id'])
            : throw new \InvalidArgumentException('Не передан id шаблона поздравления');

        isset($validatedData['mail_template_id'])
            ? $this->mailTemplate = MailTemplate::findOrFail($validatedData['mail_template_id'])
            : throw new \InvalidArgumentException('Не передан id шаблона поздравления');

        isset($validatedData['company_name'])
            ? $this->companyName = $validatedData['company_name']
            : throw new \InvalidArgumentException('Не передан id шаблона поздравления');
    }

    public function getSubstitutedData(): array
    {
        return $this->replacePlugs();
    }

    private function replacePlugs(): array
    {
        $mailBodyWithCompanyName = str_replace(self::COMPANY_NAME_PLUG, $this->companyName, $this->mailTemplate->body);

        return [
            'subject' => str_replace(self::EMPLOYEE_NAME_PLUG, $this->employee->first_name, $this->mailTemplate->subject),
            'body' => str_replace(self::EMPLOYEE_NAME_PLUG, $this->employee->first_name, $mailBodyWithCompanyName),
        ];
    }
}
