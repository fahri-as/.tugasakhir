<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interview extends Model
{
    protected $table = 'interview';
    protected $primaryKey = 'interview_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'interview_id',
        'pelamar_id',
        'kualifikasi_skor',
        'komunikasi_skor',
        'sikap_skor',
        'total_skor',
        'jadwal'
    ];

    protected $casts = [
        'kualifikasi_skor' => 'integer',
        'komunikasi_skor' => 'integer',
        'sikap_skor' => 'integer',
        'total_skor' => 'decimal:2',
        'jadwal' => 'date'
    ];

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id', 'pelamar_id');
    }
}
