<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'user_id',
        'long_url',
        'short_url',
        'visit_count',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
