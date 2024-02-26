<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Path extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'note',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public static function boot()
    {
        parent::boot();
        static::deleting(function (self $path) {
            $path->routines()->delete();
        });
    }

    public function routines(): HasMany
    {
        return $this->hasMany(Routine::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
