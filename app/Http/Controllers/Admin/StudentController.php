<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentRequest;
use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Subject;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Throwable;

class StudentController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':view student', only: ['view']),
            new Middleware(PermissionMiddleware::class . ':add student', only: ['add','store']),
            new Middleware(PermissionMiddleware::class . ':show student details', only: ['show']),
            new Middleware(PermissionMiddleware::class . ':update student', only: ['edit','update']),
            new Middleware(PermissionMiddleware::class . ':delete student', only: ['destroy']),
            new Middleware(PermissionMiddleware::class . ':update-student-status', only: ['updateStatus']),
            new Middleware(PermissionMiddleware::class . ':generate-student-report', only: ['generateReport','storeAndSend']),
        ];
    }
    
    public function add(){
        $page_heading = 'Add Student';
        $classes=SchoolClass::with('section')->get();
        $sections=Section::get();
        return view('Admin.Pages.Student.add', compact('page_heading','classes','sections'));
    }
    public function view(){
        $page_heading = 'Students';
        $students = Student::with('user','school_class','section')->latest()->get();
        return view('Admin.Pages.Student.view', compact('students','page_heading'));
    }
    public function store(AddStudentRequest $request){
        try
        {
        $admissionNumber = Student::generateUniqueAdmissionNumber();
        $class_section = json_decode($request->class_section, true);
        $image_name = time().'_std.'.$request->image->extension();
        $request->image->move(public_path('/Admin/user_images/'), $image_name);
        DB::beginTransaction();
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            // 'role' => 'student',
            'contact' => $request->contact,
            'address' => $request->address,
            'image' => $image_name,
            'status' => 1,
        ]);
        $user->syncRoles("student");
        $student = Student::create([
            'user_id' => $user->id,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'dob' => $request->dob,
            'admission_number' => $admissionNumber,
            'date' => Carbon::now()->format('d-M-Y'),
            'school_class_id' => $class_section['school_class_id'],
            'section_id' => $class_section['section_id'],
        ]);
        DB::commit();
            toastr()->success('Admission Approved! Student Has been Added', ['timeout'=>6000]);
            return redirect()->route('admin.students.data');
       }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
       }catch(Throwable $th){
            dd($th->getMessage());
            Log::error("Request Failed!",['error'=>$th->getMessage()]);
            toastr()->error("Store Student Request Failed!");
            return back();
       }
    }
    public function edit($id){
        $page_heading="Edit Student";
        $student=Student::find($id);
        $classes=SchoolClass::with('section')->get();
        
        return view('Admin.Pages.Student.edit',compact('page_heading', 'student','classes'));
    }

    public function update(AddStudentRequest $request, $id){
       try{
        $class_section = json_decode($request->class_section, true);
           DB::beginTransaction();
            $user=User::find($id);
            if(isset($request->image)){
                $image_name = time().'.'.$request->image->extension();
                $request->image->move(public_path('/Admin/user_images/'), $image_name);
                $user->update(['image'=>$image_name]);
            }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
        ]);
        $user->syncRoles("student");
       Student::where('user_id', $id)->update([
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'dob' => $request->dob,
            'school_class_id' => $class_section['school_class_id'],
            'section_id' => $class_section['section_id'],
        ]);
        DB::commit();
            toastr()->success('Student profile Updated Successfully!', ['timeout'=>6000]);
            return redirect()->route('admin.students.data');
       }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
       }catch(Throwable $th){
            Log::error("Request Failed!",['error'=>$th->getMessage()]);
            toastr()->error("Update Student Request Failed!");
            return back();
       }
    }
   
    public function show($id){
        $page_heading="Edit Student";
        $student = Student::where('id', $id)->with('user','school_class','section')->first();
        return view('Admin.Pages.Student.student-detail', compact('page_heading', 'student'));   
    }
    public function updateStatus($id){
        $student=User::find($id);
        if($student->status === 0){
            $student->update(['status' => 1]);
        }else{
            $student->update(['status' => 0]);
        }
        toastr()->success("Status Changed Successfully", ['timeout' => 6000]);
        return redirect()->back();
    }
    public function destroy($id){
        $student=User::find($id);
        $student->delete();
        toastr()->info("Student has been terminated!", ['timeout'=> 6000]);
        return redirect()->back();
    }
    //report
    public function generateReport($id){
       $student = Student::where('id', $id)->with('user','studentAttendance','school_class')->first();
       $subject_ids = DB::select('SELECT subject_id FROM class_subject WHERE school_class_id = ?', [ $student->school_class->id ]);

       return view('Admin.Pages.Student.generate-student-report', compact('student','subject_ids'));     
    }


    public function storeAndSend($id){
       $student = Student::where('id', $id)->with('user','studentAttendance','school_class')->first();
       $subject_ids = DB::select('SELECT subject_id FROM class_subject WHERE school_class_id = ?', [ $student->school_class->id ]);
        $email = $student->user->email;
        $pdf = Pdf::loadView('admin.pages.student.send-student-report', compact('student', 'subject_ids'));
        $directory = storage_path('app/public/Student_Reports');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true, true);
        }
        
        $pdfPath = $directory . '/' . time(). '_'.$student->user->username . '-report.pdf';
        
        $pdf->save($pdfPath);
        Mail::raw('Your Report is given below', function ($message) use ($email,$pdfPath){
            $message->to($email);
            $message->subject('Student Report');
            $message->attach($pdfPath);
        });
        toastr()->success("Report sent successfully!");
        return redirect()->back();
    }
}
