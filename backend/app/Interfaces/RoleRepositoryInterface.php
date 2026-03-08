<?php

namespace App\Interfaces;

use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    public function getAllRole();
    public function store(array $data): Role;
    public function destroy(int $id): bool;
    public function givePermission(string $roleName, array $permissions): Role;
}
