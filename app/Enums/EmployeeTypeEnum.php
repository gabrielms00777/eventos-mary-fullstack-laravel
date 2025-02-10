<?php

namespace App\Enums;

enum EmployeeTypeEnum: string
{
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case STAFF = 'staff';
}