<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TesKemampuan extends Model
{
    protected $table = 'tes_kemampuan';
    protected $primaryKey = 'tes_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tes_id',
        'user_id',
        'pelamar_id',
        'catatan',
        'jadwal',
        'skor',
        'status_seleksi', // Added status_seleksi field
    ];

    protected $casts = [
        'skor' => 'integer',
        'jadwal' => 'datetime',
        'status_seleksi' => 'string', // Added status_seleksi cast
    ];

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id', 'pelamar_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}