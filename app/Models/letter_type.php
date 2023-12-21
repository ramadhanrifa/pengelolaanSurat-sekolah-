<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class letter_type extends Model
{
    protected $fillable = [
        'letter_code',
        'name_type',
    ];

    protected $table = 'letter_types';

    // Assuming your primary key is 'id'
    protected $primaryKey = 'id';

    public function letter()
        {
            return $this->hasMany(Letter::class);
        }
}
