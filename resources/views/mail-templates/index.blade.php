@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="go-back-button-container py-5">
            <x-back-link :route="route('app.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="section-header-container flex flex-col items-center py-16">
            <div class="section-name">Шаблоны поздравлений</div>
            <a href="{{ route('mail-templates.create') }}" class="add-new-record-button py-1 flex justify-center w-3/12 mt-3">Добавить шаблон</a>
        </div>
        @if(session('message'))
            <div class="info-message-container  p-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        {{ $mailTemplates->links('vendor.pagination.tailwind') }}
        <div class="employees-container">
            <div class="mail-template-card grid grid-cols-7 py-3 my-3 gap-x-5">
                <div class="header-mail-template-card-subject-container col-span-2 flex items-center justify-center">
                    <span class="header-mail-template-card-subject">Тема письма</span>
                </div>
                <div class="header-mail-template-card-body-container col-span-4 flex items-center">
                    <span class="header-mail-template-card-body">Тело письма</span>
                </div>
                <div class="mail-template-card mail-template-card-actions-container flex items-center justify-evenly col-start-7">Действия</div>
            </div>
            @php /** @var \App\Models\MailTemplate $mailTemplate */ @endphp
            @foreach($mailTemplates as $mailTemplate)
                <div class="mail-template-card grid grid-cols-7 py-3 my-3 gap-x-5">
                    <div class="mail-template-card-subject-container col-span-2 flex items-center justify-center px-3">
                        <span class="mail-template-card-subject">{{ $mailTemplate->subject }}</span>
                    </div>
                    <div class="mail-template-card-body-container col-span-4 flex items-center">
                        <span class="mail-template-card-body">{{ (strlen($mailTemplate->body) > 300) ? mb_substr($mailTemplate->body, 0, 300) . '...' : $mailTemplate->body}}</span>
                    </div>
                    <div class="mail-template-card mail-template-card-actions-container flex items-center justify-evenly col-start-7">
                        <a href="{{ route('mail-templates.show', $mailTemplate->id) }}"
                           class="mail-template-card-action-button action-button profile flex justify-center items-center w-2/5 p-1">
                            <img src="{{ asset('icons/document.svg') }}" alt="" class="">
                        </a>
                        <form action="{{ route('mail-templates.destroy', $mailTemplate->id) }}" method="post" class="flex items-center justify-center w-2/5 p-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full">
                                <a href="" class="delete-mail-template-button action-button flex justify-center items-center py-1 px-5">
                                    <img src="{{ asset('icons/delete-document.svg') }}" alt="Удалить шаблон" class="button-icon">
                                </a>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
