<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriaRatingScale extends Model
{
    protected $table = 'criteria_rating_scales';
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

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'criteria_id');
    }
}
