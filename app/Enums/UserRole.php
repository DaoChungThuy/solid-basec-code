<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class UserRole extends Enum
{
    const Admin = 1;
    const Store = 2;
    const Staff = 3;
}