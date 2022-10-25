<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'duration',
        'occupancy_id',
    ];
    public function occupancy()
    {
        return $this->belongsTo(Occupancy::class);
    }
}
