<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'response_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function responseProgres()
    {
        return $this->hasMany(ResponseProgres::class);
    }
    
}
