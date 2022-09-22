<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'place',
        'phone',
        'staff_phone',
    ];

    /**
     * Get the phone associated with the user.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
