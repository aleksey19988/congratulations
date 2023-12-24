@php
/** @var \App\Models\MailTemplate $mailTemplate*/
@endphp

@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="go-back-button-container py-5">
            <a href="{{ route('mail-templates.show', $mailTemplate->id) }}">
                <button class="go-back-button py-1 px-5">Назад</button>
            </a>
        </div>
        <div class="form-container flex flex-col items-center">
            <div class="section-header-container flex justify-center pt-16">
                <div class="section-name">Редактирование шаблона поздравления</div>
            </div>
            @include('mail-templates.info-message')
            <div class="add-mail-template-form-container">
                <form action="{{ route('mail-templates.update', $mailTemplate) }}" method="POST"
                      class="add-mail-template-form flex w-96 flex-col">
                    @csrf
                    @method('PATCH')
                    <input
                        type="text"
                        name="subject"
                        class="@error('subject') border-2 border-rose-500 @enderror input-field m-3 p-3"
                        placeholder="Тема"
                        value="{{ $mailTemplate->subject }}"
                    >
                    @error('subject')
                    <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                    @enderror
                    <textarea class="@error('body') border-2 border-rose-500 @enderror input-field m-3 p-3 resize-none"
                              name="body" placeholder="Текст поздравления" rows="15">{{ $mailTemplate->body }}</textarea>
                    @error('body')
                    <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="save-add-mail-template-form-button m-3 p-3" id="form-button">Сохранить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
