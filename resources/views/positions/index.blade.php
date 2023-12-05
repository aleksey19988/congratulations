@php use App\Models\Position; @endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="go-back-button-container py-5">
            <a href="{{ url()->previous() }}">
                <button class="go-back-button py-1 px-5">Назад</button>
            </a>
        </div>
        <div class="section-header-container flex flex-col items-center py-16">
            <div class="section-name">Должности</div>
            <a href="{{ route('positions.create') }}"
               class="add-new-record-button py-1 flex justify-center w-3/12 mt-3">Добавить должность</a>
        </div>
        @if(session('message'))
            <div class="info-message-container  p-5">
                <span class="info-message-text text-white">{{session('message')}}</span>
            </div>
        @endif
        @if($positions->count())
            {{ $positions->links('vendor.pagination.tailwind') }}
            <div class="positions-container">
                <div class="header-position-card grid grid-cols-6 py-3 my-3">
                    <div class="header-position-card-name-container col-span-2 flex items-center justify-center">
                        <span class="header-position-card-name text-center">Наименование</span>
                    </div>
                    <div
                        class="header-position-card-position-created-at-container col-span-2 flex items-center justify-center">
                        <span class="header-position-created-at">Когда добавили</span>
                    </div>
                    <div class="position-card-actions-container col-start-6 flex items-center justify-evenly"><span>Действия</span>
                    </div>
                </div>
                @php /** @var Position $positions */ @endphp
                @foreach($positions as $position)
                    <div class="position-card grid grid-cols-6 py-3 my-3">
                        <div class="position-card-name-container col-span-2 flex items-center justify-center">
                            <span class="position-card-name">{{ $position->name }}</span>
                        </div>
                        <div
                            class="position-card-position-created-at-container col-span-2 flex items-center justify-center">
                            <span class="position-created-at">{{ \Carbon\Carbon::make($position->created_at)->translatedFormat('d.m.Y') }}</span>
                        </div>
                        <div class="position-card-actions-container col-start-6 flex items-center justify-evenly">
                            <a href="{{ route('positions.show', $position->id) }}"
                               class="position-card-action-button position flex justify-center items-center w-2/5 p-1">
                                <img src="{{ asset('icons/profile.svg') }}" alt="Подробнее" class="max-h-8">
                            </a>
                            <form action="{{ route('positions.destroy', $position->id) }}" method="post"
                                  class="flex items-center justify-center w-2/5 p-1">
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
                @endforeach
            </div>
        @else
            <div class="empty-list-message w-full">
                <p class="text-4xl">Пока никого нет &#128532;</p>
            </div>
        @endif
    </div>
@endsection
