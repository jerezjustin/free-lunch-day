<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';

    case Preparing = 'preparing';

    case Completed = 'completed';

    public static function toArray(): array
    {
        return array_column(static::cases(), 'value');
    }
}
