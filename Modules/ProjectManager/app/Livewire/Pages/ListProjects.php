<?php

namespace Modules\ProjectManager\Livewire\Pages;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\ProjectManager\Enums\Priority;
use Modules\ProjectManager\Models\Project;

class ListProjects extends Component
{
    use WithPagination;

    #[Url]
    public ?string $search = '';

    #[Layout('layouts.app')]
    public function render()
    {
        $pendingProjects = $this->projectQuery()->pending()->simplePaginate(pageName: 'pending_page');
        $inProgressProjects = $this->projectQuery()->inProgress()->simplePaginate(pageName: 'progress_page');
        $completedProjects = $this->projectQuery()->simplePaginate(pageName: 'completed_page');

        return view('projectmanager::livewire.pages.list-projects', [
            'priorities' => Priority::options(),
            'pending_projects' => $pendingProjects,
            'progress_projects' => $inProgressProjects,
            'completed_projects' => $completedProjects,
        ]);
    }

    public function deleteProject(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            $this->dispatch(
                'notification',
                message: 'You don not have the permission to delete this project!',
                variant: 'warning'
            );

            return;
        }

        $project->delete();

        $this->dispatch(
            'notification',
            message: 'The project has been deleted.',
            variant: 'success'
        );
    }

    public function updateProjectStatus(Project $project, $status)
    {
        if ($project->user_id !== auth()->id()) {
            $this->dispatch(
                'notification',
                message: 'You don not have the permission to update this project!',
                variant: 'warning'
            );

            return;
        }

        $project->update(['status' => Str::headline($status)]);

        $this->dispatch(
            'notification',
            message: "Project [$project->name] has been moved to $project->status!",
            variant: 'success'
        );
    }

    private function projectQuery(): Builder
    {
        return Project::when(
            filled($this->search),
            fn ($query) => $query->where('name', 'like', "%$this->search%")
        )
            ->latest('id');
    }
}
