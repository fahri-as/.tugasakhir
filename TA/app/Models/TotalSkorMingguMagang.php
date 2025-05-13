<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalSkorMingguMagang extends Model
{
    protected $table = 'total_skor_minggu_magang';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'magang_id',
        'minggu_ke',
        'total_skor'
    ];

    /**
     * Relationship with Magang
     */
    public function magang()
    {
        return $this->belongsTo(Magang::class, 'magang_id', 'magang_id');
    }
}
