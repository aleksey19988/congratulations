@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="go-back-button-container py-5">
            <x-back-link :route="route('administrative.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="section-header-container flex flex-col items-center py-16">
            <div class="text-3xl">Сотрудники</div>
            <a href="{{ route('employees.create') }}" class="py-1 flex justify-center w-9/12 lg:w-4/12 mt-3 bg-green-500 rounded-3xl text-xl lg:text-2xl hover:scale-105 transition-all">Добавить сотрудника</a>
        </div>
        @if(session('message'))
            <div class="info-message-container p-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        @if($employees->count())
            {{ $employees->links('vendor.pagination.tailwind') }}
            <div class="">
                <div class="grid grid-cols-3 lg:grid-cols-7 py-3 my-3 bg-slate-700 rounded-3xl text-2xl">
                    <div class="col-span-2 flex items-center justify-center">
                        <span class="font-bold">Полное имя</span>
                    </div>
                    <div class="col-span-2 hidden lg:flex lg:items-center lg:justify-center">
                        <span class="font-bold">Дата рождения</span>
                    </div>
                    <div class="col-span-2 hidden lg:flex lg:flex-col lg:items-center lg:justify-center">
                        <div class="">
                            <span class="font-bold">Когда поздравили</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-evenly">
                        <span class="font-bold">Действия</span>
                    </div>
                </div>
                    <?php /** @var \App\Models\Employee $employee */ ?>
                @foreach($employees as $employee)
                    <div class="grid grid-cols-3 lg:grid-cols-7 py-3 my-3 bg-slate-700 rounded-3xl text-xl">
                        <div class="col-span-2 flex items-center justify-center">
                            <span class="">{{ $employee->getFullName() }}</span>
                        </div>
                        <div class="col-span-2 hidden lg:flex lg:items-center lg:justify-center">
                            <span class="">{{ \Carbon\Carbon::make($employee->birthday)->translatedFormat('d.m.Y') }}</span>
                        </div>
                            <div class="col-span-2 hidden lg:flex lg:flex-col lg:items-center lg:justify-center">
                                @if($employee->mailLog)
                                    <div class="">
                                        Поздравили <span class="">{{ \Carbon\Carbon::make($employee->mailLog->created_at)->format('d.m.Y в H:i') }}</span>
                                    </div>
                                    <a href="{{ route('mail-log.index') }}" class="text-center mt-2 py-1 w-3/5">
                                        Подробнее
                                    </a>
                                @else
                                    <div class="employee-card-congratulations-datetime">
                                        <span class="text-red-500">Никогда</span>
                                    </div>
                            </div>
                        @endif
                        <div class="employee-card-actions-container flex items-center justify-evenly">
                            <a href="{{ route('employees.show', $employee->id) }}"
                               class="flex justify-center items-center w-2/5 p-1 py-2 bg-slate-950 rounded-3xl">
                                <img src="{{ asset('icons/profile.svg') }}" alt="" class="h-5">
                            </a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="post" class="flex items-center justify-center w-2/5 p-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full">
                                    <a href="" class="flex justify-center items-center py-2 bg-red-500 rounded-3xl">
                                        <img src="{{ asset('icons/delete-profile.svg') }}" alt="Удалить профиль" class="h-5">
                                    </a>
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-list-message w-full">
                <p class="text-4xl">Пока никого нет &#128532;</p>
            </div>
        @endif
    </div>
@endsection
