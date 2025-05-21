<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class TotalSkorMingguMagang extends Model
{
    protected $table = 'total_skor_minggu_magang';

    // Composite primary key of magang_id and minggu_ke
    protected $primaryKey = ['magang_id', 'minggu_ke'];
    public $incrementing = false;

    protected $fillable = [
        'magang_id',
        'minggu_ke',
        'total_skor'
    ];

    protected $casts = [
        'minggu_ke' => 'integer',
        'total_skor' => 'decimal:4'
    ];

    /**
     * Get the magang that this score belongs to
     */
    public function magang(): BelongsTo
    {
        return $this->belongsTo(Magang::class, 'magang_id', 'magang_id');
    }

    /**
     * Create or update a score record
     */
    public static function updateOrCreateScore($magangId, $mingguKe, $totalSkor)
    {
        return DB::table('total_skor_minggu_magang')
            ->updateOrInsert(
                ['magang_id' => $magangId, 'minggu_ke' => $mingguKe],
                ['total_skor' => $totalSkor, 'updated_at' => now()]
            );
    }
}