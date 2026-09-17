<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    /**
     * There is no email/CRM backend wired up yet. We validate the input so the
     * form behaves correctly, then redirect back with a clear "demo" notice
     * instead of pretending the message was actually sent anywhere.
     */
    public function submit(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'company' => ['nullable', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:40'],
            'service' => ['required', 'string', 'max:100'],
            'budget' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        return redirect()->route('contact')->with('demoSubmitted', true);
    }
}
