@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="py-5">
            <x-back-link :route="route('positions.show', $position->id)" :text="'Назад'"></x-back-link>
        </div>
        <div class="flex flex-col items-center">
            <div class="flex justify-center py-16">
                <div class="text-3xl">Редактирование должности: {{ $position->name }}</div>
            </div>
            <div class="">
                <form action="{{ route('positions.update', $position->id) }}" method="post" class="flex flex-col">
                    @csrf
                    @method('patch')
                    <x-text-input
                        type="text"
                        name="name"
                        class="input-field m-3 w-96 p-3"
                        placeholder="Наименование должности"
                        value="{{ $position->name }}"
                    ></x-text-input>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <button type="submit" class="m-3 w-96 p-3 bg-green-500 rounded-3xl text-xl hover:scale-105 transition-all" id="form-button">
                        Сохранить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
