<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ['name'];

    public function section(){
        return $this->hasMany(Section::class);
    }
    public function student(){
        return $this->hasMany(Student::class);
    }
    // manyToMany relation with subject using pivot table
    public function subjects(){
        return $this->belongsToMany(Subject::class, 'class_subject', 'school_class_id', 'subject_id');
    }
}
