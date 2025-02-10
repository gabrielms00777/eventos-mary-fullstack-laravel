<?php

namespace App\Enums;

enum EventStatusEnum: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case CANCELED = 'canceled';
    case COMPLETED = 'completed';
}
