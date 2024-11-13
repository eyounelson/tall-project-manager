<x-modal name="delete-project" focusable>
   <div class="p-6">
       <p class="my-4">
           Are you sure you want to delete <strong class="font-bold" x-text="`${meta.name}?`"></strong> This cannot be revered.
       </p>
       <x-primary-button class="ms-3" type="button" @click="$dispatch('close')">
           {{ __('Close') }}
       </x-primary-button>
       <x-danger-button class="ms-3" type="button" @click="$wire.deleteProject(meta.id); $dispatch('close')">
           {{ __('Delete') }}
       </x-danger-button>
   </div>
</x-modal>

<x-modal name="edit-project" focusable>
    <template x-on:project-updated.window="
        $dispatch('close-modal', 'edit-project');
        $wire.$refresh();
        "
    ></template>
    <livewire:projectmanager::components.edit-project />
</x-modal>
