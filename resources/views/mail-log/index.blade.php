@php
    /** @var \Illuminate\Support\Collection $mailLog */
@endphp

@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="section-header-container flex flex-col items-center py-16">
            <div class="section-name">Отправленные поздравления</div>
        </div>
        @if(session('message'))
            <div class="info-message-container  p-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        @if($mailLog->count())
            <div class="employees-container">
                {{ $mailLog->links('vendor.pagination.tailwind') }}
                <div class="header-mail-log-card grid grid-cols-7 py-3 my-3 gap-x-5">
                    <div class="header-mail-log-card-subject-container col-span-2 flex items-center justify-center">
                        <span class="header-mail-log-card-subject">Получатель</span>
                    </div>
                    <div class="header-mail-log-card-body-container col-span-4 flex items-center">
                        <span class="header-mail-log-card-body">Шаблон письма</span>
                    </div>
                    <div class="header-mail-log-card-body-container flex items-center">
                        <span class="header-mail-log-card-body">Статус отправки</span>
                    </div>
                </div>
                @foreach($mailLog as $record)
                    <div class="mail-log-card grid grid-cols-7 py-3 my-3 gap-x-5">
                        <div class="mail-log-card-employee-container col-span-2 flex items-center justify-center">
                            <span class="mail-log-card-subject">
                                <a href="{{ route('employees.show', $record->employee->id) }}">
                                    {{ $record->employee->getFullName() }}
                                </a>
                            </span>
                        </div>
                        <div class="mail-log-card-template-container col-span-4 flex items-center">
                            <span class="mail-log-card-template">
                                <a href="{{ route('mail-templates.show', $record->mailTemplate->id) }}">{{ $record->mailTemplate->subject }}</a>
                            </span>
                        </div>
                        <div class="mail-log-card-send-status-container col-span-1 flex items-center">
                            <span class="mail-log-card-send-status {{ $record->is_send_success ? 'success-send-status' : 'error-send-status' }}">
                                {{ $record->is_send_success ? 'Успешно' : 'С ошибкой' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-list-message w-full">
                <p class="text-4xl">Пока никого не поздравляли &#128532;</p>
            </div>
        @endif
    </div>
@endsection
