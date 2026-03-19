<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventUser extends Model
{
    use SoftDeletes;

    protected $table = 'event_user';

    protected $fillable = [
        'event_id',
        'user_id',
    ];

    //protected $dates = [
    //    'created_at',
    //    'updated_at',
    //    'deleted_at',
    //];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
