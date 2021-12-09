<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profilePicture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }


    public function bio()
    {
        return $this->hasOne(Bio::class);
    }

    public function weblog()
    {
        return $this->hasOne(Weblog::class);
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
