@php
    /** @var \Illuminate\Database\Eloquent\Collection $positions */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <div class="section-header-container flex justify-center py-16">
            <div class="section-name">Добавление сотрудника</div>
        </div>
        <div class="add-employee-form-container">
            <form action="{{ route('employees.store') }}" method="post" class="add-employee-form flex flex-col">
                @csrf
                <input
                    type="text"
                    name="first_name"
                    class="@error('first_name') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Имя"
                    value="{{ old('first_name') }}"
                >
                @error('first_name')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <input
                    type="text"
                    name="last_name"
                    class="@error('last_name') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Фамилия"
                    value="{{ old('last_name') }}"
                >
                @error('last_name')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <input
                    type="text"
                    name="patronymic"
                    class="@error('patronymic') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Отчество (при наличии)"
                    value="{{ old('patronymic') }}"
                >
                @error('patronymic')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <input
                    type="date"
                    name="birthday"
                    class="@error('birthday') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Дата рождения"
                    value="{{ old('birthday') }}"
                >
                @error('birthday')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <input
                    type="email"
                    name="email"
                    class="@error('email') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Электропочта"
                    value="{{ old('email') }}"
                >
                @error('email')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <div class="m-3">
                    <select id="position_id" name="position_id"
                            class="input-field w-96 h-12 p-3 block border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @php /** @var \App\Models\Position $position */ @endphp
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="save-add-employee-form-button m-3 w-96 p-3"
                        id="form-button">Сохранить
                </button>
            </form>
        </div>
    </div>
@endsection
