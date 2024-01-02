@php
/** @var \App\Models\MailTemplate $mailTemplate*/
@endphp

@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="py-5">
            <x-back-link :route="route('mail-templates.show', $mailTemplate->id)" :text="'Назад'"></x-back-link>
        </div>
        <div class="flex flex-col items-center">
            <div class="flex justify-center pt-16">
                <div class="text-3xl">Редактирование шаблона поздравления</div>
            </div>
            @include('mail-templates.info-message')
            <div class="">
                <form action="{{ route('mail-templates.update', $mailTemplate) }}" method="POST"
                      class="flex flex-col items-center ">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3 flex justify-center flex-col">
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
                            class="p-3 w-96 resize-none"
                            name="body"
                            placeholder="Текст поздравления"
                            rows="15"
                            :value="$mailTemplate->body"
                        ></x-textarea-input>
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <button type="submit" class="m-3 w-96 p-3 bg-green-500 rounded-3xl text-xl hover:scale-105 transition-all" id="">
                        Обновить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
