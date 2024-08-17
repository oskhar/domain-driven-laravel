<?php

namespace Domain\User\Enums;

enum UserRolesEnum: string
{
    case ADMIN = "admin";
    case MEMBER = "member";
}
