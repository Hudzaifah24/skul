<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPP extends Model
{
    use HasFactory;

    protected $table = "spps";

    protected $fillable = [
        'amount',
        'deadline',
        'month',
        'period',
        'class_id',
        'user_id',
    ];

    public function class()
    {
        return $this->belongsTo(Clas::class, 'class_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sppPayment()
    {
        return $this->hasMany(SppPayment::class, 'spp_id', 'id');
    }
}
