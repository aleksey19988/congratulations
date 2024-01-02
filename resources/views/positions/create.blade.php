@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="go-back-button-container py-5">
            <x-back-link :route="route('positions.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="form-container flex flex-col items-center">
            <div class="flex justify-center py-16">
                <div class="text-3xl">Добавление должности</div>
            </div>
            <div class="add-position-form-container">
                <form action="{{ route('positions.store') }}" method="post" class="add-position-form flex flex-col">
                    @csrf
                    <x-text-input
                        type="text"
                        name="name"
                        class="@error('name') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                        placeholder="Наименование должности"
                        value="{{ old('name') }}"
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
