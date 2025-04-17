<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    
    protected $fillable = [
        'student_id', 
        'amount_paid', 
        'due_amount', 
        'payment_method', 
        'payment_status', 
        'payment_date'
    ]; 
    
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
