<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddClassRequest;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Throwable;

class SchoolClassController extends Controller
{
  public static function middleware(): array
  {
      return [
          new Middleware(PermissionMiddleware::class . ':view class', only: ['view']),
          new Middleware(PermissionMiddleware::class . ':add class', only: ['add','store']),
          new Middleware(PermissionMiddleware::class . ':update class', only: ['edit','update']),
          new Middleware(PermissionMiddleware::class . ':delete class', only: ['destroy']),
      ];
  }
  
    public function add(){
        $page_heading="Add Class";
        return view('Admin.Pages.Class.add', compact('page_heading'));
    }
    public function view(){
        $page_heading="Classes";
        $classes=SchoolClass::latest()->with('section','subjects')->get();
        return view('Admin.Pages.Class.view', compact('classes','page_heading'));
    }
    public function store(AddClassRequest $request){
        try{
            SchoolClass::create($request->validated());
            toastr()->success('Class has been Added...', ['timeout'=>6000]);
            return redirect()->route('admin.classes.view');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(Throwable $th ){
            Log::error('Server Error! Request Failed', ['errors'=> $th->getMessage()]);
            toastr()->error('Store Student Request Failed', ['timeout'=>6000]);
            return redirect()->back();
        }
    }
    public function edit($id){
        $page_heading="Edit Class";
        $class=SchoolClass::find($id);
        $sections=Section::where('school_class_id', $id)->get();
        return view('Admin.Pages.Class.edit', compact('class', 'page_heading','sections'));
    }
    public function update(AddClassRequest $request, $id){
      try{
          $class=SchoolClass::find($id);
          $validatedData = $request->validated();
        //   dd($validatedData);
        //   die;
        
        $class->update([
            'name' => $request->name,
        ]);
        toastr()->success('Class has been Updated! ', ['timeout'=>6000]);
        return redirect()->route('admin.classes.view');
      }catch(ValidationException $e){
        return redirect()->back()->withErrors($e->getMessage())->withInput();
      }catch(Throwable $th){
        Log::error('Server Error! Request Failed',['errors'=>$th->getMessage()]);
        toastr()->error('Updation Request Failed', ['timeout'=>6000]);
        return redirect()->back();
      }
    }
    public function destroy($id){
        try{
            $class=SchoolClass::find($id);
            $class->delete();
          toastr()->success('Class has been Deleted! ', ['timeout'=>6000]);
          return redirect()->route('admin.classes.view');
        }catch(ValidationException $e){
          return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(Throwable $th){
          Log::error('Server Error! Request Failed',['errors'=>$th->getMessage()]);
          toastr()->error('Deletion Request Failed', ['timeout'=>6000]);
          return redirect()->back();
        }
    }
}