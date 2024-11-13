@props([
    'priorities'
])
<form wire:submit.prevent="save" class="p-6" wire:loading.attr="disabled">
    @csrf

    <x-fields.text-input
        wire:model="form.name"
        name="name"
        id="name"
        class="mt-1 block w-full"
        placeholder="Name" />

    <x-fields.textarea-input
        wire:model="form.description"
        name="description"
        id="description"
        class="mt-1 block w-full"
        rows="3" placeholder="Description" />

    <div class="flex flex-wrap">
        <x-fields.text-input
            wire:model="form.start_date"
            wrap-class="w-1/2 pr-2"
            type="date"
            name="start_date"
            id="start-date"
            class="mt-1 block w-full"
            placeholder="Start Date" />

        <x-fields.text-input
            wire:model="form.end_date"
            wrap-class="w-1/2 pl-2"
            type="date"
            name="end_date"
            id="end-date"
            class="mt-1 block w-full"
            placeholder="End Date" />
    </div>

    <x-fields.select-input
        wire:model="form.priority"
        name="priority"
        id="priority"
        :options="$priorities"
        class="block w-full"/>

    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-primary-button class="ms-3" type="submit">
            {{ __('Submit') }}
        </x-primary-button>
    </div>
</form>
