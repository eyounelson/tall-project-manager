<?php

namespace Modules\ProjectManager\Livewire\Forms;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;
use Modules\ProjectManager\Enums\Priority;
use Modules\ProjectManager\Models\Project;

class ProjectForm extends Form
{
    public ?string $name = null;

    public ?string $description = null;

    public ?string $start_date = null;

    public ?string $end_date = null;

    public ?string $priority = null;

    public static ?Project $project = null;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'between:4,200',
                Rule::unique(Project::class, 'name')
                    ->where('user_id', auth()->id())
                    ->ignore(self::$project?->id),
            ],
            'description' => [
                'required',
                'between:10, 1000',
            ],
            'start_date' => [
                'required',
                'date',
                'before:end_date',
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
            ],
            'priority' => [
                'required',
                new Enum(Priority::class),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'You have an existing project with this title.',
        ];
    }
}
