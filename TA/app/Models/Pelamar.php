<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Pelamar extends Model
{
    protected $table = 'pelamar';
    protected $primaryKey = 'pelamar_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pelamar_id',
        'periode_id',
        'job_id',
        'nama',
        'email',
        'nomor_wa',
        'tgl_lahir',
        'alamat',
        'pendidikan',
        'lama_pengalaman',
        'tempat_pengalaman',
        'deskripsi_tempat',
        'berkas_cv'
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'lama_pengalaman' => 'integer',
        'tempat_pengalaman' => 'string'  // Changed from integer to string to match DB
    ];

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'periode_id');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }

    public function magang(): HasOne
    {
        return $this->hasOne(Magang::class, 'pelamar_id', 'pelamar_id');
    }

    public function interview(): HasOne
    {
        return $this->hasOne(Interview::class, 'pelamar_id', 'pelamar_id');
    }

    public function tesKemampuan(): HasOne
    {
        return $this->hasOne(TesKemampuan::class, 'pelamar_id', 'pelamar_id');
    }

    public function evaluasiMingguan(): HasManyThrough
    {
        return $this->hasManyThrough(
            EvaluasiMingguanMagang::class,
            Magang::class,
            'pelamar_id', // Foreign key on magang table
            'magang_id',  // Foreign key on evaluasi_mingguan_magang table
            'pelamar_id', // Local key on pelamar table
            'magang_id'   // Local key on magang table
        );
    }
}
