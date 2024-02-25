<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailTemplateRequest;
use App\Models\MailTemplate;
use Illuminate\Http\Request;

class MailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mailTemplates = MailTemplate::query()->paginate(10);

        return view('mail-templates.index', compact('mailTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mail-templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MailTemplateRequest $request)
    {
        $validatedData = $request->validated();
        $isCreated = MailTemplate::query()->create($validatedData);

        if ($isCreated) {
            return redirect(route('mail-templates.index'))->with('success-message', 'Шаблон успешно добавлен');
        }

        return redirect(route('mail-templates.index'))->with('error-message', 'Ошибка при добавлении шаблона');
    }

    /**
     * Display the specified resource.
     */
    public function show(MailTemplate $mailTemplate)
    {
        return view('mail-templates.show', compact('mailTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MailTemplate $mailTemplate)
    {
        return view ('mail-templates.edit', compact('mailTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MailTemplateRequest $request, MailTemplate $mailTemplate)
    {
        $validatedData = $request->validated();
        $isUpdated = $mailTemplate->update($validatedData);

        if ($isUpdated) {
            return redirect(route('mail-templates.show', $mailTemplate))->with('success-message', 'Шаблон успешно обновлён');
        }

        return redirect(route('mail-templates.show', $mailTemplate))->with('error-message', 'Ошибка при обновлении шаблона');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MailTemplate $mailTemplate)
    {
        $subject = $mailTemplate->subject;
        $isDeleted = $mailTemplate->delete();

        if ($isDeleted) {
            return redirect(route('mail-templates.index'))->with('success-message', "Шаблон '$subject' успешно удалён");
        }

        return redirect(route('mail-templates.index'))->with('error-message', "Ошибка при удалении шаблона с темой '$subject'");
    }
}
