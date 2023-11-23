<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class CongratulationController extends Controller
{
    private int $employeeId;

    public function __construct(string $employeeId)
    {
        $this->employeeId = (int)$employeeId;
    }

    public function send()
    {
        $employee = Employee::query()->findOrFail($this->employeeId);
    }
}
