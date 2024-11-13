<?php

namespace Modules\ProjectManager\Enums;

use App\Enums\Concerns\HasOptions;

enum Priority: string
{
    use HasOptions;

    case High = 'High';

    case Medium = 'Medium';

    case Low = 'Low';
}
