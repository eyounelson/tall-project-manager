@props([
    'disabled' => false,
    'name',
    'wrapClass' => null,
    'label' => null
])

<div class="mt-6">
    <x-input-label for="{{ $attributes->get('id') }}" value="{{ $label = $label ?? $name }}" class="sr-only" />

    <textarea
        @disabled($disabled)
        {{ $attributes->merge([
            'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
              'aria-labelledby' => $attributes->get('aria-label') ?? $label,
            'role' => 'textbox',
            'aria-disabled' => $disabled ? 'true' : 'false',
            ]) }}></textarea>


    <x-input-error
        :messages="$errors->get(
            $attributes->get('wire:model') ?? $name
        )"
        class="mt-2" />
</div>
