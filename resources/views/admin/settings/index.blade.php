<x-admin.layout title="Settings">
    <div class="mx-auto max-w-4xl space-y-6">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-accent">System</p>
            <h1 class="mt-1 text-2xl font-bold text-navy">Settings</h1>
            <p class="mt-1 text-sm text-muted">Manage your profile, password, and who can sign in to this dashboard.</p>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
        @endif

        {{-- My Profile --}}
        <div class="admin-card p-5 sm:p-6">
            <h2 class="text-base font-semibold text-navy">My Profile</h2>
            <p class="mt-1 text-sm text-muted">Update the name and email tied to your admin account.</p>

            <form method="POST" action="{{ route('admin.settings.profile') }}" class="mt-5 grid gap-5 sm:grid-cols-2">
                @csrf
                @method('PUT')
                <div>
                    <label for="profile_name" class="text-sm font-medium text-navy">Name</label>
                    <input id="profile_name" name="name" value="{{ old('name', auth()->user()->name) }}" required
                        class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('name', 'updateProfile') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="profile_email" class="text-sm font-medium text-navy">Email</label>
                    <input id="profile_email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required
                        class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('email', 'updateProfile') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" class="admin-btn-primary">Save Profile</button>
                </div>
            </form>
        </div>

        {{-- Change Password --}}
        <div class="admin-card p-5 sm:p-6">
            <h2 class="text-base font-semibold text-navy">Password</h2>
            <p class="mt-1 text-sm text-muted">Choose a new password. You'll need your current password to confirm the change.</p>

            <form method="POST" action="{{ route('admin.settings.password') }}" class="mt-5 grid gap-5 sm:grid-cols-2">
                @csrf
                @method('PUT')
                <div class="sm:col-span-2">
                    <label for="current_password" class="text-sm font-medium text-navy">Current password</label>
                    <input id="current_password" name="current_password" type="password" required
                        class="mt-1.5 w-full max-w-sm rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('current_password', 'updatePassword') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="new_password" class="text-sm font-medium text-navy">New password</label>
                    <input id="new_password" name="password" type="password" required
                        class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('password', 'updatePassword') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="new_password_confirmation" class="text-sm font-medium text-navy">Confirm new password</label>
                    <input id="new_password_confirmation" name="password_confirmation" type="password" required
                        class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" class="admin-btn-primary">Update Password</button>
                </div>
            </form>
        </div>

        {{-- Admin Accounts --}}
        <div class="admin-card overflow-hidden">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-navy/10 p-5 sm:p-6">
                <div>
                    <h2 class="text-base font-semibold text-navy">Admin Accounts</h2>
                        <p class="mt-1 text-sm text-muted">Only active administrators can sign in and manage this dashboard.</p>
                </div>
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
                        @foreach ($admins as $admin)
                            <tr class="hover:bg-surface/70">
                                <td class="px-5 py-4 sm:px-6">
                                    <span class="font-semibold text-navy">{{ $admin->name }}</span>
                                    @if ($admin->is(auth()->user()))
                                        <span class="admin-badge admin-badge-neutral ml-2">You</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-muted sm:px-6">{{ $admin->email }}</td>
                                <td class="px-5 py-4 text-muted sm:px-6">Admin</td>
                                <td class="px-5 py-4 sm:px-6"><span class="admin-badge admin-badge-success">Active</span></td>
                                <td class="px-5 py-4 text-right sm:px-6">
                                    @unless ($admin->is(auth()->user()))
                                        <form method="POST" action="{{ route('admin.settings.users.destroy', $admin) }}"
                                            onsubmit="return confirm('Remove {{ $admin->name }}\'s admin account? They will no longer be able to sign in.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700">Remove</button>
                                        </form>
                                    @else
                                        <span class="text-xs text-muted">—</span>
                                    @endunless
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-navy/10 p-5 sm:p-6">
                <h3 class="text-sm font-semibold text-navy">Add an admin account</h3>
                <form method="POST" action="{{ route('admin.settings.users.store') }}" class="mt-4 grid gap-5 sm:grid-cols-2">
                    @csrf
                    <div>
                        <label for="new_admin_name" class="text-sm font-medium text-navy">Name</label>
                        <input id="new_admin_name" name="name" value="{{ old('name', '') }}" required
                            class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('name', 'storeUser') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="new_admin_email" class="text-sm font-medium text-navy">Email</label>
                        <input id="new_admin_email" name="email" type="email" value="{{ old('email', '') }}" required
                            class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('email', 'storeUser') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="new_admin_password" class="text-sm font-medium text-navy">Password</label>
                        <input id="new_admin_password" name="password" type="password" required
                            class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('password', 'storeUser') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="new_admin_password_confirmation" class="text-sm font-medium text-navy">Confirm password</label>
                        <input id="new_admin_password_confirmation" name="password_confirmation" type="password" required
                            class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" class="admin-btn-primary">Add Admin</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- System Preferences --}}
        <div class="admin-card p-5 sm:p-6">
            <h2 class="text-base font-semibold text-navy">System Preferences</h2>
            <p class="mt-1 text-sm text-muted">Public registration creates standard user accounts only. Admin accounts are managed above.</p>

            <div class="mt-4 flex items-center justify-between rounded-lg border border-navy/10 bg-surface px-4 py-3">
                <div>
                    <p class="text-sm font-medium text-navy">Public admin registration</p>
                    <p class="text-xs text-muted">{{ url('/register') }} is available for standard user registration.</p>
                </div>
                <span class="admin-badge {{ $registrationOpen ? 'admin-badge-warning' : 'admin-badge-success' }}">
                    {{ $registrationOpen ? 'Open' : 'Closed' }}
                </span>
            </div>
        </div>
    </div>
</x-admin.layout>
