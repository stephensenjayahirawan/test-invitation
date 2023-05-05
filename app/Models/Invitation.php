<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;
    protected $hidden = [
        'id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
