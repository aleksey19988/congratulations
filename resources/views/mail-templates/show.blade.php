@php /** @var \App\Models\MailTemplate $mailTemplate */ @endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="py-5">
            <x-back-link :route="route('mail-templates.index')" :text="'Назад'"></x-back-link>
        </div>
        @if(session('message'))
            <div class="p-5 my-5">
                <span class="text-white">{{session('message')}}</span>
            </div>
        @endif
        <div class="py-5">
            <div class="text-3xl font-bold">{{ $mailTemplate->subject }}</div>
        </div>
        <div class="mb-16">
            <div class="">
                <div class="py-2">
                    <p class="">
                        {!! nl2br($mailTemplate->body) !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="">
                <a href="{{ route('mail-templates.edit', $mailTemplate->id) }}" class="flex justify-center items-center py-1 px-5 bg-slate-700 rounded-3xl hover:scale-105 transition-all">
                    <img src="{{ asset('icons/edit-document.svg') }}" alt="Редактировать профиль" class="h-5">
                </a>
            </div>
            <div class="">
                <form action="{{ route('mail-templates.destroy', $mailTemplate->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <a href="" class="flex justify-center items-center py-1 px-5 ml-3 bg-red-500 rounded-3xl hover:scale-105 transition-all">
                            <img src="{{ asset('icons/delete-document.svg') }}" alt="Удалить профиль" class="h-5">
                        </a>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
