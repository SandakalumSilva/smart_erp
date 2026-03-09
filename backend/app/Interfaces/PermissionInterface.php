<?php

namespace App\Interfaces;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

interface PermissionInterface
{
    public function store(array $data): Permission;
    public function givePermission(string $roleName, array $permissions): Role;
}
