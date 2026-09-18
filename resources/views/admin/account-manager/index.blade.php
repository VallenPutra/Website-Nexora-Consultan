<x-admin.layout title="Account Manager">
    <div class="mx-auto max-w-5xl space-y-6">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-accent">System</p>
            <h1 class="mt-1 text-2xl font-bold text-navy">Account Manager</h1>
            <p class="mt-1 text-sm text-muted">Create and remove standard user accounts. These accounts cannot access the admin dashboard.</p>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
        @endif

        <div class="admin-card overflow-hidden">
            <div class="border-b border-navy/10 p-5 sm:p-6">
                <h2 class="text-base font-semibold text-navy">Create User Account</h2>
                <p class="mt-1 text-sm text-muted">New accounts are always created with the User role.</p>

                <form method="POST" action="{{ route('admin.account-manager.store') }}" class="mt-5 grid gap-5 sm:grid-cols-2">
                    @csrf
                    <div>
                        <label for="new_user_name" class="text-sm font-medium text-navy">Name</label>
                        <input id="new_user_name" name="name" value="{{ old('name') }}" required
                            class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="new_user_email" class="text-sm font-medium text-navy">Email</label>
                        <input id="new_user_email" name="email" type="email" value="{{ old('email') }}" required
                            class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="new_user_password" class="text-sm font-medium text-navy">Password</label>
                        <input id="new_user_password" name="password" type="password" required
                            class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="new_user_password_confirmation" class="text-sm font-medium text-navy">Confirm password</label>
                        <input id="new_user_password_confirmation" name="password_confirmation" type="password" required
                            class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" class="admin-btn-primary">Create User</button>
                    </div>
                </form>
            </div>

            <div>
                <div class="border-b border-navy/10 p-5 sm:p-6">
                    <h2 class="text-base font-semibold text-navy">User Accounts</h2>
                    <p class="mt-1 text-sm text-muted">Manage standard users who can sign in to the public website.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-navy/10 text-xs uppercase tracking-wide text-muted">
                            <tr>
                                <th class="px-5 py-3 font-medium sm:px-6">Name</th>
                                <th class="px-5 py-3 font-medium sm:px-6">Email</th>
                                <th class="px-5 py-3 font-medium sm:px-6">Role</th>
                                <th class="px-5 py-3 font-medium sm:px-6">Status</th>
                                <th class="px-5 py-3 text-right font-medium sm:px-6">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-navy/5">
                            @forelse ($users as $user)
                                <tr class="hover:bg-surface/70">
                                    <td class="px-5 py-4 font-semibold text-navy sm:px-6">{{ $user->name }}</td>
                                    <td class="px-5 py-4 text-muted sm:px-6">{{ $user->email }}</td>
                                    <td class="px-5 py-4 text-muted sm:px-6">User</td>
                                    <td class="px-5 py-4 sm:px-6"><span class="admin-badge admin-badge-success">Active</span></td>
                                    <td class="px-5 py-4 text-right sm:px-6">
                                        <form method="POST" action="{{ route('admin.account-manager.destroy', $user) }}"
                                            onsubmit="return confirm('Remove {{ $user->name }}\'s user account?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-8 text-center text-sm text-muted sm:px-6">No user accounts yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
