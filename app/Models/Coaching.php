<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coaching extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'offer_id'];

    public function user(): belongsTo {
        return $this->belongsTo(User::class);
    }

    public function offer(): belongsTo {
        return $this->belongsTo(User::class);
    }











}
