<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $fillable = ['class', 'admission_fee', 'monthly_fee', 'exam_fee'];
}
