<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillClas extends Model
{
    use HasFactory;

    protected $table = 'bill_classes';

    protected $fillable = [
        'bill_id',
        'class_id',
        'period_id'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(Clas::class, 'class_id', 'id');
    }

    public function period()
    {
        return $this->hasOne(Period::class, 'id', 'period_id');
    }
}
