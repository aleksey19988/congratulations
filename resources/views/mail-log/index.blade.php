@php
    /** @var \Illuminate\Support\Collection $mailLog */
@endphp

@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="py-5">
            <x-back-link :route="route('app.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="flex flex-col items-center py-16">
            <div class="text-3xl">Отправленные поздравления</div>
        </div>
        @if(session('message'))
            <div class="w-full p-5 bg-green-500 rounded-3xl">
                <span class="text-xl">{{session('message')}}</span>
            </div>
        @endif
        @if($mailLog->count())
            <div class="">
                {{ $mailLog->links('vendor.pagination.tailwind') }}
                <div class="grid grid-cols-4 lg:grid-cols-8 py-3 my-3 bg-slate-700 rounded-3xl text-2xl">
                    <div class="col-span-2 flex items-center justify-center">
                        <span class="">Получатель</span>
                    </div>
                    <div class="hidden lg:col-span-3 lg:flex lg:items-center">
                        <span class="">Шаблон письма</span>
                    </div>
                    <div class="col-span-2 flex items-center">
                        <span class="">Дата и время</span>
                    </div>
                    <div class="hidden lg:flex lg:items-center">
                        <span class="">Статус</span>
                    </div>
                </div>
                @foreach($mailLog as $record)
                    <div class="grid grid-cols-4 lg:grid-cols-8 py-3 my-3 gap-x-5">
                        <div class="col-span-2 flex items-center justify-center">
                            <span class="">
                                @if($record->employee)
                                    <a class="" href="{{ route('employees.show', $record->employee->id) }}">{{ $record->employee->getFullName() }}</a>
                                @else
                                    <span class="">
                                        Сотрудник был удалён
                                    </span>
                                @endif
                            </span>
                        </div>
                        <div class="hidden lg:col-span-3 lg:flex lg:items-center">
                            @if($record->mailTemplate)
                                <a class="" href="{{ route('mail-templates.show', $record->mailTemplate->id) }}">{{ $record->mailTemplate->subject }}</a>
                            @else
                                <span class="">Шаблон письма был удалён</span>
                            @endif
                        </div>
                        <div class="col-span-2 flex items-center">
                            {{ \Carbon\Carbon::make($record->created_at)->locale('ru')->translatedFormat('d F Y в H:i') }}
                        </div>
                        <div class="hidden lg:col-span-1 lg:flex lg:items-center">
                            <span class="{{ $record->is_send_success ? 'text-green-500' : 'text-red-500' }}">
                                {{ $record->is_send_success ? 'Успешно' : 'С ошибкой' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="w-full flex justify-center">
                <p class="text-xl">Пока никого не поздравляли &#128532;</p>
            </div>
        @endif
    </div>
@endsection
