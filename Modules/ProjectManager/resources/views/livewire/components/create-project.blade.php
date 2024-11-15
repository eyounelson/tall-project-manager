<div class="py-12 flex justify-end">
    <template x-on:project-created.window="
        $dispatch('close-modal', 'create-project');"
    ></template>

    <x-primary-button
        class="mr-6 lg:mr-8"
        x-on:click.prevent="$dispatch('open-modal', {name:'create-project'})"
    >
        Create Project
    </x-primary-button>
    <x-modal name="create-project" focusable>
        <x-slot name="heading">Create Project</x-slot>
        <x-projectmanager::form :priorities="$priorities" />
    </x-modal>
</div>
