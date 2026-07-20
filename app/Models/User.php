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
    'department_id',
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

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function department()
    {
    return $this->belongsTo(Department::class);
    }
    public function isScopedToDepartment(): bool
    {
    return $this->role === 'admin' && !is_null($this->department_id);
    }

    public function assignedTickets()
    {
    return $this->hasMany(Ticket::class, 'staff_id');
    }
}