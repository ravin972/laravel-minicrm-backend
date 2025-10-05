<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case MANAGE_USERS = 'manage-users';
    case DELETE_CLIENTS = 'delete-clients';
    case DELETE_PROJECTS = 'delete-projects';
    case DELETE_TASKS = 'delete-tasks';
}
