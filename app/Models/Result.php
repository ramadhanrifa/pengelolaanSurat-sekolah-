<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
       'letter_id',
       'notes',
       'presence_recipients',
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }
    protected $casts = [
        'recipients' => 'array',
    ];

}


