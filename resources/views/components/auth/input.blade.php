@props(['label', 'name', 'type' => 'text', 'value' => null, 'required' => true, 'autofocus' => false, 'autocomplete' => null])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-navy mb-1.5">{{ $label }}</label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        @if ($required) required @endif
        @if ($autofocus) autofocus @endif
        @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        {{ $attributes->merge(['class' => 'w-full rounded-lg border px-3.5 py-2.5 text-sm text-charcoal placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-accent/30 '.($errors->has($name) ? 'border-red-400 focus:border-red-400' : 'border-navy/15 focus:border-accent')]) }}
    >
    @error($name)
        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
