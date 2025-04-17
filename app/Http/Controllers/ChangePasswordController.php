<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function changePassword($student){
        $page_heading="Change Password";
        $id = decrypt($student);
        if(Auth::check() && Auth::user()->role === "student"){
            return view('Frontend.Pages.change-password',compact('page_heading'));
        }else{
            return view('Admin.Pages.change-password',compact('page_heading'));
        }
    }
    public function passwordReset(Request $request, $id){
        $request->validate([
            'password' => 'required|string|min:5|max:10|confirmed',
        ]);
        $Id = decrypt($id); 
        $user=User::find($Id);
        $user->update(['password'=> $request->password]);
        toastr()->success("Password Updated Successfully");
        return back();
    }
}
