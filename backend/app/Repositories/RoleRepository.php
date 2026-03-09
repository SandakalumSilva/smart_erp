<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRole()
    {
        return Role::with('permissions')->get();
    }

    public function store(array $data): Role
    {
        return Role::create([
            'name'       => $data['name']
        ]);
    }

    public function destroy(int $id): bool
    {
        $role = Role::findOrFail($id);

        if ($role->users()->count() > 0) {
            throw new \Exception("Cannot delete a role that is assigned to users.", 422);
        }

        $role->delete();

        return true;
    }

    public function assignRole(array $data): User
    {
        $user = User::findOrFail($data['user_id']);
        $user->assignRole($data['role']);
        return $user->load('roles');
    }

    public function givePermission(string $roleName, array $permissions): Role
    {

        $role = Role::findByName($roleName);
        $role->givePermissionTo($permissions);

        return $role->fresh('permissions');
    }
}
