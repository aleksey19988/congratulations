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
    public function index()
    {
        $positions = Position::query()->orderBy('name')->paginate(10);

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
}
