<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeRequest;
use App\Models\FeeStructure;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Throwable;

class FeeStructureController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':view fee structure', only: ['view']),
            new Middleware(PermissionMiddleware::class . ':add fee structure', only: ['add','store']),
            new Middleware(PermissionMiddleware::class . ':update fee structure', only: ['edit','update']),
            new Middleware(PermissionMiddleware::class . ':delete fee structure', only: ['destroy']),
        ];
    }
    public function view(){
        $page_heading = "Fee Structure";
        $classFees = FeeStructure::get();
        return view('Admin.Pages.Fee-Structure.view', compact('classFees', 'page_heading'));
    }
    public function add(){
        $page_heading = "Add Fee Structure";
        $classes = SchoolClass::get();
        return view('Admin.Pages.Fee-Structure.add', compact('classes','page_heading'));
    }
    public function store(StoreFeeRequest $request){
        try{
            FeeStructure::create($request->validated());
            toastr()->success('Class Fee Structure Has Been Added');
            return redirect()->route('admin.fee.view');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(Throwable $th){
            Log::error("Request failed", ['errors' => $th->getMessage()]);
            toastr()->error('Adding Fee is failed');
            return back();
        } 
    }
    public function edit(FeeStructure $feeStructure){
        // dd($feeStructure);
        // die;
        $page_heading = "Edit Fee Structure";
        // $classFee = FeeStructure::find($feeStructure);
        return view('Admin.Pages.Fee-Structure.edit', compact('feeStructure', 'page_heading'));
    }
    public function update(StoreFeeRequest $request , FeeStructure $feeStructure){
        try{
            $feeStructure->update($request->validated());
            toastr()->success('Class Fee Structure Fee Has Been Updated');
            return redirect()->route('admin.fee.view');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }catch(Throwable $th){
            Log::error("Request failed", ['errors' => $th->getMessage()]);
            toastr()->error('Updating Fee is failed');
            return back();
        } 
    }
    public function destroy(FeeStructure $feeStructure){
        $feeStructure->delete();
        toastr()->success('Class Fee Structure Fee Has Been Deleted');
        return redirect()->back();
    }
}
