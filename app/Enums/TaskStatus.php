<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Complete = 'COMPLETE';
    case Incomplete = 'INCOMPLETE';
}
