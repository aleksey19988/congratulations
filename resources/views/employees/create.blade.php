@php
    /** @var \Illuminate\Database\Eloquent\Collection $positions */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="py-5">
            <x-back-link :route="route('employees.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="form-container flex flex-col items-center">
            <div class="flex justify-center py-16">
                <div class="text-3xl">Добавление сотрудника</div>
            </div>
            <div class="">
                <form action="{{ route('employees.store') }}" method="post" class="flex flex-col items-center">
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

                    <div class="mb-3 justify-center flex-col hidden" id="js-desktop-date-input-container">
                        <x-date-input
                            type="text"
                            name="birthday"
                            class="w-96 p-3"
                            value="{{ old('birthday') }}"
                        ></x-date-input>
                        <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                    </div>

                    <div class="mb-3 justify-center flex-col hidden" id="js-mobile-date-input-container">
                        <x-text-input
                            type="text"
                            name="birthday"
                            class="w-96 p-3"
                            placeholder="Дата рождения"
                            onfocus="(this.type='date')"
                            onblur="if(this.value==''){this.type='text'}"
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
                    <button type="submit" class="m-3 w-96 p-3 bg-green-500 rounded-3xl text-xl hover:scale-105 transition-all" id="form-button">
                        Сохранить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
