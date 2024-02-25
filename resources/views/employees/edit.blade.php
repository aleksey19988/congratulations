@php
    use App\Models\Employee;
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $positions */
    /** @var Employee $employee */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="py-5">
            <x-back-link :route="route('employees.show', $employee->id)" :text="'Назад'"></x-back-link>
        </div>
        <div class="flex flex-col items-center">
            <div class="flex justify-center py-16">
                <div class="text-3xl">Редактирование сотрудника {{ $employee->getFullName() }}</div>
            </div>
            <div class="">
                <form action="{{ route('employees.update', $employee->id) }}" method="post" class="flex flex-col items-center">
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
                        <x-date-input
                            type="text"
                            name="birthday"
                            class="w-96 p-3"
                            value="{{ \Carbon\Carbon::make($employee->birthday)->format('d.m.Y') }}"
                        ></x-date-input>
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

                    <button type="submit" class="m-3 w-96 p-3 bg-green-500 rounded-3xl text-xl hover:scale-105 transition-all" id="form-button">
                        Обновить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
