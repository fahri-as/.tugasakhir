<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InterviewRatingScale extends Model
{
    protected $table = 'interview_rating_scales';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'criteria_id',
        'rating_level',
        'name',
        'description'
    ];

    protected $casts = [
        'rating_level' => 'integer'
    ];

    /**
     * Get the criteria that owns this rating scale.
     */
    public function criteria(): BelongsTo
    {
        return $this->belongsTo(InterviewCriteria::class, 'criteria_id', 'criteria_id');
    }
}
