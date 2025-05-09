<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user= $user;
    }
    
    public function getAll(){
            return $this->user->all();
    }

    public function findById($id){
        return $this->user->findOrFail($id);
    }

    public function create(array $data)
    {
        $this->user->create($data);
    }

    public function update($id, array $data)
    {
        $user= $this->findById($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        $user->delete();
        return true;

    }

    //methods that are related with the roles and permissions

    public function assignRole($userId, $roleId)
    {
        $user = $this->findById($userId);
        if ($user) {
            $user->assignRole($roleId);
            return true;
        }
        return false;
    }

    public function hasRole($userId, $roleName)
    {
        $user = $this->findById($userId);
        return $user ? $user->hasRole($roleName) : false;
    }

    public function hasPermission($userId, $permissionName)
    {
        $user = $this->findById($userId);
        return $user ? $user->hasPermission($permissionName) : false;
    }
}
