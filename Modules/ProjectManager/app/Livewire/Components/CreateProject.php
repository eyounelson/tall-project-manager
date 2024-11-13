<?php

namespace Modules\ProjectManager\Livewire\Components;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\ProjectManager\Enums\Priority;
use Modules\ProjectManager\Enums\Status;
use Modules\ProjectManager\Livewire\Forms\ProjectForm;
use Modules\ProjectManager\Models\Project;

class CreateProject extends Component
{
    public Project $project;

    public ProjectForm $form;

    public function render()
    {
        return view('projectmanager::livewire.components.create-project', [
            'priorities' => Priority::options(),
        ]);
    }

    public function save()
    {
        DB::transaction(fn () => $this->saveProject());
    }

    private function saveProject(): void
    {
        $data = array_merge($this->form->validate(), [
            'user_id' => auth()->id(),
            'status' => Status::Pending,
        ]);

        $project = Project::create($data);

        $this->dispatch(
            'notification',
            message: "Project [$project->name] has been created.",
            variant: 'success'
        );

        $this->dispatch('project-created');
    }
}
