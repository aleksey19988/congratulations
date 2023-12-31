@php
    use App\Models\Employee;
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $positions */
    /** @var Employee $employee */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="go-back-button-container py-5">
            <a href="{{ route('employees.show', $employee->id) }}">
                <button class="go-back-button py-1 px-5">Назад</button>
            </a>
        </div>
        <div class="form-container flex flex-col items-center">
            <div class="section-header-container flex justify-center py-16">
                <div class="section-name">Редактирование сотрудника {{ $employee->getFullName() }}</div>
            </div>
            <div class="edit-employee-form-container">
                <form action="{{ route('employees.update', $employee->id) }}" method="post" class="edit-employee-form flex flex-col">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="text"
                            name="first_name"
                            class="w-96 p-3"
                            placeholder="Имя"
                            value="{{ $employee->first_name }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="text"
                            name="last_name"
                            class="w-96 p-3"
                            placeholder="Фамилия"
                            value="{{ $employee->last_name }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="text"
                            name="patronymic"
                            class="w-96 p-3"
                            placeholder="Отчество (при наличии)"
                            value="{{ $employee->patronymic }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('patronymic')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="date"
                            name="birthday"
                            class="w-96 p-3"
                            placeholder="Дата рождения"
                            value="{{ \Carbon\Carbon::make($employee->birthday)->format('Y-m-d') }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="email"
                            name="email"
                            class="w-96 p-3"
                            placeholder="Электропочта"
                            value="{{ $employee->email }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-select-input
                            class="w-96 p-3"
                            name="position_id"
                            :isUpdate="true"
                            :options="$positions"
                            :relatedModel="$employee"
                            :propertyName="'position'"
                        >
                        </x-select-input>
                    </div>

                    <button type="submit" class="save-edit-employee-form-button m-3 w-96 p-3" id="form-button">
                        Обновить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
