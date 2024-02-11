@php
    /**
     * @var App\Models\forms\ManualCongratulationForm $form
     * @var \Illuminate\Support\Collection $employees
     * @var \Illuminate\Support\Collection $mailTemplates
     */
@endphp
@extends('layouts.header')
@section('content')
    <div class="container mx-auto ">
        <div class="py-5">
            <x-back-link :route="route('app.index')" :text="'Назад'"></x-back-link>
        </div>
        @if(session('success-message'))
            <div class="w-full p-5 bg-green-500 rounded-3xl">
                <span class="text-xl">{{session('success-message')}}</span>
            </div>
        @elseif(session('error-message'))
            <div class="w-full p-5 bg-red-500 rounded-3xl">
                <span class="text-xl">{{session('error-message')}}</span>
            </div>
        @endif
        <div class="flex flex-col items-center">
            <div class="flex justify-center py-16">
                <div class="text-3xl font-bold">Ручная отправка поздравления</div>
            </div>
            <div class="">
                <form action="{{ route('manual-congratulations.send') }}" method="post"
                      class="flex flex-col">
                    @csrf

                    <div class="mb-3 flex justify-center flex-col">
                        <label for="employee_id">Сотрудник</label>
                        <select
                            id="employee_id"
                            name="employee_id"
                            class="
                                w-full
                                md:w-3/4
                                lg:w-1/2
                                border-gray-300
                                dark:border-gray-700
                                dark:bg-gray-900
                                dark:text-gray-300
                                focus:border-indigo-500
                                dark:focus:border-emerald-600
                                focus:ring-emerald-600
                                rounded-3xl
                                shadow-sm
                            ">
                            @php /** @var \App\Models\Employee $employee */ @endphp
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->getFullName() }}
                                    ({{ $employee->position->name }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2"/>
                    </div>

                    <div class="mb-3 flex justify-center flex-col">
                        <label for="mail_template_id">Шаблон поздравления</label>
                        <select
                            id="mail_template_id"
                            name="mail_template_id"
                            class="
                                w-full
                                md:w-3/4
                                lg:w-1/2
                                border-gray-300
                                dark:border-gray-700
                                dark:bg-gray-900
                                dark:text-gray-300
                                focus:border-indigo-500
                                dark:focus:border-emerald-600
                                focus:ring-emerald-600
                                rounded-3xl
                                shadow-sm
                            ">
                            @php /** @var \App\Models\MailTemplate $mailTemplate */ @endphp
                            @foreach($mailTemplates as $mailTemplate)
                                <option
                                    value="{{ $mailTemplate->id }}"
                                @if($mailTemplate->id == old('mail_template_id'))
                                    {{ 'selected' }}
                                    @endif
                                >
                                    {{ $mailTemplate->body }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('mail_template_id')" class="mt-2"/>
                    </div>
                    <div class="mb-3 flex justify-center flex-col">
                        <label for="company_name_id">Имя компании</label>
                        <x-text-input
                            type="text"
                            id="company_name_id"
                            name="company_name"
                            class="
                                p-3
                                w-full
                                md:w-3/4
                                lg:w-1/2"
                            placeholder="Имя компании"
                            value="{{ old('company_name') }}"
                        ></x-text-input>
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2"/>
                    </div>
                    <button
                        type="submit"
                        class=" w-full md:w-3/4 lg:w-1/2 my-3 p-3 bg-green-500 rounded-3xl text-xl hover:scale-105 transition-all"
                        id="form-button">
                        Отправить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
