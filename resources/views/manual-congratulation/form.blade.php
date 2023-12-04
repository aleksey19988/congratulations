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
        <div class="form-container flex flex-col items-center">
            <div class="section-header-container flex justify-center py-16">
                <div class="section-name">Ручная отправка поздравления</div>
            </div>
            <div class="manual-congratulation-form-container">
                <form action="{{ route('manual-congratulations.send') }}" method="post" class="add-employee-form flex flex-col">
                    @csrf
                    <div class="m-3">
                        <label for="employee_id">Сотрудник</label>
                        <select id="employee_id" name="employee_id"
                                class="input-field w-96 h-12 p-3 block border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @php /** @var \App\Models\Employee $employee */ @endphp
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->getFullName() }} ({{ $employee->position->name }})</option>
                            @endforeach
                        </select>
                        @error('employee_id')
                        <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="m-3">
                        <label for="mail_template_id">Шаблон поздравления</label>
                        <select id="mail_template_id" name="mail_template_id"
                                class="input-field w-96 h-12 p-3 block border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @php /** @var \App\Models\MailTemplate $mailTemplate */ @endphp
                            @foreach($mailTemplates as $mailTemplate)
                                <option value="{{ $mailTemplate->id }}">{{ $mailTemplate->body }}</option>
                            @endforeach
                        </select>
                        @error('mail_template_id')
                        <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="m-3">
                        <input
                            type="text"
                            name="company_name"
                            class="@error('company_name') border-2 border-rose-500 @enderror input-field my-3 w-96 p-3"
                            placeholder="Имя компании"
                            value="{{ old('company_name') }}"
                        >
                        @error('company_name')
                        <div class="error-message text-rose-500 flex justify-center">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="send-manual-congratulation-form-button m-3 w-96 p-3"
                            id="form-button">Отправить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
