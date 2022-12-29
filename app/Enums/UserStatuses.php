<?php

namespace App\Enums;

enum UserStatuses: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;

    public function color(): string
    {
        return match($this)
        {
            self::ACTIVE => 'bg-success',
            self::INACTIVE => 'bg-danger',
        };
    }

    public function icon(): string
    {
        return match($this)
        {
            self::ACTIVE => 'bx bx-check-double',
            self::INACTIVE => 'bx bx-block',
        };
    }

    public function lang(): string
    {
        return match($this)
        {
            self::ACTIVE => __('lang.active'),
            self::INACTIVE => __('lang.inactive'),
        };
    }
}
