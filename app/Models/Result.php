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
        return $this->hasMany(Letter::class, 'id');
    }
    public function letter_type()
    {
        return $this->belongsTo(letter_type::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'recipients' => 'array',
    ];

    protected $table = 'results';

}


