<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fossil extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'income',
        'work',
        'phone_number',
        'religion',
        'education',
        'student_id',
        'status'
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
}
