<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $birthdayPeople = Employee::query()
            ->where('birthday', '>=', Carbon::today()->toDateTimeString())
            ->get();

        return view('app.index', compact('birthdayPeople'));
    }
}
