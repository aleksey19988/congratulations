@php
    /** @var \App\Models\Employee $employee */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="py-5">
            <x-back-link :route="route('employees.index')" :text="'Назад'"></x-back-link>
        </div>
        @if(session('message'))
            <div class="info-message-container p-5 my-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        <div class="py-5">
            <div class="text-3xl font-bold">{{ $employee->getFullName() }}</div>
        </div>
        <div class="mb-16">
            <div class="">
                <div class="py-2">
                    <p class="lg:text-xl">
                        <span class="font-bold">Дата рождения:</span> {{ \Carbon\Carbon::make($employee->birthday)->locale('ru')->translatedFormat('d F Y') }}
                    </p>
                </div>
                <div class="py-2">
                    <p class="lg:text-xl">
                        <span class="font-bold">Email:</span> {{ $employee->email }}
                    </p>
                </div>
                <div class="py-2">
                    <p class="lg:text-xl">
                        <span class="font-bold">Должность:</span> {{ $employee->position->name }}
                    </p>
                </div>
                <div class="py-2">
                    <p class="lg:text-xl">
                        <span class="font-bold">Добавлен:</span> {{ \Carbon\Carbon::make($employee->created_at)->locale('ru')->translatedFormat('d F Y') }}
                    </p>
                </div>
                <div class="py-2">
                    <p class="lg:text-xl">
                        @if($employee->mailLog)
                            <span class="font-bold">Поздравляли:</span> {{ \Carbon\Carbon::make($employee->mailLog->created_at)->locale('ru')->translatedFormat('d F Y') }}
                        @else
                            <span class="font-bold">Ещё не поздравляли</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="">
                <a href="{{ route('employees.edit', $employee->id) }}" data-tooltip-target="tooltip-edit-employee-button" class="flex justify-center items-center py-1 px-5 bg-slate-700 rounded-3xl hover:scale-105 transition-all">
                    <img src="{{ asset('icons/pencil.svg') }}" alt="Редактировать профиль" class="h-5">
                </a>
                <div id="tooltip-edit-employee-button" role="tooltip" class="absolute z-10 invisible hidden xl:inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Редактировать
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            <div class="">
                <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" data-tooltip-target="tooltip-remove-employee-button" data-tooltip-placement="right">
                        <a href="" class="flex justify-center items-center py-1 px-5 ml-3 bg-red-500 rounded-3xl hover:scale-105 transition-all">
                            <img src="{{ asset('icons/delete-profile.svg') }}" alt="Удалить профиль" class="h-5">
                        </a>
                    </button>
                    <div id="tooltip-remove-employee-button" role="tooltip" class="absolute z-10 invisible hidden xl:inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Удалить
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
