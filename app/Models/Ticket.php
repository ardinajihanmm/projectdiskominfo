<?php
 
namespace App\Models;
use App\Models\User;
use App\Models\Service;
use App\Models\Attachment;
 
use Illuminate\Database\Eloquent\Model;
 
class Ticket extends Model
{
    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
 
    protected $fillable = [
        'user_id',
        'staff_id',
        'service_id',
        'kode_ticket',
        'judul',
        'deskripsi',
        'prioritas',
        'status',
        'started_at',
        'completed_at',
        'point',
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
 
    public function isUnassigned(): bool
    {
        return is_null($this->staff_id);
    }
 
    public function isHandledBy($userId): bool
    {
        return $this->staff_id == $userId;
    }
 
    public function calculatePoint(): float
    {
        if (!$this->completed_at || !$this->created_at) {
            return 0;
        }
 
        $this->loadMissing('service');
 
        $slaHours = $this->service->sla ?? null;
 
        if (!$slaHours || $slaHours <= 0) {
            return 100;
        }
 
        $actualHours = $this->created_at->diffInMinutes($this->completed_at) / 60;
 
        if ($actualHours <= 0) {
            return 100;
        }
 
        $point = ($slaHours / $actualHours) * 100;
 
        return round(min(100, max(50, $point)), 2);
    }
}