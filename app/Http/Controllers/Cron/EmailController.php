<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Traits\Email\EmailsCommonUtilities;
use Illuminate\Http\RedirectResponse;

class EmailController extends Controller
{
    use EmailsCommonUtilities;

    /**
     * @param array $data
     * @return RedirectResponse
     */
    public function send(array $data)
    {
        $dataForSend = $this->prepareDataForSend($data);
        $this->validateDataForSend($dataForSend);

        // 2. Отправка письма
        return $this->sendMail($dataForSend);
    }
}
