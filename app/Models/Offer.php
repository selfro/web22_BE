<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','lva','date','start','end',
        'isBooked', 'comment', 'bookedUser', 'bookedUserFirstname'];

    // offer gehört zu 1 user
    public function user() : belongsTo {
        return $this->belongsTo(User::class);
    }

    public function coachings() : hasMany {
        return $this->hasMany(Coaching::class);
    }
}
