<?php

namespace Modules\ProjectManager\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Modules\ProjectManager\Enums\Priority;
use Modules\ProjectManager\Enums\Status;
use Modules\ProjectManager\Models\Project;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->catchPhrase(),
            'description' => fake()->sentences(asText: true),
            'status' => Status::Pending,
            'priority' => Arr::random(Priority::values()),
            'start_date' => $startDate = fake()->date(max: 'yesterday'),
            'end_date' => Carbon::parse($startDate)->addDays(),
        ];
    }
}
