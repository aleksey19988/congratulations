@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="go-back-button-container py-5">
            <a href="{{ url()->previous() }}">
                <button class="go-back-button py-1 px-5">Назад</button>
            </a>
        </div>
        <div class="section-header-container flex flex-col items-center py-16">
            <div class="section-name">Сотрудники и их должности</div>
        </div>
        <div class="sections-container grid grid-cols-5 row-start-2 gap-x-5 pb-16">
            <a href="{{ route('employees.index') }}" class="section-container flex justify-center items-center">
                <p>Сотрудники</p>
            </a>
            <a href="{{ route('positions.index') }}" class="section-container flex justify-center items-center">
                <p>Должности</p>
            </a>
        </div>
    </div>
@endsection
