<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManualCongratulationRequest;
use App\Models\Employee;
use App\Models\forms\ManualCongratulationForm;
use App\Models\MailTemplate;
use App\Services\MailService;
use Illuminate\Http\Request;

class ManualCongratulationController extends Controller
{
    public function index()
    {
        $model = new ManualCongratulationForm();
        $employees = Employee::all();
        $mailTemplates = MailTemplate::all();

        return view('manual-congratulation.form', compact('model', 'employees', 'mailTemplates'));

    }
    public function send(ManualCongratulationRequest $request)
    {
        $validatedData = $request->validated();
        $employee = Employee::query()->findOrFail($validatedData['employee_id']);
        $mailTemplate = MailTemplate::query()->findOrFail($validatedData['mail_template_id']);
        $mailService = new MailService($employee, $mailTemplate, $validatedData);
        $dataForSend = $mailService->getSubstitutedData();

        // 2. Отправка письма
        dd($dataForSend);
    }
}
