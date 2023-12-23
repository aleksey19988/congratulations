<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class CongratulationController extends Controller
{
    public function send(string $employeeId)
    {
        $employee = Employee::query()->findOrFail($employeeId);
        //@todo Реализовать отправку поздравления по нажатию на "Поздравить сейчас" в списке именинников
    }
}
