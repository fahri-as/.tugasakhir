<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TesKemampuanRatingScale extends Model
{
    protected $table = 'tes_kemampuan_rating_scales';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'criteria_id',
        'rating_level',
        'name',
        'description',
        'min_score',
        'max_score'
    ];

    protected $casts = [
        'rating_level' => 'integer',
        'min_score' => 'integer',
        'max_score' => 'integer'
    ];

    /**
     * Get the criteria that owns this rating scale.
     */
    public function criteria(): BelongsTo
    {
        return $this->belongsTo(TesKemampuanCriteria::class, 'criteria_id', 'criteria_id');
    }
}
