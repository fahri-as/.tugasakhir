<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InterviewCriteria extends Model
{
    protected $table = 'interview_criteria';
    protected $primaryKey = 'criteria_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'criteria_id',
        'job_id',
        'name',
        'code',
        'description',
        'weight'
    ];

    protected $casts = [
        'weight' => 'decimal:4'
    ];

    /**
     * Get the job that owns the criteria.
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }

    /**
     * Get the rating scales associated with this criteria
     */
    public function ratingScales(): HasMany
    {
        return $this->hasMany(InterviewRatingScale::class, 'criteria_id', 'criteria_id');
    }
}