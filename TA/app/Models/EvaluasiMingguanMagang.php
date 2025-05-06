<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluasiMingguanMagang extends Model
{
    protected $table = 'evaluasi_mingguan_magang';
    protected $primaryKey = 'evaluasi_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'evaluasi_id',
        'magang_id',
        'pelamar_id',
        'minggu_ke',
        'kriteria1',
        'kriteria2',
        'kriteria3',
        'kriteria4',
        'kriteria5',
        'skor_minggu'
    ];

    protected $casts = [
        'minggu_ke' => 'integer',
        'kriteria1' => 'integer',
        'kriteria2' => 'integer',
        'kriteria3' => 'integer',
        'kriteria4' => 'integer',
        'kriteria5' => 'integer',
        'skor_minggu' => 'decimal:2'
    ];

    public function magang(): BelongsTo
    {
        return $this->belongsTo(Magang::class, 'magang_id', 'magang_id');
    }

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id', 'pelamar_id');
    }
}
