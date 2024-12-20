<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class domisili extends Model
{
    /** @use HasFactory<\Database\Factories\DomisiliFactory> */
    use HasFactory;
    protected $guarded = [];
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'nik', 'nik');
    }
}
