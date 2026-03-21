<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * Obtener estadísticas del usuario actual
     */
    public function myStats(Request $request)
    {
        $user = $request->user();
        $stats = $user->statistic;

        if (!$stats) {
            return response()->json([
                'message' => 'Estadísticas no encontradas',
            ], 404);
        }

        return response()->json([
            'data' => $stats,
        ], 200);
    }

    /**
     * Obtener estadísticas de todos los usuarios (ranking)
     */
    public function leaderboard(Request $request)
    {
        $limit = $request->query('limit', 10);

        $leaderboard = User::with('statistic')
            ->join('user_statistics', 'users.id', '=', 'user_statistics.user_id')
            ->select('users.id', 'users.name', 'users.email', 'user_statistics.*')
            ->orderByDesc('user_statistics.level')
            ->orderByDesc('user_statistics.total_posts')
            ->limit($limit)
            ->get();

        return response()->json([
            'message' => 'Top ' . $limit . ' usuarios',
            'data' => $leaderboard,
        ], 200);
    }

    /**
     * Obtener estadísticas globales del sistema
     */
    public function globalStats()
    {
        $stats = [
            'total_users' => User::count(),
            'total_posts' => User::sum('statistic.total_posts'),
            'total_likes' => User::sum('statistic.total_likes'),
            'total_comments' => User::sum('statistic.total_comments'),
            'avg_level' => User::with('statistic')->avg('statistic.level'),
            'total_playtime_minutes' => User::sum('statistic.total_playtime'),
        ];

        return response()->json([
            'data' => $stats,
        ], 200);
    }

    /**
     * Obtener estadísticas de un usuario específico
     */
    public function userStats($userId)
    {
        $user = User::with('statistic', 'tamagochi')->find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        return response()->json([
            'data' => [
                'user' => $user->only('id', 'name', 'email', 'created_at'),
                'statistics' => $user->statistic,
                'tamagochi' => $user->tamagochi,
            ],
        ], 200);
    }
}
