@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="datetime-container flex items-center col-span-2 py-32">
            <div class="date-time">
                Сегодня {{ \Carbon\Carbon::now()->locale('ru')->translatedFormat('d F Y, l') }}
            </div>
        </div>
        <div class="sections-container grid grid-cols-5 row-start-2 gap-x-5 pb-32">
            <a href="#" class="section-container flex justify-center items-center">
                <p>Отправленные поздравления</p>
            </a>
            <a href="#" class="section-container flex justify-center items-center">
                <p>Поздравить вручную</p>
            </a>
            <a href="#" class="section-container flex justify-center items-center">
                <p>Сотрудники</p>
            </a>
            <a href="#" class="section-container flex justify-center items-center">
                <p>Шаблоны поздравлений</p>
            </a>
        </div>
        <div class="birthday-people-container flex flex-nowrap overflow-x-auto">
            <div class="flex-shrink-0 w-max px-10 birthday-people-card flex justify-around items-center flex-col mx-2">
                <div class="full-name-container">
                    <span class="full-name">
                        Иванов Иван Иванович
                    </span>
                </div>
                <div class="congratulations-datetime-container">
                    <span class="congratulations-datetime">
                        Поздравили в 08:47 🎉
                    </span>
                </div>
                <a href="#" class="button py-1.5 flex justify-center items-center flex-col">
                    Подробнее
                </a>
            </div>
            <div class="flex-shrink-0 w-max px-10 birthday-people-card flex justify-around items-center flex-col mx-2">
                <div class="full-name-container">
                    <span class="full-name">
                        Иванов Иван Иванович
                    </span>
                </div>
                <div class="congratulations-datetime-container">
                    <span class="congratulations-datetime">
                        Скоро поздравим 🤫
                    </span>
                </div>
                <a href="#" class="button py-1.5 congratulate flex justify-center items-center flex-col">
                    Поздравить сейчас
                </a>
            </div>
        </div>
    </div>
@endsection
