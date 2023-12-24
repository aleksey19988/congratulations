<?php

namespace App\Console\Commands;

use App\Http\Controllers\AppController;
use App\Http\Controllers\Cron\EmailController;
use App\Models\Employee;
use App\Models\MailTemplate;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка и отправка поздравлений';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $result = [
            'success' => true,
            'count' => 0,
        ];
        $appController = new AppController();
        /** @var Collection $birthdayPeople */
        $birthdayPeople = $appController->getBirthdayEmployees(Employee::all());
        $today = Carbon::today();
        if ($birthdayPeople->count()) {
            /** @var Employee $employee */
            foreach ($birthdayPeople as $employee) {
                if (
                    !$employee->mailLog
                    || (!$today->isSameDay($employee->mailLog->created_at))
                ) {
                    $this->sendEmail($employee);
                    $result['count'] += 1;
                }
            }
        }
        $this->info(json_encode($result));
    }

    private function sendEmail(Employee $employee): void
    {
        $emailController = new EmailController();
        $emailController->send([
            'employee_id' => $employee->id,
            'mail_template_id' => MailTemplate::all()->random(1)->first()->id,
            'company_name' => 'Neovox',
        ]);
    }
}
