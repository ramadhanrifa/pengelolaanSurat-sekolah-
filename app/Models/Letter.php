<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
        protected $guarded = ['id'];

        public function user()
        {
            // ini untuk menentukan di table mana kita akan memanggil data dari si User ini
            return $this->belongsTo(User::class, 'notulis');
        }
        public function letter_type()
        {
            // jika seperti ini kita hanya dapat memamnggil id dengan nama yang hampir sama
            return $this->belongsTo(letter_type::class);
        }
        public function result()
        {
            return $this->hasOne(Result::class);
        }

        protected $fillable = [
            'letter_type_id',
            'letter_perihal',
            'recipients',
            'content',
            'attachment',
            'notulis'
        ];

        protected $casts = [
            'recipients' => 'array',
        ];


}
