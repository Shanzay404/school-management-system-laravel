<?php

namespace App\Models;

use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name','school_class_id'];

    public function schoolClass(){
        return $this->belongsTo(SchoolClass::class,'school_class_id');
    }

    public function student(){
        return $this->hasMany(Student::class);
    }
}
