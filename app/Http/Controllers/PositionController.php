<?php

namespace App\Http\Controllers;

use App\Enums\SortDirection;
use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 50;
        $sortBy = $request->sortBy ?? '';
        $order = $request->order ?? '';
        $positions = [];

        if (
            ($sortBy && $order)
            && $this->validateRequest($sortBy, $order)
        ) {
            $positions = Position::query()
                ->orderBy($sortBy, $order)
                ->paginate($perPage);
        } else {
            $positions = Position::query()->orderBy('name')->paginate($perPage);
        }

        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionRequest $request)
    {
        $validatedData = $request->validated();
        $isCreated = Position::query()->create($validatedData)->save();

        if ($isCreated) {
            return redirect(route('positions.index'))->with('success-message', 'Должность успешно добавлена');
        }

        return redirect(route('positions.index'))->with('error-message', 'Ошибка при добавлении должности');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionRequest $request, Position $position)
    {
        $validatedData = $request->validated();
        $isUpdated = $position->update($validatedData);

        if ($isUpdated) {
            return redirect(route('positions.show', $position))->with('success-message', 'Должность успешно обновлена');
        }

        return redirect(route('positions.show', $position))->with('error-message', 'Ошибка при обновлении должности');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $name = $position->name;
        $isDeleted = $position->delete();

        if ($isDeleted) {
            return redirect(route('positions.index'))->with('success-message', "Должность '$name' успешно удалена");
        }

        return redirect(route('positions.index'))->with('error-message', "Ошибка при удалении должности '$name'");
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
        $position = Position::query()->first();

        if ($position) {
            return $position->$sortBy && SortDirection::tryFrom(strtoupper($order));
        }

        return false;

    }
}
