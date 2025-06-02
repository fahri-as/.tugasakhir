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

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
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
            'remember_token' => 'string',
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

    /**
     * Check if user has a specific role
     *
     * @param string|array $roles
     * @return bool
     */
    public function hasRole($roles)
    {
        $roles = is_array($roles) ? $roles : [$roles];
        return in_array($this->role, $roles);
    }
}