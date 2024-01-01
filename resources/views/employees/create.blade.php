@php
    /** @var \Illuminate\Database\Eloquent\Collection $positions */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="go-back-button-container py-5">
            <x-back-link :route="route('employees.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="form-container flex flex-col items-center">
            <div class="section-header-container flex justify-center py-16">
                <div class="section-name">Добавление сотрудника</div>
            </div>
            <div class="add-employee-form-container">
                <form action="{{ route('employees.store') }}" method="post" class="add-employee-form flex flex-col">
                    @csrf

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="text"
                            name="first_name"
                            class="w-96 p-3"
                            placeholder="Имя"
                            value="{{ old('first_name') }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="text"
                            name="last_name"
                            class="w-96 p-3"
                            placeholder="Фамилия"
                            value="{{ old('last_name') }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="text"
                            name="patronymic"
                            class="w-96 p-3"
                            placeholder="Отчество (при наличии)"
                            value="{{ old('patronymic') }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('patronymic')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="date"
                            name="birthday"
                            class="w-96 p-3"
                            placeholder="Дата рождения"
                            value="{{ old('birthday') }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-text-input
                            type="email"
                            name="email"
                            class="w-96 p-3"
                            placeholder="Электропочта"
                            value="{{ old('email') }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <x-select-input
                            class="w-96 p-3"
                            name="position_id"
                            :isUpdate="false"
                            :options="$positions"
                        >
                        </x-select-input>
                    </div>
                    <button type="submit" class="save-add-employee-form-button m-3 w-96 p-3" id="form-button">
                        Сохранить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
