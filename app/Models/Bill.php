<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = "bills";

    protected $fillable = [
        'name',
        'sum',
        'deadline',
    ];

    public function billPayment()
    {
        return $this->hasMany(BillPayment::class, 'bill_id', 'id');
    }

    public function billClass()
    {
        return $this->hasOne(BillClas::class, 'bill_id', 'id');
    }
}
