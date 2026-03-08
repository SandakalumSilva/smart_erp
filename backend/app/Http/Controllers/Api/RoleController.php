<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\RoleRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleController extends Controller
{
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRole(): JsonResponse
    {
        $roles = $this->roleRepository->getAllRole();

        return response()->json([
            'success' => true,
            'data'    => $roles,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name']
        ]);

        $role = $this->roleRepository->store($validated);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully.',
            'data'    => $role,
        ], 201);
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->roleRepository->destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }

    public function givePermission(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'role'          => ['required', 'string', 'exists:roles,name'],
            'permissions'   => ['required', 'array', 'min:1'],
            'permissions.*' => ['required', 'string', 'exists:permissions,name'],
        ]);

        try {
            $role = $this->roleRepository->givePermission(
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
