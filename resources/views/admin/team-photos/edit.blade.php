<x-admin.layout title="Edit Team Group Photo">
    <div class="mx-auto max-w-3xl space-y-6">
        <div><a href="{{ route('admin.team-photos.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Team Group Photos</a><h1 class="mt-3 text-2xl font-bold text-navy">Edit Team Group Photo</h1><p class="mt-1 text-sm text-muted">Update {{ $photo->title }}.</p></div>
        @if (session('status'))<div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('admin.team-photos.update', $photo) }}" enctype="multipart/form-data" class="admin-card p-5 sm:p-6">@method('PUT')@include('admin.team-photos._form', ['submitLabel' => 'Save Changes'])</form>
    </div>
</x-admin.layout>
