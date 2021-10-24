<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'name',
        'file_path',
        'file_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        // foreign_key
        return $this->belongsTo(Book::class);
    }
}
