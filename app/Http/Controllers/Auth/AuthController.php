<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signupPage(){
        $page_title = "Signup";                                                          //add user
        return view('Admin.Pages.Auth.register', compact('page_title'));
    }
    public function postSignup(RegisterUserRequest $request){                            //store user
        try{
            User::create($request->validated());
            toastr()->success('Your Account has been registered!', ['timeout' => 6000]);
            return redirect()->route('login');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(\Throwable $th){
            Log::error('Registration Failed!', ['error'=> $th->getMessage()]);
            toastr()->error("Registration Failed! Please Try again later", ['timeout' => 6000]);
            return redirect()->back();
        }
    }
    public function loginPage(){                                                         //  login page
            $page_title = "Login";  
            return view('Admin.Pages.Auth.login', compact('page_title'));
    }
    
    public function postLogin(LoginUserRequest $request ){                                // store login
        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                toastr()->success('Your are login now!', ['timeout' => 6000]);


                // if (Auth::check() && Auth::user()->getRoleNames()->intersect(['super-admin','admin','staff','teacher','parent'])) {
                //     return redirect()->route('dashboard'); // Admin ke dashboard pr bhejna
                // }
                // else{
                //     return redirect()->route('redirect'); // Normal users ke liye index page
                // }

                if(Auth::check() && Auth::user()->getRoleNames()->contains('student')){
                    return redirect()->route('redirect'); // Normal users ke liye index page
                }else{
                    return redirect()->route('dashboard'); // Admin ke dashboard pr bhejna
                }
            }else{
                toastr()->error('Login Credentials doesn\'t Match!', ['timeout' => 6000]);
                return redirect()->route('login');
            }
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->validator)->withInput();
        } 
        catch (\Throwable $th) {
            Log::error("Login Failed!", ['error' => $th->getMessage()]); 
            toastr()->error('Login Failed! Please try again later');
           return redirect()->back();
        }
    }
    public function logout(){
        session()->flush();
        Auth::logout();
        toastr()->success("You've logged out successfully");
        return redirect()->route('login');
    }
}
