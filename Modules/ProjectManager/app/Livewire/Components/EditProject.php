<?php

namespace Modules\ProjectManager\Livewire\Components;

use Livewire\Component;
use Modules\ProjectManager\Enums\Priority;
use Modules\ProjectManager\Livewire\Forms\ProjectForm;
use Modules\ProjectManager\Models\Project;

class EditProject extends Component
{
    public ?Project $project = null;

    public ProjectForm $form;

    public function render()
    {
        return view('projectmanager::livewire.components.edit-project', [
            'priorities' => Priority::options(),
        ]);
    }

    public function loadProject(Project $project)
    {
        $this->project = $project;

        $this->form->fill($project->only('name', 'description', 'start_date', 'end_date', 'priority'));
    }

    public function save()
    {
        if (! $this->project) {
            $this->dispatch(
                'notification',
                message: 'An error was encountered.',
                variant: 'danger'
            );

            return;
        }

        ProjectForm::$project = $this->project;

        $this->project->update($this->form->validate());

        $this->dispatch(
            'notification',
            message: 'The project has been updated.',
            variant: 'success'
        );

        $this->dispatch('project-updated', id: $this->project->id);
    }
}
