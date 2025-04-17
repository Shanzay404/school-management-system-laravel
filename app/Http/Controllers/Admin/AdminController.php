<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $totalClasses=SchoolClass::count();
        $totalStaff = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['teacher', 'staff']);
        })->count();
        $totalStudents=Student::count();
        $active_std=User::where('role','student')->where('status', 'active')->count();
        // dd($active_std);
        // die;
        $totalSubjects=Subject::count();

        // return $totalStaff;
        // die;
        return view('Admin.Pages.Dashboard',compact('totalClasses','totalStaff','totalStudents','active_std','totalSubjects'));
    }
}
