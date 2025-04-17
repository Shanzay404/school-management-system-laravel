<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Throwable;

class StudentAttendanceController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':add attendance', only: ['index']),
            new Middleware(PermissionMiddleware::class . ':mark attendance', only: ['add','store']),
        ];
    }
    
    public function index(){
        $subjects=Subject::with('teacher')->get();
        return view('Admin.Pages.Student-Attendance.index', compact('subjects'));
        // $students=Student::with('user')->latest()->get();
    }
    public function add($subjectName,$subjectId){
        $page_heading="Subject: ";
        $students=Student::with('user')->whereHas('user', function($query){
            $query->where('status', 1);
        })->get();
        return view('Admin.Pages.Student-Attendance.add',compact('students','page_heading','subjectName','subjectId'));
    }
    public function store(Request $request, $subjectId){
        try{
            $request->validate([
                'student_name' => 'required|integer',
                'status' => 'required',
                'date' => 'required|date|before_or_equal:today',
            ]);
            StudentAttendance::create([
                'student_id' => $request->student_name,
                'subject_id' => $subjectId,
                'status' => $request->status,
                'date' => $request->date,
            ]);
            toastr()->success("Attendance Marked! ");
            return redirect()->back();

        }catch(ValidationException $e){
            // return redirect()->back()->withErrors($e->getMessage())->withInput();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }catch(Throwable $th){
            Log::error("Request Failed! Server Error", ['errors'=>$th->getMessage()]);
            return redirect()->back();
        }
    }
}
