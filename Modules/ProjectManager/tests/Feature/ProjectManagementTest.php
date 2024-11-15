<?php

use App\Models\User;
use Livewire\Livewire;
use Modules\ProjectManager\Database\Factories\ProjectFactory;
use Modules\ProjectManager\Enums\Status;
use Modules\ProjectManager\Livewire\Components\CreateProject;
use Modules\ProjectManager\Livewire\Components\EditProject;
use Modules\ProjectManager\Livewire\Pages\ListProjects;
use Modules\ProjectManager\Models\Project;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class);

pest()->beforeEach(function () {
    $this->user = User::factory()->create();
});

test('projects can be listed', function () {
   $user = User::factory()->create();

   $projects = ProjectFactory::new()
       ->sequence(fn($sequence) => [
           'status' => match($sequence->index) {
                0 => Status::Pending,
                1 => Status::In_Progress,
                2 => Status::Completed,
           }
       ])
       ->count(3)
       ->create(['user_id' => $this->user->id]);

   actingAs($this->user)->get('/project-manager')
       ->assertSuccessful()
       ->assertSee('Create Project')
       ->assertSee($projects[0]->name)
       ->assertSee($projects[1]->name)
       ->assertSee($projects[2]->name);
});


test('project can be created', function () {
    $data = ProjectFactory::new()->make();

    Livewire::actingAs($this->user)
        ->test(CreateProject::class)
        ->set('form.name', $data->name)
        ->set('form.description', $data->description)
        ->set('form.start_date', '2024-01-01')
        ->set('form.end_date', '2024-02-01')
        ->set('form.priority', 'Low')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('project-created');

    assertDatabaseHas(Project::class, [
        'name' => $data->name,
        'user_id' => $this->user->id,
    ]);
});

test('project can be edited', function () {
    $project = ProjectFactory::new()->create(['user_id' => $this->user->id]);

    Livewire::actingAs($this->user)
        ->test(EditProject::class)
        ->call('loadProject', $project->id)
        ->set('form.name', 'An Updated Project Name')
        ->set('form.description', $project->description)
        ->set('form.start_date', '2024-01-01')
        ->set('form.end_date', '2024-02-01')
        ->set('form.priority', 'Low')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('project-updated');

    assertDatabaseHas(Project::class, [
        'id' => $project->id,
        'name' => 'An Updated Project Name',
        'user_id' => $this->user->id,
    ]);
});

test('project can be deleted', function () {
    $project = ProjectFactory::new()->create(['user_id' => $this->user->id]);

    Livewire::actingAs($this->user)
        ->test(ListProjects::class)
        ->call('deleteProject', $project->id)
        ->assertHasNoErrors();

    assertDatabaseMissing(Project::class, [
        'id' => $project->id,
        'user_id' => $this->user->id,
    ]);
});

test('project status can be updated via drag and drop', function () {
    /**
     * AlpineJs Sort plugin handles the drag and drop
     * we will test that the callback function after drop updates the
     * project status
     */
    $project = ProjectFactory::new()->create(['user_id' => $this->user->id]);

    Livewire::actingAs($this->user)
        ->test(ListProjects::class)
        ->call('updateProjectStatus', $project->id, 'Completed')
        ->assertSuccessful();

    assertDatabaseHas(Project::class, [
        'id' => $project->id,
        'status' => 'Completed'
    ]);
});
