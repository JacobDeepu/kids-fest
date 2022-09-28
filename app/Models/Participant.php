<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event_id',
        'user_id'
    ];

    /**
     * Get the event that owns the participant.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user that owns the participant.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
