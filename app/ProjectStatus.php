<?php

namespace App;

enum ProjectStatus: string
{
    case OPEN = 'open';
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case CANCELLED = 'cancelled';
    case BLOCKED = 'blocked';
    case COMPLETED = 'completed';
}
