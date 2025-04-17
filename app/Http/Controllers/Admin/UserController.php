<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':view user', only: ['index']),
            new Middleware(PermissionMiddleware::class . ':add user', only: ['add','store']),
            new Middleware(PermissionMiddleware::class . ':update user', only: ['edit','update']),
            new Middleware(PermissionMiddleware::class . ':show user', only: ['show']),
            new Middleware(PermissionMiddleware::class . ':delete user', only: ['destroy']),
            new Middleware(PermissionMiddleware::class . ':update-user-status', only: ['updateStatus']),
        ];
    }

    
    public function Add(){
        $page_heading="Add User";
        $roles=Role::get();
        return view('Admin.Pages.Users.add', compact('page_heading','roles'));
    }
    public function store(AddUserRequest $request){
        try{
            $image_name = time().'.'.$request->image->extension();
            $request->image->move(public_path('/Admin/user_images/'), $image_name);
            
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'contact' => $request->contact,
                'address' => $request->address,
                'status' => $request->status,
                'image' => $image_name,
                // 'role' => $request->role,
            ]);
            $user->syncRoles($request->role);
            toastr()->success("User has been Added!", ['timeout'=>6000]);
            return redirect()->route('admin.users.data');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(\Throwable $th){
            Log::error("Request Failed!",['error'=>$th->getMessage()]);
            toastr()->error("Store User Request Failed!");
            return redirect()->back();
        }
    }
    public function edit($id){
        $roles=Role::get();
        $user=User::find($id);
        $userRoles=$user->roles->pluck('name', 'name')->all();
        $page_heading="Edit User";
        return view('Admin.Pages.Users.edit',compact('user','page_heading','roles','userRoles'));
    }
    public function update(AddUserRequest $request, $id){
        try{
            $user=User::find($id);
            if(isset($request->image)){
                $image_name = time().'.'.$request->image->extension();
                $request->image->move(public_path('/Admin/user_images/'), $image_name);
                $user->update(['image'=>$image_name]);    
            }
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                // 'role' => $request->role,
                'contact' => $request->contact,
                'address' => $request->address,
                'status' => $request->status,
            ]);
            $user->syncRoles($request->role);
            toastr()->success("User has been updated!", ['timeout'=>6000]);
            return redirect()->route('admin.users.data');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(\Throwable $th){
            Log::error("Request Failed!",['error'=>$th->getMessage()]);
            toastr()->error("Update User Request Failed!");
            return redirect()->back();
        }
    }
    public function view(){
        $page_heading="View Users";
        $users=User::latest()->get();
        return view('Admin.Pages.Users.view', compact('users','page_heading'));
    }

    public function show($id){
        $page_heading="User Detail";
        $user=User::find($id);
        return view('Admin.Pages.Users.user-detail', compact('user','page_heading'));
    }

    public function updateStatus(Request $request, $id){
        $user=User::find($id);
        if($user->status === 0){
            $user->update(['status' => 1]);
        }else{
            $user->update(['status' => 0]);
        }
        toastr()->success("Status Changed Successfully", ['timeout' => 6000]);
        return redirect()->back();
    }
    public function destroy($id){
        $user=User::find($id);
        $user->delete();
        toastr()->success("User has been Deleted Successfully!", ['timeout'=> 6000]);
        return redirect()->back();
    }
}
