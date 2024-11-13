<div
    x-init="$watch('meta.id', value => value ? $wire.loadProject(value) : null )"
>
    <x-projectmanager::form :priorities="$priorities" />
</div>
