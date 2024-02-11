@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="py-5">
            <x-back-link :route="route('administrative.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="flex flex-col items-center py-16">
            <div class="text-3xl">Сотрудники</div>
            <a href="{{ route('employees.create') }}" class="py-1 flex justify-center w-9/12 lg:w-4/12 mt-3 bg-green-500 rounded-3xl text-xl hover:scale-105 transition-all">Добавить сотрудника</a>
        </div>
        @if(session('message'))
            <div class="w-full p-5 bg-green-500 rounded-3xl">
                <span class="text-xl">{{session('message')}}</span>
            </div>
        @endif
        @if($employees->count())
            {{ $employees->links('vendor.pagination.tailwind') }}
            <div class="">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-7 py-3 my-3 bg-white dark:bg-slate-700 rounded-3xl text-2xl">
                    <div class="col-span-1 lg:col-span-2 flex items-center justify-center">
                        <span class="text-xl font-bold">
                            @if(request()->get('sortBy') === 'last_name')
                                @if(request()->get('order') === 'asc')
                                    <a href="{{ route('employees.index', ['sortBy' => 'last_name', 'order' => 'desc', 'page' => request()->page ?? 1]) }}">Полное имя</a>
                                    <img src="{{ asset('icons/asc-sort.svg') }}" alt="По возрастанию" class="hidden dark:inline h-5">
                                    <img src="{{ asset('icons/asc-sort-dark.svg') }}" alt="По возрастанию" class="inline dark:hidden h-5">
                                @elseif(request()->get('order') === 'desc')
                                    <a href="{{ route('employees.index', ['sortBy' => 'last_name', 'order' => 'asc', 'page' => request()->page ?? 1]) }}">Полное имя</a>
                                    <img src="{{ asset('icons/desc-sort.svg') }}" alt="По убыванию" class="hidden dark:inline h-5">
                                    <img src="{{ asset('icons/desc-sort-dark.svg') }}" alt="По убыванию" class="inline dark:hidden h-5">
                                @else
                                    <a href="{{ route('employees.index', ['sortBy' => 'last_name', 'order' => 'desc']) }}">Полное имя</a>
                                @endif
                            @else
                                <a href="{{ route('employees.index', ['sortBy' => 'last_name', 'order' => 'desc']) }}">Полное имя</a>
                            @endif
                        </span>
                    </div>
                    <div class="col-span-1 hidden md:flex md:items-center md:justify-center">
                        <span class="text-xl font-bold">Должность</span>
                    </div>
                    <div class="col-span-1 hidden lg:flex lg:items-center lg:justify-center">
                        <span class="text-xl font-bold">
                            @if(request()->get('sortBy') === 'birthday')
                                @if(request()->get('order') === 'asc')
                                    <a href="{{ route('employees.index', ['sortBy' => 'birthday', 'order' => 'desc', 'page' => request()->page ?? 1]) }}">Дата рождения</a>
                                    <img src="{{ asset('icons/asc-sort.svg') }}" alt="По возрастанию" class="hidden dark:inline h-5">
                                    <img src="{{ asset('icons/asc-sort-dark.svg') }}" alt="По возрастанию" class="inline dark:hidden h-5">
                                @elseif(request()->get('order') === 'desc')
                                    <a href="{{ route('employees.index', ['sortBy' => 'birthday', 'order' => 'asc', 'page' => request()->page ?? 1]) }}">Дата рождения</a>
                                    <img src="{{ asset('icons/desc-sort.svg') }}" alt="По убыванию" class="hidden dark:inline h-5">
                                    <img src="{{ asset('icons/desc-sort-dark.svg') }}" alt="По убыванию" class="inline dark:hidden h-5">
                                @else
                                    <a href="{{ route('employees.index', ['sortBy' => 'birthday', 'order' => 'desc']) }}">Дата рождения</a>
                                @endif
                            @else
                                <a href="{{ route('employees.index', ['sortBy' => 'birthday', 'order' => 'desc']) }}">Дата рождения</a>
                            @endif
                        </span>
                    </div>
                    <div class="col-span-2 hidden lg:flex lg:flex-col lg:items-center lg:justify-center">
                        <span class="text-xl font-bold">Когда поздравили</span>
                    </div>
                    <div class="flex items-center justify-evenly">
                        <span class="text-xl font-bold">Действия</span>
                    </div>
                </div>
                    <?php /** @var \App\Models\Employee $employee */ ?>
                @foreach($employees as $employee)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-7 p-3 my-3 bg-white dark:bg-slate-700 rounded-3xl text-xl">
                        <div class="col-span-1 lg:col-span-2 flex items-center justify-center">
                            <span class="">{{ $employee->getFullName() }}</span>
                        </div>
                        <div class="col-span-1 hidden md:flex md:items-center md:justify-center">
                            <span class="">{{ $employee->position?->name ?: '-' }}</span>
                        </div>
                        <div class="col-span-1 hidden lg:flex lg:items-center lg:justify-center">
                            <span class="">{{ \Carbon\Carbon::make($employee->birthday)->translatedFormat('d.m.Y') }}</span>
                        </div>
                        <div class="col-span-2 hidden lg:flex lg:flex-col lg:items-center lg:justify-center">
                            @if($employee->mailLog)
                                <div class="text-center">
                                    Поздравили <span class="">{{ \Carbon\Carbon::make($employee->mailLog->created_at)->format('d.m.Y в H:i') }}</span>
                                </div>
                                <a href="{{ route('mail-log.index') }}" class="text-center mt-2 py-1 w-3/5 bg-green-500 rounded-3xl hover:scale-105 transition-all">
                                    Подробнее
                                </a>
                            @else
                                <div class="">
                                    <span class="text-red-500">Никогда</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center justify-evenly">
                            <a href="{{ route('employees.show', $employee->id) }}"
                               data-tooltip-target="tooltip-employee-profile-button-{{ $loop->index }}"
                               class="flex justify-center items-center w-2/5 p-1 py-2 bg-slate-700 dark:bg-slate-950 rounded-3xl hover:scale-105 transition-all">
                                <img src="{{ asset('icons/profile.svg') }}" alt="" class="h-5">
                            </a>
                            <div id="tooltip-employee-profile-button-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible hidden xl:inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Подробнее
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="post" class="flex items-center justify-center w-2/5">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full hover:scale-105 transition-all" data-tooltip-target="tooltip-remove-employee-button-{{ $loop->index }}">
                                    <a href="" class="flex justify-center items-center py-2 bg-red-500 rounded-3xl">
                                        <img src="{{ asset('icons/delete-profile.svg') }}" alt="Удалить профиль" class="h-5">
                                    </a>
                                </button>
                                <div id="tooltip-remove-employee-button-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible hidden xl:inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Удалить
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="w-full flex justify-center">
                <p class="text-xl">Пока никого нет &#128532;</p>
            </div>
        @endif
    </div>
@endsection
