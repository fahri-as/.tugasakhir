<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criteria extends Model
{
    protected $table = 'criteria';
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
        'weight' => 'decimal:2'
    ];

    /**
     * Get the job that owns the criteria.
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }

    /**
     * Get the comparisons where this criteria is in the row.
     */
    public function rowComparisons(): HasMany
    {
        return $this->hasMany(CriteriaComparison::class, 'criteria_row_id', 'criteria_id');
    }

    /**
     * Get the comparisons where this criteria is in the column.
     */
    public function columnComparisons(): HasMany
    {
        return $this->hasMany(CriteriaComparison::class, 'criteria_column_id', 'criteria_id');
    }

    /**
     * Get all weekly evaluations for this criteria.
     */
    public function evaluations(): HasMany
    {
        return $this->hasMany(EvaluasiMingguanMagang::class, 'criteria_id', 'criteria_id');
    }
}
