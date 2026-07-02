<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'nama_bidang',
        'status',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}