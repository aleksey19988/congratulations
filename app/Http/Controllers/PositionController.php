<?php

namespace App\Http\Controllers;

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
        $sortBy = $request->sortBy ?? '';
        $order = $request->order ?? '';
        $positions = [];

        if (
            ($sortBy && $order)
            && $this->validateRequest($sortBy, $order)
        ) {
            if ($sortBy === 'position') {
                $employees = $this->getByPositionSort($order);
            } else {
                $positions = Position::query()
                    ->orderBy($sortBy, $order)
                    ->paginate(50);
            }
        } else {
            $positions = Position::query()->orderBy('name')->paginate(50);
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
        Position::query()->create($validatedData)->save();

        return redirect(route('positions.index'))->with('message', 'Должность успешно добавлена.');
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
        $position->update($validatedData);

        return redirect(route('positions.show', $position))->with('message', 'Данные успешно обновлены.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $name = $position->name;
        $position->delete();

        return redirect(route('positions.index'))->with('message', "Должность '$name' успешно удалена.");
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
            return $position->$sortBy && in_array(strtoupper($order), ['ASC', 'DESC']);
        }

        return false;

    }
}
