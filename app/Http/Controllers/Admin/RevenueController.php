<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RevenueRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\Revenue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $revenues = Revenue::query()
            ->with(['client', 'project'])
            ->when(request('q'), fn ($query, $search) => $query->where(function ($query) use ($search): void {
                $query->where('description', 'like', "%{$search}%")
                    ->orWhereHas('client', fn ($clientQuery) => $clientQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%"));
            }))
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->latest('invoice_date')
            ->paginate(12)
            ->withQueryString();

        return view('admin.revenue.index', [
            'revenues' => $revenues,
            'totals' => [
                'paid' => Revenue::paid()->sum('amount'),
                'pending' => Revenue::where('status', 'pending')->sum('amount'),
                'overdue' => Revenue::where('status', 'overdue')->sum('amount'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.revenue.create', $this->formOptions());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RevenueRequest $request): RedirectResponse
    {
        $revenue = Revenue::create($request->validated());

        return redirect()->route('admin.revenue.show', $revenue)
            ->with('status', 'Revenue entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Revenue $revenue): View
    {
        $revenue->load(['client', 'project']);

        return view('admin.revenue.show', compact('revenue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revenue $revenue): View
    {
        return view('admin.revenue.edit', [
            'revenue' => $revenue,
            ...$this->formOptions(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RevenueRequest $request, Revenue $revenue): RedirectResponse
    {
        $revenue->update($request->validated());

        return redirect()->route('admin.revenue.show', $revenue)
            ->with('status', 'Revenue entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue): RedirectResponse
    {
        $revenue->delete();

        return redirect()->route('admin.revenue.index')
            ->with('status', 'Revenue entry deleted successfully.');
    }

    /**
     * Mark a pending or overdue entry as paid today.
     */
    public function markPaid(Revenue $revenue): RedirectResponse
    {
        $revenue->update([
            'status' => 'paid',
            'paid_at' => $revenue->paid_at ?? now()->format('Y-m-d'),
        ]);

        return back()->with('status', 'Marked "'.$revenue->description.'" as paid.');
    }

    /**
     * Shared dropdown data for the create/edit forms.
     *
     * @return array{clients: Collection, projects: Collection}
     */
    private function formOptions(): array
    {
        return [
            'clients' => Client::query()->orderBy('name')->get(),
            'projects' => Project::query()->with('client')->orderBy('name')->get(),
        ];
    }
}
