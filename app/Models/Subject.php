<?php

namespace App\Models;

use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'code', 'teacher_id', 'status'];


       // manyToMany relation with Classes using pivot table
    public function school_classes(){
        return $this->belongsToMany(SchoolClass::class, 'class_subject', 'subject_id', 'school_class_id');
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id'); // Each subject has one teacher
    }

}
