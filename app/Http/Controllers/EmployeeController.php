<?php

namespace App\Http\Controllers;

use App\Enums\SortDirection;
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
        $perPage = 50;
        $sortBy = $request->sortBy ?? '';
        $order = $request->order ?? '';
        $employees = [];

        if (
            ($sortBy && $order)
            && $this->validateRequest($sortBy, $order)
        ) {
            if ($sortBy === 'position') {
                $employees = $this->getByPositionSort($order, $perPage);
            } else {
                $employees = Employee::query()
                    ->orderBy($sortBy, $order)
                    ->paginate($perPage);
            }
        } else {
            $employees = Employee::query()->orderBy('id')->paginate($perPage);
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
        $isCreated = Employee::query()->create($validatedData)->save();

        if ($isCreated) {
            return redirect(route('employees.index'))->with('success-message', 'Сотрудник успешно добавлен');
        }

        return redirect(route('employees.index'))->with('error-message', 'Ошибка при добавлении сотрудника');
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
        $isUpdated = $employee->update($validatedData);

        if ($isUpdated) {
            return redirect(route('employees.show', $employee))->with('success-message', 'Данные успешно обновлены');
        }

        return redirect(route('employees.show'))->with('error-message', 'Ошибка при обновлении данных');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $fullName = $employee->getFullName();
        $isDeleted = $employee->delete();

        if ($isDeleted) {
            return redirect(route('employees.index'))->with('success-message', "Сотрудник $fullName успешно удалён");
        }

        return redirect(route('employees.index'))->with('error-message', "Ошибка при удалении сотрудника $fullName");
    }

    /**
     * Получение списка сотрудников, отсортированных по должности
     *
     * @param string $order
     * @param int $perPage
     * @return mixed
     */
    private function getByPositionSort(string $order, int $perPage = 50): mixed
    {
        return Employee::select('employees.*')
            ->join('positions', 'positions.id', '=', 'employees.position_id')
            ->orderBy('positions.name', $order)
            ->paginate($perPage);
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
            return $employee->$sortBy && SortDirection::tryFrom(strtoupper($order));
        }

        return false;
    }
}
