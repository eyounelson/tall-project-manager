<?php

namespace Modules\ProjectManager\Enums;

use App\Enums\Concerns\HasOptions;

enum Status: string
{
    use HasOptions;

    case Pending = 'Pending';
    case In_Progress = 'In Progress';
    case Completed = 'Completed';
}
