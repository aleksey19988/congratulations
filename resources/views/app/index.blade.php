@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="datetime-container flex items-center justify-center col-span-2 py-16">
            <div class="date-time">
                Сегодня {{ \Carbon\Carbon::now()->locale('ru')->translatedFormat('d F Y, l') }}
            </div>
        </div>
        <div class="sections-container grid grid-cols-5 grid-rows-1 row-start-2 gap-5 pb-16">
            <x-section-link :route="route('mail-log.index')" :text="'Отправленные поздравления'"></x-section-link>
            <x-section-link :route="route('manual-congratulations.index')" :text="'Поздравить вручную'"></x-section-link>
            <x-section-link :route="route('administrative.index')" :text="'Сотрудники и их должности'"></x-section-link>
            <x-section-link :route="route('mail-templates.index')" :text="'Шаблоны поздравлений'"></x-section-link>
        </div>
        <div class="flex flex-nowrap overflow-x-auto bg-slate-700 rounded-3xl h-48">
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
                        <a href="{{ route('mail-log.index') }}" class="button py-1.5 flex justify-center items-center flex-col">
                            Подробнее
                        </a>
                    @else
                        <?php //@todo Реализовать отображение кнопки и отправку поздравления вручную?>
{{--                        <a href="{{ route('congratulations.send', $employee->id) }}" class="button py-1.5 congratulate flex justify-center items-center flex-col">--}}
{{--                            Поздравить сейчас--}}
{{--                        </a>--}}
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
