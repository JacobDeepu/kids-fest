<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'section_id',
        'min_participants',
        'max_participants',
    ];

    /**
     * Get the section that owns the event.
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
