<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $table = "student_classes";

    protected $fillable = [
        'student_id',
        'class_id',
        'period_id',
    ];

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function clas()
    {
        return $this->belongsTo(Clas::class, 'class_id', 'id');
    }

    public function billPayment()
    {
        return $this->hasOne(BillPayment::class, 'student_id', 'student_id');
    }

    public function sppPayment()
    {
        return $this->hasOne(SppPayment::class, 'student_id', 'student_id');
    }

    public function billClass()
    {
        return $this->hasOne(BillClas::class, 'class_id', 'class_id');
    }
}
