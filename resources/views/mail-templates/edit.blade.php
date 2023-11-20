@php
    use App\Models\Employee;
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $positions */
    /** @var Employee $employee */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <div class="section-header-container flex justify-center py-16">
            <div class="section-name">Редактирование сотрудника {{ $employee->getFullName() }}</div>
        </div>
        <div class="edit-employee-form-container">
            <form action="{{ route('employees.update', $employee->id) }}" method="post" class="edit-employee-form flex flex-col">
                @csrf
                @method('PATCH')
                <input
                    type="text"
                    name="first_name"
                    class="@error('first_name') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Имя"
                    value="{{ $employee->first_name }}"
                >
                @error('first_name')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <input
                    type="text"
                    name="last_name"
                    class="@error('last_name') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Фамилия"
                    value="{{ $employee->last_name }}"
                >
                @error('last_name')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <input
                    type="text"
                    name="patronymic"
                    class="@error('patronymic') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Отчество (при наличии)"
                    value="{{ $employee->patronymic }}"
                >
                @error('patronymic')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <input
                    type="date"
                    name="birthday"
                    class="@error('birthday') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Дата рождения"
                    value="{{ \Carbon\Carbon::make($employee->birthday)->format('Y-m-d') }}"
                >
                @error('birthday')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <input
                    type="email"
                    name="email"
                    class="@error('email') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                    placeholder="Электропочта"
                    value="{{ $employee->email }}"
                >
                @error('email')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <div class="m-3">
                    <select id="position_id" name="position_id"
                            class="input-field w-96 h-12 p-3 block border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @php /** @var \App\Models\Position $position */ @endphp
                        @foreach($positions as $position)
                            <option
                                value="{{ $position->id }}"
                                {{ $employee->position->id === $position->id ? 'selected' : '' }}
                            >{{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="save-edit-employee-form-button m-3 w-96 p-3"
                        id="form-button">Обновить
                </button>
            </form>
        </div>
    </div>
@endsection
