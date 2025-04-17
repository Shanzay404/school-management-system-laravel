<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Throwable;

class ClassSubjectController extends Controller
{

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':assign-subject-to-class', only: ['add','store']),
        ];
    }

    
    public function add(){
        $page_heading="Add Subject to Class";
        $classes=SchoolClass::get();
        $subjects=Subject::get();
        return view('Admin.Pages.Subjects.add_subject_to_class', compact('page_heading', 'classes', 'subjects'));
    }
    // public function store(Request $request){

    //     $request->validate([
    //         'school_class' => 'required|exists:school_classes,id',
    //         'subject_ids' => 'required|array',
    //         'subject_ids.*' => 'exists:subjects,id',
    //     ]);
    

    //     try{
    //         dd($request->subject_ids);
    //         die;
           
           
    //         $school_class = SchoolClass::findOrFail($request->school_class);
           
    //         $school_class->subjects()->sync($request->subject_ids);
        
    //     // }catch(ValidationException $e){
    //     //     return redirect()->back()->withErrors($e->getMessage())->withInput();
    //     // }catch(Throwable $th){
    //     //     Log::error("Request Failed, Server Down", ['errors'=>$th->getMessage()]);
    //     //     toastr()->error("Assigning Subjects Request Failed");
    //     //     return redirect()->back();
    //     // }


    //     } catch (Throwable $th) {
    //         Log::error("Request Failed", ['errors' => $th->getMessage()]);
    //         toastr()->error("Assigning Subjects Request Failed");
    //         return redirect()->back()->withInput();
    //     }
    // }



    // public function store(Request $request)
    // {
    //     // Validate input
    //     $request->validate([
    //         'school_class' => 'required|exists:school_classes,id',
    //         'subject_ids' => 'required|array',
    //         'subject_ids.*' => 'exists:subjects,id',
    //     ]);

    //     try {
    //         // $school_class = SchoolClass::findOrFail($request->school_class);
    //         $school_class = SchoolClass::findOrFail($request->school_class);
    //         $subjects = Subject::whereIn('id', $request->subject_ids)->get();

    //         dd($subjects);
    //         die;

    //         // Debug subject_ids before syncing
    //         if (empty($request->subject_ids)) {
    //             throw new Exception("No subjects selected.");
    //         }

    //         // Sync subjects (or use empty array if null)
    //         $school_class->subjects()->sync($request->subject_ids ?? []);

    //         toastr()->success("Subjects Assigned Successfully");
    //         return redirect()->route('subjects.view');
    //     } 
    //     catch (Throwable $th) {
    //         Log::error("Request Failed", ['errors' => $th->getMessage()]);
    //         return back()->withErrors($th->getMessage())->withInput();
    //     }
    // }


    public function store(Request $request)
    {
        $request->validate([
            'school_class' => 'required|exists:school_classes,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        try {
            $school_class = SchoolClass::findOrFail($request->school_class);

            // Debug before syncing
            if (empty($request->subject_ids)) {
                throw new Exception("No subjects selected.");
            }

            // Ensure the subjects exist
            $subjects = Subject::whereIn('id', $request->subject_ids)->get();
            if ($subjects->count() !== count($request->subject_ids)) {
                throw new Exception("One or more selected subjects do not exist.");
            }

            // Sync subjects
            $school_class->subjects()->sync($request->subject_ids ?? []);

            toastr()->success("Subjects Assigned Successfully");
            return redirect()->route('subjects.view');
        } 
        catch (Throwable $th) {
            Log::error("Request Failed", ['errors' => $th->getMessage()]);
            return back()->withErrors($th->getMessage())->withInput();
        }
    }

}
