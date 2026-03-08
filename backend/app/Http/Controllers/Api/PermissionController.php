<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\PermissionInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{

    protected PermissionInterface $permissionRepository;

    public function __construct(PermissionInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    public function store(Request $request): JsonResponse
    {
        $validated =  $request->validate([
            'name' => ['required', 'unique:permissions']
        ]);

        $permission = $this->permissionRepository->store($validated);

        return response()->json([
            'message' => 'Permission created',
            'permission' => $permission
        ]);
    }
}
