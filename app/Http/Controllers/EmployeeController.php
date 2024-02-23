<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->sortBy ?? '';
        $order = $request->order ?? '';
        $employees = [];

        if (
            ($sortBy && $order)
            && $this->validateRequest($sortBy, $order)
        ) {
            if ($sortBy === 'position') {
                $employees = $this->getByPositionSort($order);
            } else {
                $employees = Employee::query()
                    ->orderBy($sortBy, $order)
                    ->paginate(50);
            }
        } else {
            $employees = Employee::query()->orderBy('id')->paginate(50);
        }

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
    public function store(EmployeeRequest $request)
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
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $validatedData = $request->validated();
        $employee->update($validatedData);

        return redirect(route('employees.show', $employee))->with('message', 'Данные успешно обновлены.');
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

    /**
     * Получение списка сотрудников, отсортированных по должности
     *
     * @param string $order
     * @return mixed
     */
    private function getByPositionSort(string $order): mixed
    {
        return Employee::select('employees.*')
            ->join('positions', 'positions.id', '=', 'employees.position_id')
            ->orderBy('positions.name', $order)
            ->paginate(50);
    }

    /**
     * Проверка на существование переданных для сортировки имени поля в таблице и направления сортировки
     *
     * @param string $sortBy
     * @param string $order
     * @return bool
     */
    private function validateRequest(string $sortBy, string $order): bool
    {
        $employee = Employee::query()->first();

        if ($employee) {
            return $employee->$sortBy && in_array(strtoupper($order), ['ASC', 'DESC']);
        }

        return false;
    }
}
