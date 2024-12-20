<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    /** @use HasFactory<\Database\Factories\PendudukFactory> */
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $hidden = ['nik', 'alamat']; // Default hidden

    public function data_status() {
        return $this->belongsTo(statuspenduduk::class,'nik','nik');
    }

    public function domisili() {
        return $this->hasMany(domisili::class,'nik','nik');
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucwords(strtolower($value));
    }

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = ucwords(strtolower($value));
    }

    public function setTempatLahirAttribute($value)
    {
        $this->attributes['tmp_lahir'] = ucwords(strtolower($value));
    }

    public function setPekerjaanAttribute($value)
    {
        $this->attributes['pekerjaan'] = ucwords(strtolower($value));
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Sesuaikan 'hidden' berdasarkan admin status
        if (Auth::check() && Auth::user()->admin == 1) {
            $this->hidden = []; // Tidak ada kolom yang disembunyikan untuk admin
        }
    }


}
