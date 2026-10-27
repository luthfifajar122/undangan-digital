<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Guest extends Model
{
    protected $fillable = [
        'invitation_id',
        'name',
        'category',
        'phone',
        'token',
        'qr_code',
        'is_sent',
    ];

    protected $casts = [
        'is_sent' => 'boolean',
    ];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    public function rsvp(): HasOne
    {
        return $this->hasOne(Rsvp::class);
    }

    public static function generateToken(): string
    {
        return Str::random(32);
    }

    public function getRsvpUrlAttribute(): string
    {
        return route('invitation.rsvp', ['slug' => $this->invitation->slug, 'token' => $this->token]);
    }
}
