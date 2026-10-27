<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invitation extends Model
{
    protected $fillable = [
        'template_id',
        'slug',
        'bride_name',
        'groom_name',
        'bride_parents',
        'groom_parents',
        'event_date',
        'event_time',
        'address',
        'venue_name',
        'maps_link',
        'maps_embed',
        'story',
        'music_path',
        'background_image',
        'whatsapp_number',
        'expires_at',
        'settings_json',
        'status',
        'views_count',
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
        'expires_at' => 'datetime',
        'settings_json' => 'array',
        'views_count' => 'integer',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class)->orderBy('sort_order');
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    public function galleryItems(): HasMany
    {
        return $this->hasMany(GalleryItem::class)->orderBy('sort_order');
    }

    public function wishes(): HasMany
    {
        return $this->hasMany(Wish::class);
    }

    public function rsvps()
    {
        return $this->hasManyThrough(Rsvp::class, Guest::class);
    }

    public function getEffectiveWhatsAppNumberAttribute(): string
    {
        return $this->whatsapp_number ?? config('app.whatsapp_number', env('WHATSAPP_NUMBER', ''));
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
