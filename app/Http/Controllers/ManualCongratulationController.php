<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManualCongratulationRequest;
use App\Mail\CongratulationMailer;
use App\Models\Employee;
use App\Models\forms\ManualCongratulationForm;
use App\Models\MailTemplate;
use App\Services\MailService;
use Illuminate\Support\Facades\Mail;

class ManualCongratulationController extends Controller
{
    public function index()
    {
        $model = new ManualCongratulationForm();
        $employees = Employee::all();
        $mailTemplates = MailTemplate::all();

        return view('manual-congratulation.form', compact('model', 'employees', 'mailTemplates'));

    }

    /**
     * @param ManualCongratulationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(ManualCongratulationRequest $request)
    {
        $dataForSend = $this->prepareDataForSend($request->validated());
        $this->validateDataForSend($dataForSend);

        // 2. Отправка письма
        $sendMailResult = Mail::to($dataForSend['employee'])
            ->locale('ru')
            ->send(new CongratulationMailer(
                $dataForSend['employee']->first_name,
                $dataForSend['subject'],
                $dataForSend['body']
            )
        );
        if ($sendMailResult) {
            return back()->with('message', 'Письмо успешно отправлено. Подробнее в разделе "Отправленные поздравления".');
        } else {
            return back()->with('message', 'Ошибка при отправке письма. Попробуйте снова чуть позже.');
        }
    }

    /**
     * Подготовка данных для отправки:
     * - Получение необходимых моделей
     * - Обработка данных с заменой заглушек на реальные значения
     *
     * @param array $data
     * @return array
     */
    private function prepareDataForSend($data): array
    {
        $employee = Employee::query()->findOrFail($data['employee_id']);
        $mailTemplate = MailTemplate::query()->findOrFail($data['mail_template_id']);
        $mailService = new MailService($employee, $mailTemplate, $data['company_name']);

        return array_merge(
            ['employee' => $employee],
            $mailService->getSubstitutedData()
        );
    }

    /**
     * Проверка наличия всех необходимых для отправки данных
     *
     * @param array $dataForSend
     * @return void
     */
    private function validateDataForSend(array $dataForSend): void
    {
        if (!isset($dataForSend['employee'])) {
            throw new \InvalidArgumentException('В данных для отправки отсутствуют данные о сотруднике');
        }

        if (!isset($dataForSend['subject'])) {
            throw new \InvalidArgumentException('В данных для отправки отсутствует тема письма');
        }

        if (!isset($dataForSend['body'])) {
            throw new \InvalidArgumentException('В данных для отправки отсутствует тело письма');
        }
    }
}
