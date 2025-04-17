<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClassSubject;
use App\Models\FeeStructure;
use App\Models\Leave;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class HomeController extends Controller
{
    public function redirect()
    {
        // dd();
        // die;
        $classId = Auth::user()->student->school_class->id;
        
        $class = SchoolClass::with('subjects')->find($classId);
        return view('Frontend.Pages.Index',compact('class'));      
    }
    public function viewProfile($id){
        $page_heading="My Profile";
        $Id = decrypt($id);
        $user=User::find($Id);
        if(Auth::check() && Auth::user()->role === "student"){
            return view('Frontend.Pages.ViewProfile', compact('user','page_heading'));   
        }else{
            return view('Admin.Pages.ViewProfile', compact('user','page_heading'));   
        }
        // return view('Frontend.Pages.ViewProfile', compact('user', 'page_heading'));
    }
    public function editProfile($id)
    {
        $Id = decrypt($id);
        $page_heading="Edit Profile";
        $user=User::find($Id);
        if(Auth::check() && Auth::user()->role === "student"){
            return view('Frontend.Pages.EditProfile', compact('user','page_heading'));   
        }else{
            return view('Admin.Pages.EditProfile', compact('user','page_heading'));   
        }

    }
    public function updateProfile(Request $request, $id)
    { 
        try {
            if(Auth::check() && Auth::user()->role === "student"){
                $request->validate([
                    'username' => 'required|string',
                    'father_name' => 'required|string',
                    'mother_name' => 'required|string',
                    'email' => 'required|email|unique:users,email'.($id ? ','.$id : ''),
                    'contact' => 'required|numeric|digits_between:11,13',
                    'dob' => 'required',
                    'address' => 'required|string',
                    'image' => 'nullable|mimes:png,jpg,jpeg',
                ]);
                $user = User::find($id);
                $user->username = $request->username;
                $user->email = $request->email;
                $user->contact = $request->contact;
                $user->address = $request->address;
                $user->student->father_name = $request->father_name;
                $user->student->mother_name = $request->mother_name;
                $user->student->dob = $request->dob;
                $user->save();    

                if(isset($request->image)){
                    $image_name = time().'_std.'.$request->image->extension();
                    $request->image->move(public_path('/Admin/user_images/'), $image_name);
                    $user->update(['image'=>$image_name]);
                }

            }else{
                $request->validate([
                    'username' => 'required|string',
                    'email' => 'required|email|unique:users,email'.($id ? ','.$id : ''),
                    'contact' => 'required|numeric|digits_between:11,13',
                    'address' => 'required|string',
                    'image' => 'nullable|mimes:png,jpg,jpeg',
                ]);

                $user = User::find($id);
                $user->username = $request->username;
                $user->email = $request->email;
                $user->contact = $request->contact;
                $user->address = $request->address;
                $user->save();    

                if(isset($request->image)){
                    $image_name = time().'.'.$request->image->extension();
                    $request->image->move(public_path('/Admin/user_images/'), $image_name);
                    $user->update(['image'=>$image_name]);
                }
            }
           
            
            // return redirect()->route('studentProfile.edit');   
            toastr()->success("Profile Updated Successfully");
            return redirect()->back();
            
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Throwable $th) {
            Log::error("Request failed", ['errors' => $th->getMessage()]);
            toastr()->error('Updating record failed');
            return back();
        }
    }
    public function viewFeeStructure()
    {
        $page_heading="Fee Structure";
        $classFees=FeeStructure::get();
        return view('Frontend.Pages.view-fee-structure',compact('classFees','page_heading'));
    }
}
