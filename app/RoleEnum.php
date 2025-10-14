<?php

namespace App;

enum RoleEnum: string
{
    case Admin = 'admin';
    case User = 'user';
    case SuperAdmin = 'super-admin';
    case Mechanic = 'mechanic';
}
