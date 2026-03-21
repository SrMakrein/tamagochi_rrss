<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $table = 'user_settings';

    protected $fillable = [
        'user_id',
        'theme',
        'notifications_enabled',
        'email_notifications',
        'push_notifications',
        'private_profile',
        'language',
        'tamagochi_notifications',
        'notification_frequency',
        'show_statistics',
        'two_factor_enabled',
        'bio',
        'avatar_url',
    ];

    protected $casts = [
        'notifications_enabled' => 'boolean',
        'email_notifications' => 'boolean',
        'push_notifications' => 'boolean',
        'private_profile' => 'boolean',
        'tamagochi_notifications' => 'boolean',
        'show_statistics' => 'boolean',
        'two_factor_enabled' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
