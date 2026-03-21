<?php

namespace App\Http\Controllers;

use App\Models\Tamagochi;
use Illuminate\Http\Request;

class TamagochiController extends Controller
{
    /**
     * Obtener estado del tamagochi del usuario actual
     */
    public function show(Request $request)
    {
        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        return response()->json([
            'data' => $tamagochi,
        ], 200);
    }

    /**
     * Alimentar al tamagochi
     */
    public function feed(Request $request)
    {
        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        $tamagochi->feed();

        return response()->json([
            'message' => '✅ ¡Tu tamagochi ha sido alimentado!',
            'data' => $tamagochi,
        ], 200);
    }

    /**
     * Jugar con el tamagochi
     */
    public function play(Request $request)
    {
        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        $tamagochi->play();

        return response()->json([
            'message' => '✅ ¡Ha sido una sesión divertida!',
            'data' => $tamagochi,
        ], 200);
    }

    /**
     * Descansar con el tamagochi
     */
    public function sleep(Request $request)
    {
        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        $tamagochi->sleep();

        return response()->json([
            'message' => '✅ ¡Tu tamagochi está descansando!',
            'data' => $tamagochi,
        ], 200);
    }

    /**
     * Actualizar nombre del tamagochi
     */
    public function updateName(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        $tamagochi->update(['name' => $validated['name']]);

        return response()->json([
            'message' => '✅ Nombre actualizado',
            'data' => $tamagochi,
        ], 200);
    }
}
