<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationRequestStoreRequest;
use App\Models\ConsultationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    /** Store a consultation request submitted through the public contact form. */
    public function submit(ConsultationRequestStoreRequest $request): RedirectResponse
    {
        ConsultationRequest::create($request->validated());

        return redirect()->route('contact')->with('submitted', true);
    }
}
