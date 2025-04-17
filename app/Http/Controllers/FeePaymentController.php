<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollectFeeRequest;
use App\Models\FeePayment;
use App\Models\FeeStructure;
use App\Models\SchoolClass;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Throwable;

class FeePaymentController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':view fee payment', only: ['view']),
            new Middleware(PermissionMiddleware::class . ':add fee payment', only: ['collectFeeform','collectFee']),
            new Middleware(PermissionMiddleware::class . ':download fee challan', only: ['downloadChallan']),
        ];
    }
    public function view(){
        $page_heading="Student Fee Payments";

        if(Auth::check() && Auth::user()->getRoleNames()->intersect(['super-admin','admin'])){
            $payments=FeePayment::get();
            return view('Admin.Pages.Fee_Payment.view', compact('payments', 'page_heading'));
        }else{
            $user_id = Auth::user()->id;
            $payments=FeePayment::where('student_id',$user_id )->get();
            return view('Frontend.Pages.Fee_Payment.view', compact('payments', 'page_heading'));
        }
    }
    public function collectFeeform(){
        $page_heading="Submit Your Fee here";
        $classes = SchoolClass::get();
        if(Auth::check() && Auth::user()->getRoleNames()->intersect(['super-admin','admin'])){
            return view('Admin.Pages.Fee_Payment.add', compact('page_heading','classes'));
        }else{
            return view('Frontend.Pages.Fee_Payment.add', compact('page_heading','classes'));
        }
    }

    public function collectFee(CollectFeeRequest $request){
        try{
            $student=Student::findOrFail($request->student_id);
            $classId = $student->school_class_id;
            $class=SchoolClass::find($classId);
            
            
            $totalFee = FeeStructure::where('class', $class->name)->first();
            $amount_paid = $request->amount_paid;
            
            $student_exists = FeePayment::where('student_id',$request->student_id)->exists();
            if($student_exists){
                $student_due_payment = FeePayment::where('student_id',$request->student_id)->latest()->first();
                if ($student_due_payment->due_amount > 0) { 
                    if ($amount_paid >= $student_due_payment->due_amount) {
                        $total_due = $amount_paid - $student_due_payment->due_amount;
                        $total_due = 0; // Due clear ho gaya
                        
                    } else {
                        $total_due = $student_due_payment->due_amount - $amount_paid;
                        $remaining_amount = 0; // Monthly fee deduct nahi hogi
                    }
                } else {
                    $remaining_amount = $amount_paid; 
                    if ($remaining_amount > 0) {
                        $total_due = $totalFee->monthly_fee - $remaining_amount;
                    } else {
                        $total_due = $totalFee->monthly_fee; // Agar due me hi sara amount chala gaya to monthly fee intact rahegi
                    }
                }
            }
            else{
                $total_due = $totalFee->monthly_fee - $amount_paid;
            }
            
            $UpdateFee = FeePayment::create([
                'student_id' => $request->student_id,
                'amount_paid' => $request->amount_paid,
                'due_amount' => Max($total_due, 0),        // if the value is in -ve it will convert into 0
                'payment_method' => $request->payment_method,
                'payment_status' => ($total_due > 0 ? 'pending' : 'paid' ),
            ]);
            toastr()->success('Fee Collected Successfully');
            return redirect()->route('feePayment.view');
        }catch(ValidationException $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
       }catch(Throwable $th){
            Log::error("Request Failed!",['error'=>$th->getMessage()]);
            toastr()->error("Fee Payment Request Failed!");
            return back();
       }
    }
    public function downloadChallan($paymentId){
        $payment = FeePayment::with('student')->findOrFail($paymentId);
        $class_fee = FeeStructure::where('class', $payment->student->school_class->name)->first();
        $pdf = Pdf::loadView('Admin.Pages.Fee_Payment.generate-challan', compact('payment','class_fee'));
        return $pdf->download(time().'_Challan_std_'.$payment->student_id.'.pdf');
    }
}
