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
        'status_seleksi',
        'criteria_id'
    ];

    protected $casts = [
        'skor' => 'integer',
        'jadwal' => 'datetime',
        'status_seleksi' => 'string',
    ];

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id', 'pelamar_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(TesKemampuanCriteria::class, 'criteria_id', 'criteria_id');
    }

    /**
     * Get the rating scale for the current score
     *
     * @return TesKemampuanRatingScale|null The rating scale that matches the score
     */
    public function getRatingScale()
    {
        if (!$this->criteria_id || !$this->skor) {
            return null;
        }

        return TesKemampuanRatingScale::where('criteria_id', $this->criteria_id)
            ->where('min_score', '<=', $this->skor)
            ->where('max_score', '>=', $this->skor)
            ->first();
    }

    /**
     * Get the rating level based on the current score
     *
     * @return int|null The rating level (1-5)
     */
    public function getRatingLevel()
    {
        $ratingScale = $this->getRatingScale();
        return $ratingScale ? $ratingScale->rating_level : null;
    }

    /**
     * Get the rating description for the current score
     *
     * @return string|null The rating description
     */
    public function getRatingDescription()
    {
        $ratingScale = $this->getRatingScale();
        return $ratingScale ? $ratingScale->description : null;
    }
}
