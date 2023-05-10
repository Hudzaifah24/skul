<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppPayment extends Model
{
    use HasFactory;

    protected $table = "spp_payments";

    protected $fillable = [
        'status',
        'amount',
        'proof',
        'spp_id',
        'bank_id',
        'student_id',
    ];

    public function spp()
    {
        return $this->belongsTo(SPP::class, 'spp_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
