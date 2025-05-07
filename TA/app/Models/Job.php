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

    /**
     * Get all applicants for this job
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pelamar(): HasMany
    {
        return $this->hasMany(Pelamar::class, 'job_id', 'job_id');
    }

    /**
     * Get all periods associated with this job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function periodes(): BelongsToMany
    {
        return $this->belongsToMany(Periode::class, 'periode_job', 'job_id', 'periode_id')
                    ->withTimestamps();
    }

    /**
     * Get all criteria for this job
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function criteria(): HasMany
    {
        return $this->hasMany(Criteria::class, 'job_id', 'job_id');
    }
}
