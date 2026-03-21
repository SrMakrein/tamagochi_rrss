<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TamagochiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 5 usuarios adicionales con datos de ejemplo
        \App\Models\User::factory()->count(5)->create()->each(function ($user) {
            // Actualizar estadísticas
            $user->statistic()->update([
                'total_posts' => rand(5, 50),
                'total_likes' => rand(10, 200),
                'total_comments' => rand(5, 100),
                'followers_count' => rand(5, 100),
                'following_count' => rand(5, 50),
                'level' => rand(1, 10),
                'total_playtime' => rand(60, 500),
                'tamagochis_level_up' => rand(0, 5),
                'posts_published' => rand(0, 50),
                'badges_earned' => rand(0, 10),
            ]);

            // Actualizar tamagochi
            $user->tamagochi()->update([
                'name' => 'Tamagochi de ' . $user->name,
                'status' => Arr::random(['happy', 'normal', 'sad', 'tired', 'sick']),
                'energy' => rand(10, 100),
                'hunger' => rand(0, 100),
                'happiness' => rand(20, 100),
                'health' => rand(50, 100),
                'times_played' => rand(10, 100),
                'level' => rand(1, 15),
                'experience' => rand(0, 100),
            ]);

            // Actualizar configuración
            $user->setting()->update([
                'theme' => Arr::random(['light', 'dark']),
                'language' => Arr::random(['es', 'en']),
                'bio' => 'Usuario de Tamagochi RRSS #' . $user->id,
                'avatar_url' => 'https://i.pravatar.cc/150?img=' . $user->id,
            ]);
        });
    }
}
