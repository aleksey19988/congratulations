@php
    /** @var \App\Models\Employee $employee */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="go-back-button-container py-5">
            <a href="{{ url()->previous() }}">
                <button class="go-back-button py-1 px-5">Назад</button>
            </a>
        </div>
        @if(session('message'))
            <div class="info-message-container p-5 my-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        <div class="section-header-container employee-full-name-container pb-16">
            <div class="employee-full-name">{{ $employee->getFullName() }}</div>
        </div>
        <div class="employee-data-container mb-16">
            <div class="employee-data">
                <div class="employee-data-section py-2 birthday-container">
                    <p class="birthday">
                        <span class="data-section-name">Дата рождения:</span> {{ \Carbon\Carbon::make($employee->birthday)->locale('ru')->translatedFormat('d F Y') }}
                    </p>
                </div>
                <div class="employee-data-section py-2 email-container">
                    <p class="email">
                        <span class="data-section-name">Email:</span> {{ $employee->email }}
                    </p>
                </div>
                <div class="employee-data-section py-2 position-container">
                    <p class="position">
                        <span class="data-section-name">Должность:</span> {{ $employee->position->name }}
                    </p>
                </div>
                <div class="employee-data-section py-2 create-date-container">
                    <p class="create-date">
                        <span class="data-section-name">Добавлен:</span> {{ \Carbon\Carbon::make($employee->created_at)->locale('ru')->translatedFormat('d F Y') }}
                    </p>
                </div>
                <div class="employee-data-section py-2 create-date-container">
                    <p class="create-date">
                        @if($employee->mailLog)
                            <span class="data-section-name">Поздравляли:</span> {{ \Carbon\Carbon::make($employee->mailLog->created_at)->locale('ru')->translatedFormat('d F Y') }}
                        @else
                            <span class="data-section-name">Ещё не поздравляли</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="action-buttons flex">
            <div class="edit-profile-button-container">
                <a href="{{ route('employees.edit', $employee->id) }}" class="edit-profile-button action-button flex justify-center items-center py-1 px-5">
                    <img src="{{ asset('icons/pencil.svg') }}" alt="Редактировать профиль" class="button-icon">
                </a>
            </div>
            <div class="delete-profile-button-container">
                <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <a href="" class="delete-profile-button action-button flex justify-center items-center py-1 px-5 ml-3">
                            <img src="{{ asset('icons/delete-profile.svg') }}" alt="Удалить профиль" class="button-icon">
                        </a>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
