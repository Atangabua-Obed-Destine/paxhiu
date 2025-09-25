<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id', 'action_type', 'model_name', 'model_id', 'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

