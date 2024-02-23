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
                        <span class="text-xl font-bold">
                            @if(request()->get('sortBy') === 'name')
                                @if(request()->get('order') === 'asc')
                                    <a href="{{ route('positions.index', ['sortBy' => 'name', 'order' => 'desc', 'page' => request()->page ?? 1]) }}">Наименование</a>
                                    <img src="{{ asset('icons/asc-sort.svg') }}" alt="По возрастанию" class="hidden dark:inline h-5">
                                    <img src="{{ asset('icons/asc-sort-dark.svg') }}" alt="По возрастанию" class="inline dark:hidden h-5">
                                @elseif(request()->get('order') === 'desc')
                                    <a href="{{ route('positions.index', ['sortBy' => 'name', 'order' => 'asc', 'page' => request()->page ?? 1]) }}">Наименование</a>
                                    <img src="{{ asset('icons/desc-sort.svg') }}" alt="По убыванию" class="hidden dark:inline h-5">
                                    <img src="{{ asset('icons/desc-sort-dark.svg') }}" alt="По убыванию" class="inline dark:hidden h-5">
                                @else
                                    <a href="{{ route('positions.index', ['sortBy' => 'name', 'order' => 'desc']) }}">Наименование</a>
                                @endif
                            @else
                                <a href="{{ route('positions.index', ['sortBy' => 'name', 'order' => 'desc']) }}">Наименование</a>
                            @endif
                        </span>
                    </div>
                    <div class="lg:col-span-2 hidden lg:flex lg:items-center justify-center">
                        <span class="text-xl font-bold">
                            @if(request()->get('sortBy') === 'created_at')
                                @if(request()->get('order') === 'asc')
                                    <a href="{{ route('positions.index', ['sortBy' => 'created_at', 'order' => 'desc', 'page' => request()->page ?? 1]) }}">Дата создания</a>
                                    <img src="{{ asset('icons/asc-sort.svg') }}" alt="По возрастанию" class="hidden dark:inline h-5">
                                    <img src="{{ asset('icons/asc-sort-dark.svg') }}" alt="По возрастанию" class="inline dark:hidden h-5">
                                @elseif(request()->get('order') === 'desc')
                                    <a href="{{ route('positions.index', ['sortBy' => 'created_at', 'order' => 'asc', 'page' => request()->page ?? 1]) }}">Дата создания</a>
                                    <img src="{{ asset('icons/desc-sort.svg') }}" alt="По убыванию" class="hidden dark:inline h-5">
                                    <img src="{{ asset('icons/desc-sort-dark.svg') }}" alt="По убыванию" class="inline dark:hidden h-5">
                                @else
                                    <a href="{{ route('positions.index', ['sortBy' => 'created_at', 'order' => 'desc']) }}">Дата создания</a>
                                @endif
                            @else
                                <a href="{{ route('positions.index', ['sortBy' => 'created_at', 'order' => 'desc']) }}">Дата создания</a>
                            @endif
                        </span>
                    </div>
                    <div class="lg:col-start-6 flex items-center justify-evenly">
                        <span class="text-xl font-bold">Действия</span>
                    </div>
                </div>
                @php /** @var \App\Models\Position $positions */ @endphp
                @foreach($positions as $position)
                    <div class="bg-white dark:bg-slate-700 rounded-3xl grid grid-cols-3 lg:grid-cols-6 py-3 my-3">
                        <div class="col-span-2 flex items-center justify-center text-center">
                            <span class="">{{ $position->name }}</span>
                        </div>
                        <div
                            class="col-span-2 hidden lg:flex lg:items-center lg:justify-center">
                            <span class="">{{ \Carbon\Carbon::make($position->created_at)->translatedFormat('d.m.Y') }}</span>
                        </div>
                        <div class="lg:col-start-6 flex items-center justify-evenly">
                            <a href="{{ route('positions.show', $position->id) }}"
                               data-tooltip-target="tooltip-position-data-button-{{ $loop->index }}"
                               class="flex justify-center items-center w-2/5 p-1 py-2 bg-slate-700 dark:bg-slate-950 rounded-3xl hover:scale-105 transition-all">
                                <img src="{{ asset('icons/profile.svg') }}" alt="Подробнее" class="h-5">
                            </a>
                            <div id="tooltip-position-data-button-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible hidden xl:inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Подробнее
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <form action="{{ route('positions.destroy', $position->id) }}" method="post" class="flex items-center justify-center w-2/5">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full hover:scale-105 transition-all" data-tooltip-target="tooltip-remove-position-button-{{ $loop->index }}">
                                    <a href="" class="flex justify-center items-center py-2 bg-red-500 rounded-3xl">
                                        <img src="{{ asset('icons/delete-profile.svg') }}" alt="Удалить должность" class="h-5">
                                    </a>
                                </button>
                                <div id="tooltip-remove-position-button-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible hidden xl:inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Удалить
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
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
