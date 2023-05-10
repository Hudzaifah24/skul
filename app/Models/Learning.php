<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learning extends Model
{
    use HasFactory;

    protected $table = "learnings";

    protected $fillable = [
        'name',
        'order',
        'hour_from',
        'hour_to',
        'day',
        'class_id',
        'user_id',
    ];

    public function class()
    {
        return $this->belongsTo(Clas::class, 'class_id', 'id');
    }
    public function teachers()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
