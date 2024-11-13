@props([
    'disabled' => false,
    'name',
    'wrapClass' => null,
    'label' => null,
])

<div class="{{ "$wrapClass mt-6" }}">
    <x-input-label for="{{ $attributes->get('id') }}" value="{{ $label ?? Str::headline($name) }}" class="" />

    <input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>


    <x-input-error
        :messages="$errors->get(
            $attributes->get('wire:model') ?? $name
        )"
        class="mt-2" /></div>
