<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class EvaluasiMingguanMagang extends Model
{
    protected $table = 'evaluasi_mingguan_magang';
    protected $primaryKey = 'evaluasi_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'evaluasi_id',
        'magang_id',
        'criteria_rating_id',
        'criteria_id',
        'minggu_ke'
    ];

    protected $casts = [
        'minggu_ke' => 'integer'
    ];

    public function magang(): BelongsTo
    {
        return $this->belongsTo(Magang::class, 'magang_id', 'magang_id');
    }

    /**
     * Get the criteria rating scale associated with this evaluation.
     */
    public function criteriaRatingScale(): BelongsTo
    {
        return $this->belongsTo(CriteriaRatingScale::class, 'criteria_rating_id', 'id');
    }

    /**
     * Get the criteria that this evaluation is associated with.
     */
    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'criteria_id');
    }

    /**
     * Get the total score for this evaluation from total_skor_minggu_magang table
     */
    public function getTotalScoreAttribute()
    {
        return DB::table('total_skor_minggu_magang')
            ->where('magang_id', $this->magang_id)
            ->where('minggu_ke', $this->minggu_ke)
            ->value('total_skor') ?? 0;
    }
}
