<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'nama_layanan',
        'deskripsi',
        'icon',
        'sla',
        'status',
    ];
 
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
}