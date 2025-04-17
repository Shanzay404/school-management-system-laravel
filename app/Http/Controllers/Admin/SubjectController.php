<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeSubjectRequest;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Throwable;

class SubjectController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':view subject', only: ['view']),
            new Middleware(PermissionMiddleware::class . ':add subject', only: ['add','store']),
            new Middleware(PermissionMiddleware::class . ':update subject', only: ['edit','update']),
            new Middleware(PermissionMiddleware::class . ':delete subject', only: ['destroy']),
        ];
    }
    public function view(){
        $page_heading= "View Subjects";
        $subjects=Subject::with('teacher')->latest()->get();
        // $teachers=User::where('role','staff')->latest()->get();
        return view('Admin.Pages.Subjects.view', compact('page_heading', 'subjects'));
    }
    public function add(){
        $page_heading= "Add Subject";
        $classes=SchoolClass::get();
        // $users=User::get();
        // $teachers=User::where('role',$users->getRoleNames()->contains('teacher'))->latest()->get();
        $teachers = User::role('teacher')->latest()->get();
        return view('Admin.Pages.Subjects.add', compact('page_heading', 'classes','teachers'));
    }
    public function store(storeSubjectRequest $request){
        try{
            do {
                $generateRandomCode = rand(100,199);
                $subjectCode = substr(strtoupper($request->name),0,3).$generateRandomCode; 
            } while (Subject::where('code', $subjectCode)->exists());
            $subject=Subject::create([
                'name' => $request->name,
                'code' => $subjectCode,
                'teacher_id'=> $request->teacher,
            ]);
            toastr()->success("Subject Added Successfully");
            return redirect()->route('subjects.view');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(Throwable $th){
            Log::error("Request Failed! Server Error", ['errors'=>$th->getMessage()]);
            return redirect()->back();
        }
    }
    // public function updateStatus(){   
    // }
    public function edit(Subject $subject){
        $teachers=User::where('role','staff')->latest()->get();
        $page_heading= "Edit Subject";
        return view('Admin.Pages.Subjects.edit', compact('page_heading', 'subject', 'teachers'));
    }
    public function update(storeSubjectRequest $request, Subject $subject){
        try{
            // i update the name
            if($request->has('name') && $request->name !== $subject->name){
                do {
                    $generateRandomCode = rand(100,199);
                    $subjectCode = substr(strtoupper($request->name),0,3).$generateRandomCode; 
                } while (Subject::where('code', $subjectCode)->exists());
                
                $subject->update(['code' => $subjectCode]);
            }
            
            $subject->update([
                'name' => $request->name,
                'teacher_id'=> $request->teacher,
            ]);
            toastr()->success("Subject Updated Successfully");
            return redirect()->route('subjects.view');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(Throwable $th){
            Log::error("Request Failed! Server Error", ['errors'=>$th->getMessage()]);
            return redirect()->back();
        }
    }
    public function destroy(Subject $subject){
        $subject->delete();
        toastr()->success('Subject Deleted Successfully');
        return redirect()->route('subjects.view');
        
    }
}
