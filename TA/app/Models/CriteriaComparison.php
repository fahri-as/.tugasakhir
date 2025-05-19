<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CriteriaComparison extends Model
{
    protected $table = 'criteria_comparisons';
    protected $primaryKey = 'comparisons_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'comparisons_id',
        'criteria_column_id',
        'criteria_row_id',
        'value',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'value' => 'decimal:4',
        'created_at' => 'string'
    ];

    /**
     * Get the row criteria associated with the comparison.
     */
    public function rowCriteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_row_id', 'criteria_id');
    }

    /**
     * Get the column criteria associated with the comparison.
     */
    public function columnCriteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_column_id', 'criteria_id');
    }

    public function criteriaColumn()
    {
        return $this->belongsTo(Criteria::class, 'criteria_column_id', 'criteria_id');
    }

    public function criteriaRow()
    {
        return $this->belongsTo(Criteria::class, 'criteria_row_id', 'criteria_id');
    }
}
