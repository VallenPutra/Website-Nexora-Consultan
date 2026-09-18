<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConsultationRequestUpdateRequest;
use App\Models\ConsultationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConsultationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $requests = ConsultationRequest::query()
            ->when(request('q'), fn ($query, $search) => $query->where(function ($query) use ($search): void {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }))
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.consultation-requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsultationRequest $consultationRequest): View
    {
        return view('admin.consultation-requests.show', ['requestItem' => $consultationRequest]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConsultationRequest $consultationRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConsultationRequestUpdateRequest $request, ConsultationRequest $consultationRequest): RedirectResponse
    {
        $consultationRequest->update($request->validated());

        return redirect()->route('admin.consultation-requests.show', $consultationRequest)->with('status', 'Consultation request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsultationRequest $consultationRequest): RedirectResponse
    {
        $consultationRequest->delete();

        return redirect()->route('admin.consultation-requests.index')->with('status', 'Consultation request deleted successfully.');
    }
}
