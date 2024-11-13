<div>
    <template x-on:notification.window="$dispatch('notify', { variant: $event.detail.variant, title: $event.detail.title || 'Notice', message: $event.detail.message })" ></template>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <livewire:projectmanager::components.create-project @project-created="$refresh" />

    <div class="mb-6 lg:mr-8 flex justify-center">
        <x-fields.text-input
            wire:model.live.debounce.200ms="search"
            name="search"
            id="search"
            wrap-class="lg:w-5/12 sm:w-full"
            class="block w-full"
            placeholder="Type to search" />
    </div>

    <div class="flex overflow-x-auto space-x-4 p-4">
       <x-projectmanager::status-column status="Pending" :projects="$pending_projects" />
       <x-projectmanager::status-column status="In Progress" :projects="$progress_projects" />
       <x-projectmanager::status-column status="Completed" :projects="$completed_projects" />
    </div>


    <x:projectmanager::modals />
    <x-plugins.toasts />
</div>

