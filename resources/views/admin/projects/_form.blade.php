@csrf

<div class="grid gap-5 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label for="name" class="text-sm font-medium text-navy">Project name</label>
        <input id="name" name="name" value="{{ old('name', $project->name ?? '') }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="client_id" class="text-sm font-medium text-navy">Client</label>
        <select id="client_id" name="client_id" required class="mt-1.5 w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
            <option value="">Select a client</option>
            @foreach ($clients as $clientOption)
                <option value="{{ $clientOption->id }}" @selected((string) old('client_id', $project->client_id ?? '') === (string) $clientOption->id)>{{ $clientOption->name }}{{ $clientOption->company ? ' — '.$clientOption->company : '' }}</option>
            @endforeach
        </select>
        @error('client_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="service" class="text-sm font-medium text-navy">Service</label>
        <input id="service" name="service" value="{{ old('service', $project->service ?? '') }}" placeholder="e.g. Web Development" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('service') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="progress" class="text-sm font-medium text-navy">Progress (%)</label>
        <input id="progress" name="progress" type="number" min="0" max="100" value="{{ old('progress', $project->progress ?? 0) }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('progress') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="status" class="text-sm font-medium text-navy">Status</label>
        <select id="status" name="status" required class="mt-1.5 w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
            @foreach (['planning' => 'Planning', 'in_progress' => 'In Progress', 'on_review' => 'On Review', 'completed' => 'Completed'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $project->status ?? 'planning') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="deadline" class="text-sm font-medium text-navy">Deadline</label>
        <input id="deadline" name="deadline" type="date" value="{{ old('deadline', isset($project) && $project->deadline ? $project->deadline->format('Y-m-d') : '') }}" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('deadline') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-5">
    <label for="description" class="text-sm font-medium text-navy">Description</label>
    <textarea id="description" name="description" rows="5" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('description', $project->description ?? '') }}</textarea>
    @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="admin-btn-primary">{{ $submitLabel }}</button>
    <a href="{{ route('admin.projects.index') }}" class="admin-btn-secondary">Cancel</a>
</div>
