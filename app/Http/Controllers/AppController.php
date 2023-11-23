<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class AppController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $employees = Employee::all();
        $birthdayPeople = $this->getBirthdayEmployees($employees);

        return view('app.index', compact('birthdayPeople'));
    }

    private function getBirthdayEmployees(Collection $employees)
    {
        $today = Carbon::today();
        return $employees->reduce(function(Collection $employees, Employee $employee) use ($today) {
            $birthday = Carbon::make($employee->birthday);
            if ($birthday->isBirthday($today)) {
                $employees->push($employee);
            }
            return $employees;
        }, collect());
    }
}
