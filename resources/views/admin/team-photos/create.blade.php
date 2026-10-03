<x-admin.layout title="Add Team Group Photo">
    <div class="mx-auto max-w-3xl space-y-6">
        <div><a href="{{ route('admin.team-photos.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Team Group Photos</a><h1 class="mt-3 text-2xl font-bold text-navy">Add Team Group Photo</h1><p class="mt-1 text-sm text-muted">Upload a horizontal team photo for the public team page.</p></div>
        <form method="POST" action="{{ route('admin.team-photos.store') }}" enctype="multipart/form-data" class="admin-card p-5 sm:p-6">@include('admin.team-photos._form', ['submitLabel' => 'Add Photo'])</form>
    </div>
</x-admin.layout>
