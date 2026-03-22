<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'event_datetime',
        'people_capacity',
        'status',
    ];

    protected $casts = [
        'event_datetime' => 'datetime',
        'people_capacity' => 'integer',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id')
            ->withTimestamps();
    }

    public function eventUsers(): HasMany
    {
        return $this->hasMany(EventUser::class, 'event_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->event_datetime > now();
    }
}
