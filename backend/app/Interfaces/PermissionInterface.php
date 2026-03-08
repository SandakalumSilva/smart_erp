<?php

namespace App\Interfaces;

use Spatie\Permission\Models\Permission;

interface PermissionInterface
{
    public function store(array $data): Permission;
}
