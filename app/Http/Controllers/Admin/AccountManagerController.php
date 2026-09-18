<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AccountManagerController extends Controller
{
    public function index(): View
    {
        return view('admin.account-manager.index', [
            'users' => User::query()->where('role', 'user')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User($validated);
        $user->role = 'user';
        $user->save();

        return redirect()->route('admin.account-manager.index')->with('status', 'User account created successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_unless($user->role === 'user', 404);

        $user->delete();

        return redirect()->route('admin.account-manager.index')->with('status', 'User account removed.');
    }
}
