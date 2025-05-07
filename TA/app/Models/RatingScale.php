<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RatingScale extends Model
{
    protected $table = 'rating_scales';
    protected $primaryKey = 'rating_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'rating_id',
        'name',
        'singkatan',
        'value'
    ];

    protected $casts = [
        'value' => 'integer'
    ];

    public function evaluasiMingguan(): HasMany
    {
        return $this->hasMany(EvaluasiMingguanMagang::class, 'rating_id', 'rating_id');
    }
}
