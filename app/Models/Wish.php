<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wish extends Model
{
    protected $fillable = [
        'invitation_id',
        'guest_name',
        'message',
        'is_approved',
        'is_public',
        'submitted_at',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_public' => 'boolean',
        'submitted_at' => 'datetime',
    ];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true)->where('is_public', true);
    }
}
