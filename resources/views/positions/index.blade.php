@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="py-5">
            <x-back-link :route="route('administrative.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="flex flex-col items-center py-16">
            <div class="text-3xl">Должности</div>
            <a href="{{ route('positions.create') }}"
               class="py-1 flex justify-center w-9/12 lg:w-3/12 mt-3 bg-green-500 rounded-3xl text-xl hover:scale-105 transition-all">Добавить должность</a>
        </div>
        @if(session('message'))
            <div class="w-full p-5 bg-green-500 rounded-3xl">
                <span class="text-xl">{{session('message')}}</span>
            </div>
        @endif
        @if($positions->count())
            {{ $positions->links('vendor.pagination.tailwind') }}
            <div class="">
                <div class="bg-white dark:bg-slate-700 rounded-3xl grid grid-cols-3 lg:grid-cols-6 py-3 my-3">
                    <div class="col-span-2 flex items-center justify-center">
                        <span class="text-xl font-bold">Наименование</span>
                    </div>
                    <div class="lg:col-span-2 hidden lg:flex lg:items-center justify-center">
                        <span class="text-xl font-bold">Когда добавили</span>
                    </div>
                    <div class="lg:col-start-6 flex items-center justify-evenly">
                        <span class="text-xl font-bold">Действия</span>
                    </div>
                </div>
                @php /** @var \App\Models\Position $positions */ @endphp
                @foreach($positions as $position)
                    <div class="bg-white dark:bg-slate-700 rounded-3xl grid grid-cols-3 lg:grid-cols-6 py-3 my-3">
                        <div class="col-span-2 flex items-center justify-center">
                            <span class="">{{ $position->name }}</span>
                        </div>
                        <div
                            class="col-span-2 hidden lg:flex lg:items-center lg:justify-center">
                            <span class="">{{ \Carbon\Carbon::make($position->created_at)->translatedFormat('d.m.Y') }}</span>
                        </div>
                        <div class="lg:col-start-6 flex items-center justify-evenly">
                            <a href="{{ route('positions.show', $position->id) }}" class="flex justify-center items-center w-2/5 p-1 py-2 bg-slate-700 dark:bg-slate-950 rounded-3xl hover:scale-105 transition-all">
                                <img src="{{ asset('icons/profile.svg') }}" alt="Подробнее" class="h-5">
                            </a>
                            <form action="{{ route('positions.destroy', $position->id) }}" method="post" class="flex items-center justify-center w-2/5">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full hover:scale-105 transition-all">
                                    <a href="" class="flex justify-center items-center py-2 bg-red-500 rounded-3xl">
                                        <img src="{{ asset('icons/delete-profile.svg') }}" alt="Удалить должность" class="h-5">
                                    </a>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="w-full flex justify-center">
                <p class="text-xl">Нет ни одной должности &#128532;</p>
            </div>
        @endif
    </div>
@endsection
