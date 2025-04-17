<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Psy\CodeCleaner\ReturnTypePass;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{


    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':view permission', only: ['index']),
            new Middleware(PermissionMiddleware::class . ':delete permission', only: ['destroy']),
            new Middleware(PermissionMiddleware::class . ':create permission', only: ['create','store']),
            new Middleware(PermissionMiddleware::class . ':update permission', only: ['edit','update']),
        ];
    }

    
    public function roles_and_permissions(){
        return view('role-permission.index');
    }
    public function index(){
        $page_heading="Permissions";
        $permissions=Permission::get();
        return view('role-permission.permission.index', compact('page_heading','permissions'));
    }
    public function create(){
        $page_heading="Add Permission";
        return view('role-permission.permission.create', compact('page_heading'));
    }
    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);
        Permission::create([
            'name' => $request->name,
        ]);
        
        toastr()->success("Permission Created Successfully");
        return redirect('permissions');
    }
    public function edit(Permission $permission){
        $page_heading="Edit Permission";
        return view('role-permission.permission.edit', compact('page_heading', 'permission'));
    }
    public function update(Request $request, Permission $permission){
        $request->validate([
            'name' => 'required|string|unique:permissions,name,'.$permission->id
        ]);
        $permission->update(['name'=>$request->name]);
        toastr()->success("Permission Updated Successfully");
        return redirect('permissions');
    }
    public function destroy(Permission $permission){
        $permission->delete();
        toastr()->success("Permission Deleted Successfully");
        return redirect('permissions');

    }

}
