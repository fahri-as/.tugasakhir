<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get all interviews conducted by this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class, 'user_id', 'user_id');
    }

    /**
     * Get all skill tests conducted by this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tesKemampuan(): HasMany
    {
        return $this->hasMany(TesKemampuan::class, 'user_id', 'user_id');
    }

    /**
     * Get all internships managed by this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function magang(): HasMany
    {
        return $this->hasMany(Magang::class, 'user_id', 'user_id');
    }
}