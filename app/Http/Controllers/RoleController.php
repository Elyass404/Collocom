<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;
    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository){
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(){
        $roles = $this->roleRepository->getAllRoles();
        $countRoles = Role::count();
        $activeRoles = 1; 
        $latestRole = Role::where('created_at', '>=', now()->subHours(48))->count();

        return view("roles.index", compact("roles", "countRoles", "activeRoles", "latestRole"));
    }

    public function create(){

        $permissions = $this->permissionRepository->getAllPermissions(); 
        return view("roles.create",compact("permissions"));
    }

    public function store(RoleRequest $request){
        $validatedData = $request->validated();

        $this->roleRepository->createRole($validatedData);
        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    public function show($id){
        $role = $this->roleRepository->findRoleById($id);

        return view("roles.show", compact("role"));
    }

    public function edit($id){
        $role = $this->roleRepository->findRoleById($id);
        $permissions = $this->permissionRepository->getAllPermissions(); 

        return view("roles.edit",compact("role","permissions"));
    }

    public function update(RoleRequest $request, $id)
    {
        $validatedData = $request->validated();
        $this->roleRepository->updateRole($validatedData,$id);
        return redirect()->route('roles.index')->with("success","You have updated the role with success!");

    }

    public function destroy($id)
    {
        $this->roleRepository->deleteRole($id);
        return redirect()->route("roles.index")->with('success', 'Role deleted successfully!');
    }
}
