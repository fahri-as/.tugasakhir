<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model
{
    protected $table = 'job';
    protected $primaryKey = 'job_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'job_id',
        'nama_job',
        'deskripsi'
    ];

    public function pelamar(): HasMany
    {
        return $this->hasMany(Pelamar::class, 'job_id', 'job_id');
    }

    public function periode(): BelongsToMany
    {
        return $this->belongsToMany(Periode::class, 'periode_job', 'job_id', 'periode_id')
                    ->withTimestamps();
    }
}
