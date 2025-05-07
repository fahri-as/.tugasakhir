<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Magang extends Model
{
    protected $table = 'magang';
    protected $primaryKey = 'magang_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'magang_id',
        'pelamar_id',
        'user_id',
        'total_skor',
        'rank',
        'status_seleksi'
    ];

    protected $casts = [
        'total_skor' => 'decimal:2',
        'rank' => 'integer',
        'status_seleksi' => 'string'
    ];

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id', 'pelamar_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function evaluasiMingguan(): HasMany
    {
        return $this->hasMany(EvaluasiMingguanMagang::class, 'magang_id', 'magang_id');
    }
}
