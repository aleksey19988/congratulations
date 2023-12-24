@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="go-back-button-container py-5">
            <a href="{{ route('positions.index') }}">
                <button class="go-back-button py-1 px-5">Назад</button>
            </a>
        </div>
        <div class="form-container flex flex-col items-center">
            <div class="section-header-container flex justify-center py-16">
                <div class="section-name">Добавление должности</div>
            </div>
            <div class="add-position-form-container">
                <form action="{{ route('positions.store') }}" method="post" class="add-position-form flex flex-col">
                    @csrf
                    <input
                        type="text"
                        name="name"
                        class="@error('name') border-2 border-rose-500 @enderror input-field m-3 w-96 p-3"
                        placeholder="Наименование должности"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                    <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="save-add-position-form-button m-3 w-96 p-3"
                            id="form-button">Сохранить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection