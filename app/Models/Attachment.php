<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'ticket_attachments';

    protected $fillable = [
        'ticket_id',
        'nama_file',
        'path_file',
        'mime_type',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}