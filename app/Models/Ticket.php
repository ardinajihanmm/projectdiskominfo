<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'kode_ticket',
        'judul',
        'deskripsi',
        'prioritas',
        'status',
        'started_at',
        'completed_at'
    ];

    /**
     * Ticket dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Ticket berasal dari satu layanan.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Ticket memiliki banyak komentar.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Ticket memiliki banyak lampiran.
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}