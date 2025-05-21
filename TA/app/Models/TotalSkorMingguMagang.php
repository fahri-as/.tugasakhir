<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TotalSkorMingguMagang extends Model
{
    protected $table = 'total_skor_minggu_magang';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
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
        // Check if record already exists
        $exists = DB::table('total_skor_minggu_magang')
            ->where('magang_id', $magangId)
            ->where('minggu_ke', $mingguKe)
            ->exists();

        if ($exists) {
            // Update existing record
            return DB::table('total_skor_minggu_magang')
                ->where('magang_id', $magangId)
                ->where('minggu_ke', $mingguKe)
                ->update([
                    'total_skor' => $totalSkor,
                    'updated_at' => now()
                ]);
        } else {
            // Create a new record with UUID
            return DB::table('total_skor_minggu_magang')
                ->insert([
                    'id' => Str::uuid()->toString(),
                    'magang_id' => $magangId,
                    'minggu_ke' => $mingguKe,
                    'total_skor' => $totalSkor,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }
    }
}
