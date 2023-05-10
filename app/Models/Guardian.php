<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'relationship',
        'work',
        'phone_number',
        'religion',
        'education',
        'student_id'
    ];

    public function student()
    {
        return $this->hasOne(Student::class,'id', 'student_id');
    }
}
