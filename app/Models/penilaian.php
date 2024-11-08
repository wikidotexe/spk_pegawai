<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';
    protected $guarded = [];

    public function crips () {
        return $this->belongsTo(crips::class, 'crips_id');
    }
}
