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
        'rating_id',
        'criteria_id', // Added criteria_id
        'minggu_ke',
        'skor_minggu'
    ];

    protected $casts = [
        'minggu_ke' => 'integer',
        'skor_minggu' => 'decimal:2'
    ];

    public function magang(): BelongsTo
    {
        return $this->belongsTo(Magang::class, 'magang_id', 'magang_id');
    }

    public function ratingScale(): BelongsTo
    {
        return $this->belongsTo(RatingScale::class, 'rating_id', 'rating_id');
    }

    /**
     * Get the criteria that this evaluation is associated with.
     */
    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'criteria_id');
    }
}
