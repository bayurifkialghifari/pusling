<?php

namespace App\Enums;

enum StatusEnum : int
{
    case PENDING = 0;
    case APPROVED = 1;
    case REJECTED = -1;

    public static function getDescription(int $status): string
    {
        return match ($status) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
            default => 'Unknown',
        };
    }

    public static function getValues(): array
    {
        return [
            self::PENDING,
            self::APPROVED,
            self::REJECTED,
        ];
    }
}
