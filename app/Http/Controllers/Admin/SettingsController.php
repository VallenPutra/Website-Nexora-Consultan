<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Show the settings page: the current admin's profile, password form,
     * and the list of admin accounts that can sign in to this dashboard.
     */
    public function index(Request $request): View
    {
        return view('admin.settings.index', [
            'admins' => User::query()->orderBy('name')->get(),
            'registrationOpen' => (bool) config('nexora.registration_open'),
        ]);
    }

    /**
     * Update the signed-in admin's own name and email.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validateWithBag('updateProfile', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->update($validated);

        return redirect()->route('admin.settings.index')->with('status', 'Profile updated successfully.');
    }

    /**
     * Change the signed-in admin's own password. Requires the current
     * password so a hijacked, already-open session can't silently lock
     * the real owner out.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update(['password' => $validated['password']]);

        return redirect()->route('admin.settings.index')->with('status', 'Password updated successfully.');
    }

    /**
     * Create another admin account directly from the dashboard, as an
     * alternative to leaving public /register open.
     */
    public function storeUser(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('storeUser', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create($validated);

        return redirect()->route('admin.settings.index')->with('status', 'Admin account created successfully.');
    }

    /**
     * Remove an admin account. An admin can never delete their own
     * account here (to avoid an accidental self-lockout), and the last
     * remaining admin account can't be deleted, so the dashboard always
     * stays reachable by at least one account.
     */
    public function destroyUser(Request $request, User $user): RedirectResponse
    {
        if ($user->is(Auth::user())) {
            return redirect()->route('admin.settings.index')->with('error', "You can't delete your own account while signed in.");
        }

        if (User::count() <= 1) {
            return redirect()->route('admin.settings.index')->with('error', 'At least one admin account must remain.');
        }

        $user->delete();

        return redirect()->route('admin.settings.index')->with('status', 'Admin account removed.');
    }
}
