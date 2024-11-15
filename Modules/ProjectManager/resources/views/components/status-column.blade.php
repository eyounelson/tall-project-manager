@php use Illuminate\Support\Js;use Illuminate\Support\Str;use Modules\ProjectManager\Enums\Status; @endphp
@props([
    'status',
    'projects',
])

<div
    class="flex-none w-3/4 lg:w-1/3 h-[70vh] overflow-y-auto bg-grey-100 shadow-lg rounded-lg p-4"
    x-data="{
        handleDrop: (item) => {$wire.updateProjectStatus(item, '{{ $status }}'); $wire.$refresh();},
    }">
    <h2 @class([
        'text-lg font-semibold rounded-t-lg px-4 py-2 mb-4 sticky top-0 z-10',
        'bg-gray-200' => $status === Status::Pending->value,
        'bg-blue-200' => $status === Status::In_Progress->value,
        'bg-green-200' => $status === Status::Completed->value,
    ])>
        {{ $status }}
    </h2>
    <div
        x-sort="handleDrop"
        x-sort:group="statuses">
        @forelse($projects as $project)
            <div x-data="{ expanded: false }"
                 class="bg-white shadow-md rounded-lg p-4 mb-4 transition-all duration-300"
                 x-sort:item="{{ $project->id }}">

                <div @click="expanded = !expanded" class="cursor-pointer flex justify-between" x-sort:handle>
                    <h3 class="text-xl font-bold">{{ $project->name }}</h3>
                    <x-heroicon-s-chevron-down x-show="!expanded" class="h-6"/>
                    <x-heroicon-s-chevron-up x-show="expanded" class="h-6"/>
                </div>

                <!-- Project Description -->
                <p class="text-sm text-gray-700 mt-2">
                    <template x-if="!expanded">
                        <span>{{ Str::limit($project->description) }}</span>
                    </template>
                    <template x-if="expanded">
                        <div>{!! nl2br(e($project->description)) !!}</div>
                    </template>
                </p>

                <!-- Expanded Content -->
                <div x-show="expanded" class="mt-4 space-y-2">
                    <!-- Show full status and details when expanded -->
                    <span class="text-sm text-gray-500">Status: Pending</span>
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Priority: {{ $project->priority }}</span>
                        <span>Start Date: {{ $project->start_date->toDateString() }}</span>
                        <span>End Date: {{ $project->end_date->toDateString() }}</span>
                    </div>
                </div>

                <div class="flex justify-start items-center mt-4 pt-4 border-t border-gray-200">
                    <button
                        @click="$dispatch('open-modal', {name: 'edit-project', meta:{{ Js::encode($project->only('id')) }} }); "
                        class="text-blue-500 hover:underline mr-2" title="Edit">
                        <x-heroicon-s-pencil-square class="h-4"/>
                    </button>
                    <button
                            @click="$dispatch('open-modal', {name: 'delete-project', meta:{{ Js::encode($project->only('id', 'name')) }} })"
                            class="text-red-500 hover:underline ml-2" title="Delete">
                        <x-heroicon-s-archive-box-x-mark class="h-4"/>
                    </button>
                </div>

            </div>
        @empty
            There are no "{{ $status }}" Projects
        @endforelse
    </div>
    {{ $projects->links() }}
</div>
