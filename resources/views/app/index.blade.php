@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="flex items-center justify-center col-span-2 py-16">
            <div class="text-3xl">
                Сегодня {{ \Carbon\Carbon::now()->locale('ru')->translatedFormat('j F Y, l') }}
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 sm:grid-rows-1 row-start-2 gap-5 pb-16">
            <x-section-link :route="route('mail-log.index')" :text="'Отправленные поздравления'"></x-section-link>
            <x-section-link :route="route('manual-congratulations.index')" :text="'Поздравить вручную'"></x-section-link>
            <x-section-link :route="route('administrative.index')" :text="'Сотрудники и их должности'"></x-section-link>
            <x-section-link :route="route('mail-templates.index')" :text="'Шаблоны поздравлений'"></x-section-link>
        </div>
        <div class="flex flex-nowrap items-center overflow-x-auto bg-slate-700 rounded-3xl h-48 py-2 px-5 relative scroll-smooth">
            <div class="flex justify-center items-center z-0 absolute ml-auto mr-auto left-0 right-0 text-center w-11/12">
                @if($birthdayPeople->count() > 0)
                    <img src="{{ asset('icons/birthday-people-background-text.svg') }}" alt="Именинники">
                @else
                    <img src="{{ asset('icons/without-birthday-people-background-text.svg') }}" alt="Сегодня без именинников">
                @endif
            </div>
            @php /** @var \App\Models\Employee $employee */ @endphp
            @foreach($birthdayPeople as $employee)
                <div class="px-10 min-w-[60%] xl:min-w-[22%] h-full flex justify-around items-center flex-col mx-2 z-10 bg-slate-800 rounded-3xl hover:scale-105 transition-all">
                    <div class="">
                        <span class="full-name font-bold">{{ $employee->getFullName() }}</span>
                    </div>
                    <div class="flex justify-center">
                        @if ($employee->mailLog)
                            <span class="text-center">
                                Поздравили в {{ \Carbon\Carbon::make($employee->maillog->created_at)->format('H:i') }} 🎉
                            </span>
                        @else
                            <span class="text-center">
                                Скоро поздравим 🤫
                            </span>
                        @endif
                    </div>
                    @if ($employee->mailLog)
                        <a href="{{ route('mail-log.index') }}" class="p-1.5 w-full flex justify-center items-center flex-col bg-green-500 rounded-3xl hover:scale-105 transition-all">
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
