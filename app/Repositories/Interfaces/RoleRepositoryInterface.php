<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function findRoleById($id);
    public function createRole(array $data);
    public function deleteRole($id);
}
