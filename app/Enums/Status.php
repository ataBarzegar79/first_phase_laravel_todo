<?php

namespace App\Enums;

enum Status: string
{
    case done = "Done";
    case inProgress = "In Progress";
    case all = "All";
}
