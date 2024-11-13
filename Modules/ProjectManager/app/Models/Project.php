<?php

namespace Modules\ProjectManager\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\ProjectManager\Enums\Status;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime:Y-m-d',
            'end_date' => 'datetime:Y-m-d',
        ];
    }

    public function scopePending(Builder $builder): Builder
    {
        return $builder->where('status', Status::Pending);
    }

    public function scopeInProgress(Builder $builder): Builder
    {
        return $builder->where('status', Status::In_Progress);
    }

    public function scopeCompleted(Builder $builder): Builder
    {
        return $builder->where('status', Status::Completed);
    }
}
