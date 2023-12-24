<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CronController extends Controller
{
    public function sendEmails(): string
    {
        Artisan::call('app:send-emails');

        return Artisan::output();
    }
}
