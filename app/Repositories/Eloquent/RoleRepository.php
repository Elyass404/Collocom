<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Create a new class instance.
     */

     protected $roles;
    public function __construct(Role $roles)
    {
        $this->roles = $roles;
    }

    public function getAllRoles()
    {
        return $this->roles->all();
    }

    public function findRoleById($id)
    {
        return $this->roles->find($id);
    }

    public function createRole(array $data)
    {
        return $this->roles->create($data);
    }

    public function deleteRole($id)
    {
        return $this->roles->where('id', $id)->delete();
    }
}
