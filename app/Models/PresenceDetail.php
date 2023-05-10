<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceDetail extends Model
{
    use HasFactory;

    protected $table = "presence_details";

    protected $fillable = [
        'presence_id',
        'user_id',
        'learning_id',
        'status',
        'date',
        'reason',
    ];

    public function presence()
    {
        return $this->belongsTo(Presence::class, 'presence_id', 'id');
    }

    public function learning()
    {
        return $this->hasOne(Learning::class, 'id', 'learning_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
