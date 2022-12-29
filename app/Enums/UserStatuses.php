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
            self::INACTIVE => 'bg-warning',
        };
    }

    public function icon(): string
    {
        return match($this)
        {
            self::ACTIVE => 'fe fe-check fe-12',
            self::INACTIVE => 'fe fe-x fe-12',
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
