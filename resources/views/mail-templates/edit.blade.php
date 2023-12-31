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

                    <div class="mb-3 flex -justify-center flex-col">
                        <x-text-input
                            type="text"
                            name="subject"
                            class="w-96 p-3"
                            placeholder="Тема"
                            value="{{ $mailTemplate->subject }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <x-textarea-input
                            class="p-3 w-full resize-none"
                            name="body"
                            placeholder="Текст поздравления"
                            rows="15"
                            :value="$mailTemplate->body"
                        ></x-textarea-input>
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <button type="submit" class="save-add-mail-template-form-button m-3 p-3" id="form-button">
                        Обновить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
