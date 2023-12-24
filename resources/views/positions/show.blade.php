@php /** @var \App\Models\Position $position */ @endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="go-back-button-container py-5">
            <a href="{{ route('positions.index') }}">
                <button class="go-back-button py-1 px-5">Назад</button>
            </a>
        </div>
        @if(session('message'))
            <div class="info-message-container p-5 my-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        <div class="section-header-container employee-full-name-container pb-16">
            <div class="position-name">{{ $position->name }}</div>
        </div>
        <div class="position-data-container mb-16">
            <div class="position-data">
                <div class="position-data-section py-2 created-at-container">
                    <p class="birthday">
                        <span class="data-section-name">Дата добавления:</span> {{ \Carbon\Carbon::make($position->created_at)->locale('ru')->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        <div class="action-buttons flex">
            <div class="edit-profile-button-container">
                <a href="{{ route('positions.edit', $position->id) }}" class="edit-position-button action-button flex justify-center items-center py-1 px-5">
                    <img src="{{ asset('icons/pencil.svg') }}" alt="Редактировать должность" class="button-icon">
                </a>
            </div>
            <div class="delete-position-button-container">
                <form action="{{ route('positions.destroy', $position->id) }}" method="post"
                      class="flex items-center justify-center ml-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full">
                        <a href=""
                           class="delete-position-button action-button flex justify-center items-center py-1 px-5">
                            <img src="{{ asset('icons/delete-profile.svg') }}" alt="Удалить должность"
                                 class="button-icon">
                        </a>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
