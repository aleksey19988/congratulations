@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="go-back-button-container py-5">
            <x-back-link :route="route('app.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="section-header-container flex flex-col items-center py-16">
            <div class="section-name">Сотрудники и их должности</div>
        </div>
        <div class="sections-container grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 row-start-2 gap-5 pb-16">
            <x-section-link :route="route('employees.index')" :text="'Сотрудники'"></x-section-link>
            <x-section-link :route="route('positions.index')" :text="'Должности'"></x-section-link>
        </div>
    </div>
@endsection
