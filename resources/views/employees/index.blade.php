@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="section-header-container flex flex-col items-center py-16">
            <div class="section-name">Сотрудники</div>
            <a href="{{ route('employees.create') }}" class="add-new-record-button py-1 flex justify-center w-3/12 mt-3">Добавить сотрудника</a>
        </div>
        @if(session('message'))
            <div class="info-message-container  p-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        @if($employees->count())
            {{ $employees->links('vendor.pagination.tailwind') }}
            <div class="employees-container">
                <div class="header-employee-card grid grid-cols-7 py-3 my-3">
                    <div class="header-employee-card-full-name-container col-span-2 flex items-center justify-center">
                        <span class="header-employee-card-full-name">Полное имя</span>
                    </div>
                    <div class="header-employee-card-employee-birthday-container col-span-2 flex items-center justify-center">
                        <span class="header-employee-birthday">Дата рождения</span>
                    </div>
                    <div class="header-employee-card-congratulations-datetime-container col-span-2 flex flex-col items-center justify-center">
                        <div class="header-employee-card-congratulations-datetime">
                            <span class="">Когда поздравили</span>
                        </div>
                    </div>
                    <div class="employee-card-actions-container flex items-center justify-evenly"><span>Действия</span></div>
                </div>
                    <?php /** @var \App\Models\Employee $employee */ ?>
                @foreach($employees as $employee)
                    <div class="employee-card grid grid-cols-7 py-3 my-3">
                        <div class="employee-card-full-name-container col-span-2 flex items-center justify-center">
                            <span class="employee-card-full-name">{{ $employee->getFullName() }}</span>
                        </div>
                        <div class="employee-card-employee-birthday-container col-span-2 flex items-center justify-center">
                            <span class="employee-birthday">{{ \Carbon\Carbon::make($employee->birthday)->translatedFormat('d.m.Y') }}</span>
                        </div>
                        @if($employee->mailLog)
                            <div class="employee-card-congratulations-datetime-container col-span-2 flex flex-col items-center justify-center">
                                <div class="employee-card-congratulations-datetime">
                                    Поздравили <span class="">{{ \Carbon\Carbon::make($employee->mailLog->created_at)->format('d.m.Y в H:i') }}</span>
                                </div>
                                <a href="#" class="employee-card-button details text-center mt-2 py-1 w-3/5">
                                    Подробнее
                                </a>
                            </div>
                        @else
                            <div class="employee-card-congratulations-datetime-container col-span-2 flex flex-col items-center justify-center">
                                <div class="employee-card-congratulations-datetime">
                                    <span class="">Ещё не поздравляли</span>
                                </div>
                                <a href="#" class="employee-card-button congratulate-now text-center mt-2 py-1 w-3/5">
                                    Поздравить сейчас
                                </a>
                            </div>
                        @endif
                        <div class="employee-card-actions-container flex items-center justify-evenly">
                            <a href="{{ route('employees.show', $employee->id) }}"
                               class="employee-card-action-button profile flex justify-center items-center w-2/5 p-1">
                                <img src="{{ asset('icons/profile.svg') }}" alt="" class="max-h-8">
                            </a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="post" class="flex items-center justify-center w-2/5 p-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full">
                                    <a href="" class="delete-profile-button action-button flex justify-center items-center py-1 px-5">
                                        <img src="{{ asset('icons/delete-profile.svg') }}" alt="Удалить профиль" class="button-icon">
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
