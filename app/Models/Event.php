<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'invitation_id',
        'name',
        'date',
        'time',
        'venue_name',
        'address',
        'maps_link',
        'maps_embed',
        'sort_order',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
        'sort_order' => 'integer',
    ];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
