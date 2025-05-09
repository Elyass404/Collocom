<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function findRoleById($id);
    public function createRole(array $data);
    public function updateRole(array $data,$id);
    public function deleteRole($id);
}
