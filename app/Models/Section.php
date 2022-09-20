<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the events for the section.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
