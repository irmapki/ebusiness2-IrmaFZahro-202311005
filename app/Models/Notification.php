<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'action_url',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Scope a query to only include unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope a query to only include read notifications.
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Get icon based on notification type.
     */
    public function getIconAttribute()
    {
        return match($this->type) {
            'order' => 'shopping-cart',
            'product' => 'box',
            'user' => 'user',
            'system' => 'bell',
            default => 'bell',
        };
    }

    /**
     * Get color based on notification type.
     */
    public function getColorAttribute()
    {
        return match($this->type) {
            'order' => 'blue',
            'product' => 'green',
            'user' => 'purple',
            'system' => 'gray',
            default => 'gray',
        };
    }
}