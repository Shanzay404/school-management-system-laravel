<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Throwable;

class SectionController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':view section', only: ['view']),
            new Middleware(PermissionMiddleware::class . ':add section', only: ['add','store']),
            new Middleware(PermissionMiddleware::class . ':update section', only: ['edit','update']),
            new Middleware(PermissionMiddleware::class . ':delete section', only: ['destroy']),
        ];
    }

    public function view(){
        $page_heading="Sections";
        $sections=Section::latest()->with('schoolClass')->get();
        return view('Admin.Pages.Section.view', compact('sections','page_heading'));
    }
    public function add(){
        $page_heading="Add Section";
        $classes=SchoolClass::get();
        return view('Admin.Pages.Section.add', compact('page_heading','classes'));
    }
    public function store(AddSectionRequest $request){
        try{
            Section::create($request->validated());
            toastr()->success("Section has been Added");
            return redirect()->route('admin.sections.view');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(Throwable $th){
            dd($th->getMessage());
            Log::error("Server down, Request failed", ['errors'=>$th->getMessage()]);
            toastr()->error('Storing Section is failed');
            return redirect()->back();
        }
    }
    public function edit($id){
        $page_heading="Edit Section";
        $section=Section::find($id);
        return view('Admin.Pages.Section.edit', compact('page_heading','section'));
    }
    public function update(UpdateSectionRequest $request, $id){
        try{
            $section=Section::find($id);
            $section->update(['name'=>$request->name]);
            toastr()->success("Section has been Updated");
            return redirect()->route('admin.sections.view');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(Throwable $th){
            dd($th->getMessage());
            Log::error("Server down, Request failed", ['errors'=>$th->getMessage()]);
            toastr()->error('Updating in Section is failed');
            return redirect()->back();
        }
    }
    public function destroy($id){
        try{
            $section=Section::find($id);
            $section->delete();
          toastr()->success('Section has been Deleted! ', ['timeout'=>6000]);
          return redirect()->route('admin.sections.view');
        }catch(ValidationException $e){
          return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(Throwable $th){
          Log::error('Server Error! Request Failed',['errors'=>$th->getMessage()]);
          toastr()->error('Deletion Request Failed', ['timeout'=>6000]);
          return redirect()->back();
        }
    }
}
