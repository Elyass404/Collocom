<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($id,array $data);
    public function delete($id);

    public function assignRole($userId, $roleId);
    public function hasRole($userId, $roleName);
    public function hasPermission($userId, $permissionName);
}
