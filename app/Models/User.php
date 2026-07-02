<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'instansi',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Satu user dapat memiliki banyak tiket.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Satu user dapat membuat banyak komentar.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}