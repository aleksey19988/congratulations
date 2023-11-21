@extends('layouts.header')
@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <div class="section-header-container flex justify-center py-16">
            <div class="section-name">Добавление шаблона поздравления</div>
        </div>
        <div class="add-mail-template-form-container">
            <form action="{{ route('mail-templates.store') }}" method="POST"
                  class="add-mail-template-form flex w-96 flex-col">
                @csrf
                <input
                    type="text"
                    name="subject"
                    class="@error('subject') border-2 border-rose-500 @enderror input-field m-3 p-3"
                    placeholder="Тема"
                    value="{{ old('subject') }}"
                >
                @error('subject')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <textarea class="@error('body') border-2 border-rose-500 @enderror input-field m-3 p-3 resize-none"
                          name="body" placeholder="Текст поздравления" rows="15">{{ old('body') }}</textarea>
                @error('body')
                <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                @enderror
                <button type="submit" class="save-add-mail-template-form-button m-3 p-3" id="form-button">Сохранить
                </button>
            </form>
        </div>
    </div>
@endsection
