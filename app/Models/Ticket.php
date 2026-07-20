<?php

namespace App\Models;
use App\Models\User;
use App\Models\Service;
use App\Models\Attachment;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'staff_id',
        'service_id',
        'kode_ticket',
        'judul',
        'deskripsi',
        'prioritas',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function attachments()
    {
    return $this->hasMany(Attachment::class);
    }

    public function comments()
    {
    return $this->hasMany(Comment::class)->latest();
    }
}
