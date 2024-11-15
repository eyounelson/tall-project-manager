<?php

namespace Modules\ProjectManager\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\ProjectManager\Models\Project;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Project $project): bool
    {
        return $project->user_id === $user->id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $project->user_id === $user->id;
    }
}
