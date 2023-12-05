@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="datetime-container flex items-center justify-center col-span-2 py-16">
            <div class="date-time">
                Сегодня {{ \Carbon\Carbon::now()->locale('ru')->translatedFormat('d F Y, l') }}
            </div>
        </div>
        <div class="sections-container grid grid-cols-5 row-start-2 gap-x-5 pb-16">
            <a href="{{ route('mail-log.index') }}" class="section-container flex justify-center items-center">
                <p>Отправленные поздравления</p>
            </a>
            <a href="{{ route('manual-congratulations.index') }}" class="section-container flex justify-center items-center">
                <p>Поздравить вручную</p>
            </a>
            <a href="{{ route('administrative.index') }}" class="section-container flex justify-center items-center">
                <p>Сотрудники и их должности</p>
            </a>
            <a href="{{ route('mail-templates.index') }}" class="section-container flex justify-center items-center">
                <p>Шаблоны поздравлений</p>
            </a>
        </div>
        <div class="birthday-people-container flex flex-nowrap overflow-x-auto">
            <div class="background-text z-0 flex justify-center items-center px-5">
                @if($birthdayPeople->count() > 0)
                    <img src="{{ asset('icons/birthday-people-background-text.svg') }}" alt="">
                @else
                    <img src="{{ asset('icons/without-birthday-people-background-text.svg') }}" alt="">
                @endif
            </div>
            @php /** @var \App\Models\Employee $employee */ @endphp
            @foreach($birthdayPeople as $employee)
                <div class="birthday-people-card px-10 min-w-[22%] flex justify-around items-center flex-col mx-2 z-10">
                    <div class="full-name-container">
                    <span class="full-name">{{ $employee->getFullName() }}</span>
                    </div>
                    <div class="congratulations-datetime-container">
                        @if ($employee->mailLog)
                            <span class="congratulations-datetime">
                                Поздравили в {{ \Carbon\Carbon::make($employee->maillog->created_at)->format('H:i') }} 🎉
                            </span>
                        @else
                            <span class="congratulations-datetime">
                                Скоро поздравим 🤫
                            </span>
                        @endif
                    </div>
                    @if ($employee->mailLog)
                        <a href="#" class="button py-1.5 flex justify-center items-center flex-col">
                            Подробнее
                        </a>
                    @else
                        <a href="{{ route('congratulations.send', $employee->id) }}" class="button py-1.5 congratulate flex justify-center items-center flex-col">
                            Поздравить сейчас
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
