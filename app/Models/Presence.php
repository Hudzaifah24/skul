<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $table = "presences";

    protected $fillable = [
        'student_id',
        'permission_count',
        'sick_count',
        'alpha_count',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id' ,'student_id');
    }

    public function presenceDetail()
    {
        return $this->hasMany(PresenceDetail::class, 'presence_id', 'id');
    }
}
