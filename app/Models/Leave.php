<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = ['user_id', 'leave_type', 'start_date', 'end_date', 'reason', 'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
