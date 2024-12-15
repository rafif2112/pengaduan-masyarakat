<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseProgres extends Model
{
    use HasFactory;

    protected $fillable = [
        'histories',
    ];

    
    public function response()
    {
        return $this->belongsTo(Response::class);
    }
    
    protected $casts = [
        'histories' => 'array',
    ];
}
