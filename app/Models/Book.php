<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'descriptions',
        'url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        // foreign_key, local_key
        return $this->hasOne(File::class);
    }
}
