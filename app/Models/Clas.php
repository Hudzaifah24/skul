<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
    use HasFactory;

    protected $table = "classes";

    protected $fillable = [
        'name',
    ];

    public function learning()
    {
        return $this->hasOne(Learning::class, 'class_id', 'id');
    }

    public function student()
    {
        return $this->belongsToMany(Student::class, 'student_classes', 'class_id', 'student_id');
    }

    public function studentClass()
    {
        return $this->hasMany(StudentClass::class, 'class_id', 'id');
    }

    public function spp()
    {
        return $this->hasMany(SPP::class, 'class_id', 'id');
    }
}
