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
        'user_id',
        'kualifikasi_skor',
        'komunikasi_skor',
        'sikap_skor',
        'total_skor',
        'jadwal',
        'status_seleksi',
        'qualifikasi_criteria_id',
        'komunikasi_criteria_id',
        'sikap_criteria_id'
    ];

    protected $casts = [
        'kualifikasi_skor' => 'integer',
        'komunikasi_skor' => 'integer',
        'sikap_skor' => 'integer',
        'total_skor' => 'decimal:2',
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

    public function qualifikasiCriteria(): BelongsTo
    {
        return $this->belongsTo(InterviewCriteria::class, 'qualifikasi_criteria_id', 'criteria_id');
    }

    public function komunikasiCriteria(): BelongsTo
    {
        return $this->belongsTo(InterviewCriteria::class, 'komunikasi_criteria_id', 'criteria_id');
    }

    public function sikapCriteria(): BelongsTo
    {
        return $this->belongsTo(InterviewCriteria::class, 'sikap_criteria_id', 'criteria_id');
    }

    /**
     * Get the rating scale description for a given score and criteria
     *
     * @param string $type Type of criteria ('kualifikasi', 'komunikasi', 'sikap')
     * @return string|null Rating scale description
     */
    public function getRatingDescription(string $type): ?string
    {
        $criteriaMapping = [
            'kualifikasi' => 'qualifikasi_criteria_id',
            'komunikasi' => 'komunikasi_criteria_id',
            'sikap' => 'sikap_criteria_id'
        ];

        $scoreMapping = [
            'kualifikasi' => 'kualifikasi_skor',
            'komunikasi' => 'komunikasi_skor',
            'sikap' => 'sikap_skor'
        ];

        $criteriaIdField = $criteriaMapping[$type] ?? null;
        $scoreField = $scoreMapping[$type] ?? null;

        if (!$criteriaIdField || !$scoreField || !$this->{$criteriaIdField} || !$this->{$scoreField}) {
            return null;
        }

        $ratingScale = InterviewRatingScale::where('criteria_id', $this->{$criteriaIdField})
            ->where('rating_level', $this->{$scoreField})
            ->first();

        return $ratingScale ? $ratingScale->description : null;
    }
}
