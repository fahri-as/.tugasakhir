<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Periode extends Model
{
    protected $table = 'periode';
    protected $primaryKey = 'periode_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'periode_id',
        'nama_periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'durasi_minggu_magang'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'durasi_minggu_magang' => 'integer'
    ];

    public function pelamar(): HasMany
    {
        return $this->hasMany(Pelamar::class, 'periode_id', 'periode_id');
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'periode_job', 'periode_id', 'job_id')
                    ->withTimestamps();
    }
}
