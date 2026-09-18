<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamMemberRequest;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $members = TeamMember::query()
            ->when(request('q'), fn ($query, $search) => $query->where(function ($query) use ($search): void {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%")
                    ->orWhere('expertise', 'like', "%{$search}%");
            }))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.team.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamMemberRequest $request): RedirectResponse
    {
        $member = TeamMember::create($request->validated() + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.team.show', $member)->with('status', 'Team member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamMember $teamMember): View
    {
        return view('admin.team.show', ['member' => $teamMember]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamMember $teamMember): View
    {
        return view('admin.team.edit', ['member' => $teamMember]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamMemberRequest $request, TeamMember $teamMember): RedirectResponse
    {
        $teamMember->update($request->validated() + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.team.show', $teamMember)->with('status', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        $teamMember->delete();

        return redirect()->route('admin.team.index')->with('status', 'Team member deleted successfully.');
    }
}
