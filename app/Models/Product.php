<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
    ];

    public function scopeAllowed($query, $user)
    {
        if($user->role == 'manager'){
            $query->where('created_by', $user->id);
        }
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
