<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table = "periods";

    protected $fillable = [
        'year_start',
        'year_end',
        'status',
    ];

    public function studentClass()
    {
        return $this->hasMany(StudentClass::class, 'period_id', 'id');
    }

    public function billClass()
    {
        return $this->hasMany(BillClass::class, 'period_id', 'id');
    }
}
