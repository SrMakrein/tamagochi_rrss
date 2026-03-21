<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamagochi extends Model
{
    use HasFactory;

    protected $table = 'tamagochis';

    protected $fillable = [
        'user_id',
        'name',
        'status',
        'energy',
        'hunger',
        'happiness',
        'health',
        'last_fed',
        'last_played',
        'times_played',
        'level',
        'experience',
    ];

    protected $casts = [
        'last_fed' => 'datetime',
        'last_played' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el estado general del tamagochi
     */
    public function updateStatus()
    {
        if ($this->health < 30) {
            $this->status = 'sick';
        } elseif ($this->energy < 20) {
            $this->status = 'sleeping';
        } elseif ($this->happiness < 40) {
            $this->status = 'sad';
        } elseif ($this->energy < 50) {
            $this->status = 'tired';
        } elseif ($this->happiness > 80) {
            $this->status = 'happy';
        } else {
            $this->status = 'normal';
        }

        return $this;
    }

    /**
     * Alimentar al tamagochi
     */
    public function feed()
    {
        $this->hunger = max(0, $this->hunger - 30);
        $this->energy = max(0, $this->energy - 5);
        $this->last_fed = now();

        if ($this->hunger < 50) {
            $this->happiness = min(100, $this->happiness + 10);
        }

        $this->updateStatus()->save();

        return $this;
    }

    /**
     * Jugar con el tamagochi
     */
    public function play()
    {
        $this->energy = max(0, $this->energy - 20);
        $this->hunger = min(100, $this->hunger + 15);
        $this->happiness = min(100, $this->happiness + 25);
        $this->last_played = now();
        $this->times_played++;

        $this->experience += 10;
        if ($this->experience >= 100 * $this->level) {
            $this->level++;
            $this->experience = 0;
        }

        $this->updateStatus()->save();

        return $this;
    }

    /**
     * Descansar
     */
    public function sleep()
    {
        $this->energy = min(100, $this->energy + 50);
        $this->health = min(100, $this->health + 10);
        $this->status = 'sleeping';

        $this->save();

        return $this;
    }
}
