<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\PermissionInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function givePermission(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'role'          => ['required', 'string', 'exists:roles,name'],
            'permissions'   => ['required', 'array', 'min:1'],
            'permissions.*' => ['required', 'string', 'exists:permissions,name'],
        ]);

        try {
            $role = $this->permissionRepository->givePermission(
                $validated['role'],
                $validated['permissions']
            );

            return response()->json([
                'success' => true,
                'message' => 'Permissions assigned successfully.',
                'data'    => $role,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found.',
            ], 404);
        }
    }
}
