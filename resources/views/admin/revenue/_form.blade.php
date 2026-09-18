@csrf

<div class="grid gap-5 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label for="description" class="text-sm font-medium text-navy">Description</label>
        <input id="description" name="description" value="{{ old('description', $revenue->description ?? '') }}" placeholder="e.g. Website Development — Phase 1" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="client_id" class="text-sm font-medium text-navy">Client</label>
        <select id="client_id" name="client_id" required class="mt-1.5 w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
            <option value="">Select a client</option>
            @foreach ($clients as $clientOption)
                <option value="{{ $clientOption->id }}" @selected((string) old('client_id', $revenue->client_id ?? '') === (string) $clientOption->id)>{{ $clientOption->name }}{{ $clientOption->company ? ' — '.$clientOption->company : '' }}</option>
            @endforeach
        </select>
        @error('client_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="project_id" class="text-sm font-medium text-navy">Project <span class="font-normal text-muted">(optional)</span></label>
        <select id="project_id" name="project_id" class="mt-1.5 w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
            <option value="">No project — general invoice</option>
            @foreach ($projects as $projectOption)
                <option value="{{ $projectOption->id }}" @selected((string) old('project_id', $revenue->project_id ?? '') === (string) $projectOption->id)>{{ $projectOption->name }} ({{ $projectOption->client->company ?: $projectOption->client->name }})</option>
            @endforeach
        </select>
        @error('project_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="amount" class="text-sm font-medium text-navy">Amount (IDR)</label>
        <input id="amount" name="amount" type="number" min="0" step="1000" value="{{ old('amount', $revenue->amount ?? '') }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('amount') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="status" class="text-sm font-medium text-navy">Status</label>
        <select id="status" name="status" required class="mt-1.5 w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
            @foreach (['pending' => 'Pending', 'paid' => 'Paid', 'overdue' => 'Overdue'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $revenue->status ?? 'pending') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="invoice_date" class="text-sm font-medium text-navy">Invoice date</label>
        <input id="invoice_date" name="invoice_date" type="date" value="{{ old('invoice_date', isset($revenue) ? $revenue->invoice_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('invoice_date') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="paid_at" class="text-sm font-medium text-navy">Paid on <span class="font-normal text-muted">(optional)</span></label>
        <input id="paid_at" name="paid_at" type="date" value="{{ old('paid_at', isset($revenue) && $revenue->paid_at ? $revenue->paid_at->format('Y-m-d') : '') }}" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('paid_at') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="admin-btn-primary">{{ $submitLabel }}</button>
    <a href="{{ route('admin.revenue.index') }}" class="admin-btn-secondary">Cancel</a>
</div>
