<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    protected $permissions;
    public function __construct(Permission $permissions)
    {
        $this->permissions = $permissions;
    }

    public function getAllPermissions()
    {
        return $this->permissions->all();
    }

    public function findPermissionById($id)
    {
        return $this->permissions->find($id);
    }

    public function createPermission(array $data)
    {
        return $this->permissions->create($data);
    }

    public function deletePermission($id)
    {
        return $this->permissions->destroy($id);
    }
}
