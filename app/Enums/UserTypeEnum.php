<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case EMPLOYEE = 'employee';
    case VISITOR = 'visitor';
}