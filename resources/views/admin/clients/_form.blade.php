@csrf

<div class="grid gap-5 sm:grid-cols-2">
    <div>
        <label for="name" class="text-sm font-medium text-navy">Contact name</label>
        <input id="name" name="name" value="{{ old('name', $client->name ?? '') }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="company" class="text-sm font-medium text-navy">Company</label>
        <input id="company" name="company" value="{{ old('company', $client->company ?? '') }}" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('company') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="email" class="text-sm font-medium text-navy">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $client->email ?? '') }}" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="phone" class="text-sm font-medium text-navy">Phone</label>
        <input id="phone" name="phone" value="{{ old('phone', $client->phone ?? '') }}" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="industry" class="text-sm font-medium text-navy">Industry</label>
        <input id="industry" name="industry" value="{{ old('industry', $client->industry ?? '') }}" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('industry') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="status" class="text-sm font-medium text-navy">Status</label>
        <select id="status" name="status" class="mt-1.5 w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
            @foreach (['active' => 'Active', 'inactive' => 'Inactive'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $client->status ?? 'active') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-5">
    <label for="notes" class="text-sm font-medium text-navy">Notes</label>
    <textarea id="notes" name="notes" rows="5" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('notes', $client->notes ?? '') }}</textarea>
    @error('notes') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="admin-btn-primary">{{ $submitLabel }}</button>
    <a href="{{ route('admin.clients.index') }}" class="admin-btn-secondary">Cancel</a>
</div>
