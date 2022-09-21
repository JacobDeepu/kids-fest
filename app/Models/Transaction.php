<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'number'
    ];

    /**
     * Get the participants for the transaction.
     */
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
