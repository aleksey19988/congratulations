<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManualCongratulationRequest;
use App\Models\Employee;
use App\Models\forms\ManualCongratulationForm;
use App\Models\MailTemplate;
use App\Traits\Email\EmailsCommonUtilities;
use Illuminate\Http\RedirectResponse;

class ManualCongratulationController extends Controller
{
    use EmailsCommonUtilities;

    public function index()
    {
        $model = new ManualCongratulationForm();
        $employees = Employee::all();
        $mailTemplates = MailTemplate::all();

        return view('manual-congratulation.form', compact('model', 'employees', 'mailTemplates'));
    }

    /**
     * @param ManualCongratulationRequest $request
     * @return RedirectResponse
     */
    public function send(ManualCongratulationRequest $request)
    {
        $dataForSend = $this->prepareDataForSend($request->validated());
        $this->validateDataForSend($dataForSend);

        // 2. Отправка письма
        return $this->sendMail($dataForSend);
    }
}
