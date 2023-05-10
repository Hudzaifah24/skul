<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = "students";

    protected $fillable = [
        'nisn',
        'nik',
        'name',
        'gender',
        'born',
        'place_of_birth',
        'religion',
        'address',
        'memorization_juz',
        'memorization_page',
        'password',
    ];

    protected $appends = [
        'age'
    ];

    public function getAgeAttribute()
    {
        $birthDate = $this->born;

        $currentDate = date("d-m-Y");

        $age = date_diff(date_create($birthDate), date_create($currentDate));

        return  (int)$age->format("%y");
    }

    public function clas()
    {
        return $this->belongsToMany(Clas::class, 'student_classes', 'student_id', 'class_id');
    }

    public function presence()
    {
        return $this->hasOne(Presence::class, 'student_id', 'id');
    }

    public function fossil()
    {
        return $this->hasMany(Fossil::class,'student_id','id');

    }
    public function studentClass()
    {
        return $this->hasMany(StudentClass::class, 'student_id', 'id');
    }
    public function memorization()
    {
        return $this->hasMany(Memorization::class, 'user_id', 'id');
    }
    public function guardian()
    {
        return $this->hasOne(Guardian::class, 'student_id', 'id');
    }

    public function sppPayment()
    {
        return $this->hasMany(SppPayment::class, 'student_id', 'id');
    }

    public function billPayment()
    {
        return $this->hasMany(BillPayment::class, 'student_id', 'id');
    }
}
