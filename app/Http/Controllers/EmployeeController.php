<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Contracts\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::query()->paginate(10);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();

        return view('employees.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validatedData = $request->validated();
        Employee::query()->create($validatedData)->save();

        return redirect(route('employees.index'))->with('message', 'Сотрудник успешно добавлен.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee): View
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $positions = Position::all();

        return view('employees.edit', compact('positions', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmployeeRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $employee = Employee::query()->findOrFail($id);
        $employee->update($validatedData);

        return redirect(route('employees.show', compact('employee')))->with('message', 'Данные успешно обновлены.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $fullName = $employee->getFullName();
        $employee->delete();

        return redirect(route('employees.index'))->with('message', "Сотрудник $fullName успешно удалён.");
    }
}
