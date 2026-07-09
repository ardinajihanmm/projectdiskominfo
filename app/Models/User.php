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
    'password',
    'role',
    'no_hp',
    'instansi',
    'foto',
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

    // Relasi: satu user memiliki banyak tiket
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Relasi: satu user memiliki banyak komentar
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}