@php
    /** @var \App\Models\MailTemplate $mailTemplate */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        @if(session('message'))
            <div class="info-message-container p-5 my-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        <div class="section-header-container mail-template-subject-container py-16">
            <div class="mail-template-subject">{{ $mailTemplate->subject }}</div>
        </div>
        <div class="mail-template-data-container mb-16">
            <div class="mail-template-data">
                <div class="mail-template-data-section py-2 body-container">
                    <p class="subject">
                        {{ $mailTemplate->body }}
                    </p>
                </div>
            </div>
        </div>
        <div class="action-buttons flex">
            <div class="edit-profile-button-container">
                <a href="{{ route('mail-templates.edit', $mailTemplate->id) }}" class="edit-profile-button action-button flex justify-center items-center py-1 px-5">
                    <img src="{{ asset('icons/edit-document.svg') }}" alt="Редактировать профиль" class="button-icon">
                </a>
            </div>
            <div class="delete-profile-button-container">
                <form action="{{ route('mail-templates.destroy', $mailTemplate->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <a href="" class="delete-profile-button action-button flex justify-center items-center py-1 px-5 ml-3">
                            <img src="{{ asset('icons/delete-document.svg') }}" alt="Удалить профиль" class="button-icon">
                        </a>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
