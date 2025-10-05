<?php

namespace App\Enums;

enum TaskStatus: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case PAUSED = 'paused';
    case WAITING_CLIENT = 'waiting_client';
    case BLOCKED = 'blocked';
    case CLOSED = 'closed';
    case ON_HOLD = 'on_hold';
    case COMPLETED = 'completed';
}
