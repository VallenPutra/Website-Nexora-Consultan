<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamGroupPhotoRequest;
use App\Models\TeamGroupPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeamGroupPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $photos = TeamGroupPhoto::query()->orderBy('sort_order')->orderBy('id')->paginate(12);

        return view('admin.team-photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.team-photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamGroupPhotoRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['image_path'] = $request->file('image')->store('team/group', 'public');
        unset($validated['image']);

        TeamGroupPhoto::create($validated + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.team-photos.index')->with('status', 'Team photo added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamGroupPhoto $teamGroupPhoto): View
    {
        return view('admin.team-photos.edit', ['photo' => $teamGroupPhoto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamGroupPhotoRequest $request, TeamGroupPhoto $teamGroupPhoto): RedirectResponse
    {
        $validated = $request->validated();
        $oldImagePath = null;

        if ($request->hasFile('image')) {
            $oldImagePath = $teamGroupPhoto->image_path;
            $validated['image_path'] = $request->file('image')->store('team/group', 'public');
        }

        unset($validated['image']);
        $teamGroupPhoto->update($validated + ['is_active' => $request->boolean('is_active')]);

        if ($oldImagePath !== null) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()->route('admin.team-photos.index')->with('status', 'Team photo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamGroupPhoto $teamGroupPhoto): RedirectResponse
    {
        $imagePath = $teamGroupPhoto->image_path;
        $teamGroupPhoto->delete();
        Storage::disk('public')->delete($imagePath);

        return redirect()->route('admin.team-photos.index')->with('status', 'Team photo deleted successfully.');
    }
}
