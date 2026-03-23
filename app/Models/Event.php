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
        'end_date',
        'people_capacity',
        'status',
    ];

    protected $casts = [
        'event_datetime' => 'datetime:d/m/Y H:i',
        'end_date' => 'datetime:d/m/Y H:i',
        'people_capacity' => 'integer',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id')
            ->withTimestamps()
            ->wherePivotNull('canceled_by')
            ->wherePivotNull('deleted_at');
    }

    public function eventUsers(): HasMany
    {
        return $this->hasMany(EventUser::class, 'event_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->event_datetime > now();
    }

    public function isFull(): bool
    {
        return ! is_null($this->people_capacity) &&
            $this->participants_count >= $this->people_capacity;
    }

    public function isUserSubscribed(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->participants()
            ->where('users.id', $userId)
            ->exists();
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['active', 'in_progress'])
            ->where('event_datetime', '>=', now())
            ->whereNull('deleted_at');
    }

    public function totalParticipants(): int
    {
        return $this->participants_count ?? $this->participants()->count();
    }
}
