<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorization extends Model
{
    use HasFactory;

    protected $table = "memorizations";

    protected $fillable = [
        'surah',
        'juz',
        'ayat_from',
        'ayat_to',
        'user_id',
        'date',
        'student_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function studentClass()
    {
        return $this->hasMany(StudentClass::class, 'student_id', 'id');
    }

    public function student()
    {
        return $this->hasMany(Student::class, 'id', 'student_id');
    }
}
