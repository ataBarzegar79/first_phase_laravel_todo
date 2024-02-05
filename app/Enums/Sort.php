<?php

namespace App\Enums;

enum Sort: string
{
    case createdAt = 'created_at';
    case startedAt = 'started_at';
    case endedAt = 'ended_at';
}
