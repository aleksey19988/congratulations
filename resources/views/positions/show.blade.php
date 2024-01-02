@php /** @var \App\Models\Position $position */ @endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="py-5">
            <x-back-link :route="route('positions.index')" :text="'Назад'"></x-back-link>
        </div>
        @if(session('message'))
            <div class="info-message-container p-5 my-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        <div class="py-5">
            <div class="text-3xl font-bold">{{ $position->name }}</div>
        </div>
        <div class="mb-16">
            <div class="">
                <div class="py-2 created-at-container">
                    <p class="">
                        <span class="">Дата добавления:</span> {{ \Carbon\Carbon::make($position->created_at)->locale('ru')->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        <div class="flex">
            <div class="">
                <a href="{{ route('positions.edit', $position->id) }}" class="flex justify-center items-center py-1 px-5 bg-slate-700 rounded-3xl hover:scale-105 transition-all">
                    <img src="{{ asset('icons/pencil.svg') }}" alt="Редактировать должность" class="h-5">
                </a>
            </div>
            <div class="">
                <form action="{{ route('positions.destroy', $position->id) }}" method="post"
                      class="flex items-center justify-center ml-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full">
                        <a href=""
                           class="flex justify-center items-center py-1 px-5 bg-red-500 rounded-3xl hover:scale-105 transition-all">
                            <img src="{{ asset('icons/delete-profile.svg') }}" alt="Удалить должность" class="h-5">
                        </a>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
