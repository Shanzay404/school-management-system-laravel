<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Middleware\PermissionMiddleware as MiddlewarePermissionMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':delete role', only: ['destroy']),
            new Middleware(PermissionMiddleware::class . ':view role', only: ['index']),
            new Middleware(PermissionMiddleware::class . ':create role', only: ['create','store']),
            new Middleware(PermissionMiddleware::class . ':update role', only: ['edit','update']),
            new Middleware(PermissionMiddleware::class . ':add-permission-to-role', only: ['add_permission_to_role','give_permission_to_role']),
        ];
    }
    public function index(){
        $page_heading="Roles";
        $roles=Role::get();
        return view('role-permission.role.index', compact('page_heading','roles'));
    }
    public function create(){
        $page_heading="Add Role";
        return view('role-permission.role.create', compact('page_heading'));
    }
    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);
        Role::create([
            'name' => $request->name,
        ]);
        
        toastr()->success("role Created Successfully");
        return redirect('roles');
    }
    public function edit(Role $role){
        $page_heading="Edit Role";
        return view('role-permission.role.edit', compact('page_heading', 'role'));
    }
    public function update(Request $request, Role $role){
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$role->id
        ]);
        $role->update(['name'=>$request->name]);
        toastr()->success("Role Updated Successfully");
        return redirect('roles');
    }
    public function destroy(Role $role){
        $role->delete();
        toastr()->success("Role Deleted Successfully");
        return redirect('roles');
    }

    // add_permission_to_role

    public function add_permission_to_role($roleId){
        $page_heading='Give permissions';
        $role=Role::findOrFail($roleId);
        $permissions=Permission::get();
        // pluck is used to create an associative array 
        $rolePermission=DB::table('role_has_permissions')
                        ->where('role_id', $roleId)
                        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                        ->all();
        // dd($rolePermissions);

        return view('role-permission.role.add-permissions', compact('page_heading','role','permissions','rolePermission'));
    }

    // give_permission_to_role
    public function give_permission_to_role(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required',
        ]);

        $role=Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        toastr()->success("Permission Added to Role Successfully");
        return redirect()->back();
    }
}
