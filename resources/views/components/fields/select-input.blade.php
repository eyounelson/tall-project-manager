@props([
    'disabled' => false,
    'name',
    'options',
    'wrapClass' => null,
    'label' => null,
])

<div class="{{ "$wrapClass mt-6" }}">
    <x-input-label for="{{ $attributes->get('id') }}" value="{{ $label = $label ?? Str::headline($name) }}" class="" />

    <select
        @disabled($disabled)
        {{ $attributes->merge([
            'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
           'aria-labelledby' => $attributes->get('aria-label') ?? $label,
            'role' => 'textbox',
            'aria-disabled' => $disabled ? 'true' : 'false',
        ]) }}
    >
        <option value="">Select an option</option>
        @foreach($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

    <x-input-error
        :messages="$errors->get(
            $attributes->get('wire:model') ?? $name
        )"
        class="mt-2" />
</div>
