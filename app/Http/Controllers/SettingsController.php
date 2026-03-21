<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Obtener configuración del usuario actual
     */
    public function show(Request $request)
    {
        $settings = $request->user()->setting;

        if (!$settings) {
            return response()->json([
                'message' => 'Configuración no encontrada',
            ], 404);
        }

        return response()->json([
            'data' => $settings,
        ], 200);
    }

    /**
     * Actualizar configuración del usuario
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'theme' => 'sometimes|in:light,dark',
            'language' => 'sometimes|in:es,en',
            'notifications_enabled' => 'sometimes|boolean',
            'email_notifications' => 'sometimes|boolean',
            'push_notifications' => 'sometimes|boolean',
            'tamagochi_notifications' => 'sometimes|boolean',
            'notification_frequency' => 'sometimes|integer|min:5|max:1440',
            'private_profile' => 'sometimes|boolean',
            'show_statistics' => 'sometimes|boolean',
            'two_factor_enabled' => 'sometimes|boolean',
            'bio' => 'sometimes|string|max:500',
            'avatar_url' => 'sometimes|string|max:500',
        ]);

        $settings = $request->user()->setting;

        if (!$settings) {
            return response()->json([
                'message' => 'Configuración no encontrada',
            ], 404);
        }

        $settings->update($validated);

        return response()->json([
            'message' => '✅ Configuración actualizada',
            'data' => $settings,
        ], 200);
    }

    /**
     * Cambiar contraseña del usuario
     */
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json([
                'message' => '❌ Contraseña actual incorrecta',
            ], 401);
        }

        $user->update(['password' => Hash::make($validated['new_password'])]);

        return response()->json([
            'message' => '✅ Contraseña actualizada',
        ], 200);
    }

    /**
     * Eliminar cuenta de usuario
     */
    public function deleteAccount(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string',
        ]);

        $user = $request->user();

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => '❌ Contraseña incorrecta',
            ], 401);
        }

        // Revocar todos los tokens
        $user->tokens()->delete();

        // Eliminar el usuario (eliminará datos relacionados en cascada)
        $user->delete();

        return response()->json([
            'message' => '✅ Cuenta eliminada',
        ], 200);
    }

    /**
     * Obtener información de perfil público
     */
    public function publicProfile($userId)
    {
        $user = \App\Models\User::with('setting', 'statistic', 'tamagochi')
            ->find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        // No mostrar datos privados
        $profile = [
            'id' => $user->id,
            'name' => $user->name,
            'created_at' => $user->created_at,
        ];

        // Solo mostrar si el perfil no es privado
        if (!$user->setting->private_profile) {
            $profile['bio'] = $user->setting->bio;
            $profile['avatar_url'] = $user->setting->avatar_url;
            $profile['level'] = $user->statistic->level;
            $profile['followers_count'] = $user->statistic->followers_count;
            $profile['following_count'] = $user->statistic->following_count;
            $profile['tamagochi'] = $user->tamagochi->only('name', 'status', 'level');
        }

        return response()->json([
            'data' => $profile,
        ], 200);
    }
}
