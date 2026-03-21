<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatistic extends Model
{
    use HasFactory;

    protected $table = 'user_statistics';

    protected $fillable = [
        'user_id',
        'total_posts',
        'total_likes',
        'total_comments',
        'followers_count',
        'following_count',
        'level',
        'total_playtime',
        'tamagochis_level_up',
        'posts_published',
        'badges_earned',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
