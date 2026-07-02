<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dinas',
        'kode_dinas',
        'status',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}