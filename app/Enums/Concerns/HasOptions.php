<?php

namespace App\Enums\Concerns;

trait HasOptions
{
    public static function options(): array
    {
        return array_combine(
            self::values(),
            array_map('ucfirst', self::values())
        );
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
