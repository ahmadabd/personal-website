<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weblog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weblog_address'
    ]; 

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
