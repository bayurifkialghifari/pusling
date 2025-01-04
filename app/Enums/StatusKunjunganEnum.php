<?php

namespace App\Enums;

enum StatusKunjunganEnum : int
{
    case PENDING = 0;
    case ONGOING = 1;
    case DONE = 2;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::ONGOING => 'Ongoing',
            self::DONE => 'Done',
            default => 'Unknown',
        };
    }

    public static function getValues(): array
    {
        return [
            self::PENDING,
            self::ONGOING,
            self::DONE,
        ];
    }
}
