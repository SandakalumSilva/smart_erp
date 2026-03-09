<?php

namespace App\Interfaces;

use App\Models\User;
use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    public function getAllRole();
    public function store(array $data): Role;
    public function destroy(int $id): bool;
    public function assignRole(array $data): User;
    public function givePermission(string $roleName, array $permissions): Role;
}
