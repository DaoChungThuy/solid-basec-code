<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

/**
 * Represents the status of work items.
 */
final class WorkStatus extends Enum
{
    const Unfinished = 1;
    const Finished = 2;
    const Late = 3;
}