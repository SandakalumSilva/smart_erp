<?php

namespace App\Repositories;

use App\Interfaces\PermissionInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRepository implements PermissionInterface
{
    public function store(array $data): Permission
    {
        $permission = Permission::create([
            'name' => $data['name']
        ]);

        return $permission;
    }

    public function givePermission(string $roleName, array $permissions): Role
    {

        $role = Role::findByName($roleName);
        $role->givePermissionTo($permissions);
        return $role->fresh('permissions');
    }
}
