<?php

namespace App\Models;

use App\Models\FeePayment;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id', 'father_name', 'mother_name','address', 'date', 'dob', 'admission_number', 'school_class_id','section_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function school_class(){
        return $this->belongsTo(SchoolClass::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function studentAttendance(){
        return $this->hasMany(StudentAttendance::class);
    }

    public function fee_payment(){
        return $this->hasMany(FeePayment::class);
    }

    // generate unique admission number for each student
    public static function boot(){
        parent::boot();

        static::creating(function($student){
            $student->admission_number = self::generateUniqueAdmissionNumber();
        });
    }   
        
    public static function generateUniqueAdmissionNumber(){
        do {
            $number = 'ADM' .  rand(10000,99999);
        } while (self::where('admission_number', $number)->exists());
        return $number;
    }
}
