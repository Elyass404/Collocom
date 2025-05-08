<?php

namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface
{
    public function getAllPermissions();
    public function findPermissionById($id);
    public function createPermission(array $data);
    public function deletePermission($id);
}
