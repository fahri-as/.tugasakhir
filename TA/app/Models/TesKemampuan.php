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
        'pelamar_id',
        'skor',
        'catatan',
        'jadwal'
    ];

    protected $casts = [
        'skor' => 'integer',
        'jadwal' => 'date'
    ];

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id', 'pelamar_id');
    }
}
