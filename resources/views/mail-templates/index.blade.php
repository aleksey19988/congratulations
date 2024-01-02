@extends('layouts.header')
@section('content')
    <div class="container mx-auto">
        <div class="py-5">
            <x-back-link :route="route('app.index')" :text="'Назад'"></x-back-link>
        </div>
        <div class="flex flex-col items-center py-16">
            <div class="text-3xl">Шаблоны поздравлений</div>
            <a href="{{ route('mail-templates.create') }}"
               class="py-1 flex justify-center w-9/12 lg:w-3/12 mt-3 bg-green-500 rounded-3xl text-xl hover:scale-105 transition-all">Добавить шаблон</a>
        </div>
        @if(session('message'))
            <div class="w-full p-5 bg-green-500 rounded-3xl">
                <span class="text-xl">{{session('message')}}</span>
            </div>
        @endif
        @if($mailTemplates->count())
            {{ $mailTemplates->links('vendor.pagination.tailwind') }}
            <div class="">
                <div class="bg-slate-700 rounded-3xl grid grid-cols-3 lg:grid-cols-7 py-3 my-3 gap-x-5">
                    <div class="col-span-2 hidden lg:flex lg:items-center lg:justify-center">
                        <span class="text-xl font-bold">Тема письма</span>
                    </div>
                    <div class="col-span-2 lg:col-span-4 flex items-center justify-center">
                        <span class="text-xl font-bold">Тело письма</span>
                    </div>
                    <div class="flex items-center justify-evenly lg:col-start-7">
                        <span class="text-xl font-bold">Действия</span>
                    </div>
                </div>
                @php /** @var \App\Models\MailTemplate $mailTemplate */ @endphp
                @foreach($mailTemplates as $mailTemplate)
                    <div class="bg-slate-700 rounded-3xl grid grid-cols-3 lg:grid-cols-7 p-3 my-3">
                        <div class="col-span-2 hidden lg:flex lg:items-center lg:justify-center px-3">
                            <span class="">{{ $mailTemplate->subject }}</span>
                        </div>
                        <div class="col-span-2 lg:col-span-4 flex items-center justify-center">
                            <span class="">{{ (strlen($mailTemplate->body) > 200) ? mb_substr($mailTemplate->body, 0, 200) . '...' : $mailTemplate->body}}</span>
                        </div>
                        <div class="lg:col-start-7 flex items-center justify-evenly">
                            <a href="{{ route('mail-templates.show', $mailTemplate->id) }}"
                               class="flex justify-center items-center w-2/5 p-1 py-2 bg-slate-950 rounded-3xl hover:scale-105 transition-all">
                                <img src="{{ asset('icons/document.svg') }}" alt="Подробнее" class="h-5">
                            </a>
                            <form action="{{ route('mail-templates.destroy', $mailTemplate->id) }}" method="post" class="flex items-center justify-center w-2/5 p-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full hover:scale-105 transition-all">
                                    <a href="" class="flex justify-center items-center py-2 bg-red-500 rounded-3xl">
                                        <img src="{{ asset('icons/delete-document.svg') }}" alt="Удалить шаблон" class="h-5">
                                    </a>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="w-full flex justify-center">
                <p class="text-xl">Нет ни одного шаблона &#128532;</p>
            </div>
        @endif
    </div>
@endsection
