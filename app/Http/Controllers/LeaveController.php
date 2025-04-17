<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeLeaveRequest;
use App\Mail\UserLeaveInformationMail;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Throwable;

class LeaveController extends Controller
{
    public function add(){
        $page_heading="Create Leave";
        // $payments=FeePayment::latest()->get();
        if(Auth::user()->getRoleNames()->contains('student')){
            return view('Frontend.Pages.Leaves.add', compact('page_heading'));
        }else{
            return view('Admin.Pages.Leaves.add', compact('page_heading'));
        }
    }
    public function store(storeLeaveRequest $request){
        try{
            Leave::create([
                'user_id' => Auth::user()->id,
                'leave_type' => $request->leave_type, 
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => $request->reason
            ]);
            toastr()->success("Your leave request has been received. You will be informed via email about its acceptance or rejection.");
            return redirect()->back();
        }
        catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
        catch(Throwable $th){
            Log::error("Request Failed,! Serve Error." , ['errors' => $th->getMessage()]);
            toastr()->error("Storing Leave Request Failed.. Please try another time");
            return redirect()->back();
        }
    }
    public function index(){
        $page_heading="Leave Record";
        $user = Auth::user();
        $roles = $user->getRoleNames();
        if ($roles->intersect(['admin', 'super-admin'])->isNotEmpty()) {
            $leaves = Leave::latest()->get();
            return view('Admin.Pages.Leaves.view', compact('leaves', 'page_heading'));
        } elseif ($roles->contains('teacher')) {
            $students = User::role('student')->pluck('id')->toArray();
            $leaves=Leave::whereIn('user_id',$students)->with('user')->get();
            return view('Admin.Pages.Leaves.view', compact('leaves', 'page_heading'));
        } else {
            $user_id = $user->id;
            $leaves = Leave::where('user_id', $user_id)->latest()->get();
            return view('Frontend.Pages.Leaves.view', compact('leaves', 'page_heading'));
        }
    }
    public function update(Request $request, Leave $leaveId){
        $email = $leaveId->user->email;
        $leaveId->update(['status' => $request->status]);
        Mail::raw("Your Leave Has been $request->status", function ($message) use ($email) {
            $message->to($email)
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('Leave Information');
        });
        toastr()->success("Status Has been Updated");
        return redirect()->back();
    }
    public function show(Leave $leave){
        $page_heading="Leave Detail";
        $user = Auth::user();
        $roles = $user->getRoleNames();
        if ($roles->intersect(['admin', 'super-admin','teacher'])->isNotEmpty()) {
            return view('Admin.Pages.Leaves.leave-detail', compact('page_heading', 'leave'));
        // } elseif ($roles->contains('teacher')) {
        //     return view('Frontend.Pages.Leaves.leave-detail', compact('page_heading', 'leave'));

        } else {
            return view('Frontend.Pages.Leaves.leave-detail', compact('page_heading', 'leave'));
        }
    }
    public function destroy(Leave $leave){
        $leave->delete();
        toastr()->success("leave Has been deleted");
        return redirect()->back();
    }
}
