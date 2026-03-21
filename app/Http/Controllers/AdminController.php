<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tamagochi;
use App\Models\UserStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Verificar si el usuario es admin (middleware personalizado)
     */
    private function checkAdmin(Request $request)
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            return response()->json([
                'message' => '❌ Acceso denegado. Solo administradores',
            ], 403);
        }
        return null;
    }

    /**
     * Obtener todos los usuarios
     */
    public function getAllUsers(Request $request)
    {
        $admin_check = $this->checkAdmin($request);
        if ($admin_check) return $admin_check;

        $limit = $request->query('limit', 20);
        $page = $request->query('page', 1);

        $users = User::with('tamagochi', 'statistic', 'setting')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'message' => 'Lista de usuarios',
            'data' => $users,
        ], 200);
    }

    /**
     * Obtener estadísticas de un usuario específico
     */
    public function getUserDetails($userId, Request $request)
    {
        $admin_check = $this->checkAdmin($request);
        if ($admin_check) return $admin_check;

        $user = User::with('tamagochi', 'statistic', 'setting')
            ->find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        return response()->json([
            'data' => $user,
        ], 200);
    }

    /**
     * Crear un nuevo usuario (como admin)
     */
    public function createUser(Request $request)
    {
        $admin_check = $this->checkAdmin($request);
        if ($admin_check) return $admin_check;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'sometimes|in:user,admin',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'] ?? 'user',
        ]);

        return response()->json([
            'message' => '✅ Usuario creado',
            'data' => $user,
        ], 201);
    }

    /**
     * Editar un usuario
     */
    public function updateUser($userId, Request $request)
    {
        $admin_check = $this->checkAdmin($request);
        if ($admin_check) return $admin_check;

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'role' => 'sometimes|in:user,admin',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => '✅ Usuario actualizado',
            'data' => $user,
        ], 200);
    }

    /**
     * Eliminar un usuario
     */
    public function deleteUser($userId, Request $request)
    {
        $admin_check = $this->checkAdmin($request);
        if ($admin_check) return $admin_check;

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        // No permitir eliminarse a sí mismo
        if ($user->id === $request->user()->id) {
            return response()->json([
                'message' => '❌ No puedes eliminarte a ti mismo',
            ], 403);
        }

        $user->delete();

        return response()->json([
            'message' => '✅ Usuario eliminado',
        ], 200);
    }

    /**
     * Cambiar rol de un usuario
     */
    public function changeUserRole($userId, Request $request)
    {
        $admin_check = $this->checkAdmin($request);
        if ($admin_check) return $admin_check;

        $validated = $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $user->update(['role' => $validated['role']]);

        return response()->json([
            'message' => '✅ Rol actualizado',
            'data' => $user,
        ], 200);
    }

    /**
     * Obtener estadísticas generales del sistema
     */
    public function getDashboard(Request $request)
    {
        $admin_check = $this->checkAdmin($request);
        if ($admin_check) return $admin_check;

        $stats = [
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_regular_users' => User::where('role', 'user')->count(),
            'users_logged_today' => User::whereDate('last_login', today())->count(),
            'total_tamagochis' => Tamagochi::count(),
            'average_tamagochi_level' => Tamagochi::avg('level'),
            'total_posts' => User::sum('statistic.total_posts') ?? 0,
            'total_likes' => User::sum('statistic.total_likes') ?? 0,
            'top_5_users' => User::with('statistic')
                ->orderByDesc('statistic.level')
                ->limit(5)
                ->get(['id', 'name', 'email', 'role', 'created_at']),
        ];

        return response()->json([
            'message' => 'Dashboard de administración',
            'data' => $stats,
        ], 200);
    }

    /**
     * Resetear tamagochi de un usuario
     */
    public function resetUserTamagochi($userId, Request $request)
    {
        $admin_check = $this->checkAdmin($request);
        if ($admin_check) return $admin_check;

        $user = User::with('tamagochi')->find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        if (!$user->tamagochi) {
            return response()->json([
                'message' => 'Usuario sin tamagochi',
            ], 404);
        }

        $user->tamagochi->update([
            'name' => 'Mi Tamagochi',
            'status' => 'normal',
            'energy' => 100,
            'hunger' => 50,
            'happiness' => 75,
            'health' => 100,
            'times_played' => 0,
            'level' => 1,
            'experience' => 0,
            'last_fed' => null,
            'last_played' => null,
        ]);

        return response()->json([
            'message' => '✅ Tamagochi reseteado',
            'data' => $user->tamagochi,
        ], 200);
    }

    /**
     * Listar actividad de usuarios (últimos logins)
     */
    public function getUserActivity(Request $request)
    {
        $admin_check = $this->checkAdmin($request);
        if ($admin_check) return $admin_check;

        $days = $request->query('days', 7);

        $activity = User::where('last_login', '>=', now()->subDays($days))
            ->orderByDesc('last_login')
            ->get(['id', 'name', 'email', 'last_login', 'created_at']);

        return response()->json([
            'message' => 'Actividad de usuarios últimos ' . $days . ' días',
            'data' => $activity,
        ], 200);
    }
}
