<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TamagochiController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rutas públicas de autenticación
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Rutas públicas de estadísticas
Route::get('/statistics/leaderboard', [StatisticsController::class, 'leaderboard']);
Route::get('/statistics/global', [StatisticsController::class, 'globalStats']);
Route::get('/users/{userId}', [SettingsController::class, 'publicProfile']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Tamagochi - Estado y acciones
    Route::prefix('tamagochi')->group(function () {
        Route::get('/', [TamagochiController::class, 'show'])->name('tamagochi.show');
        Route::post('/feed', [TamagochiController::class, 'feed'])->name('tamagochi.feed');
        Route::post('/play', [TamagochiController::class, 'play'])->name('tamagochi.play');
        Route::post('/sleep', [TamagochiController::class, 'sleep'])->name('tamagochi.sleep');
        Route::put('/update-name', [TamagochiController::class, 'updateName'])->name('tamagochi.updateName');
    });

    // Estadísticas del usuario
    Route::prefix('statistics')->group(function () {
        Route::get('/my-stats', [StatisticsController::class, 'myStats'])->name('statistics.myStats');
        Route::get('/user/{userId}', [StatisticsController::class, 'userStats'])->name('statistics.userStats');
    });

    // Configuración de cuenta
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'show'])->name('settings.show');
        Route::put('/', [SettingsController::class, 'update'])->name('settings.update');
        Route::post('/change-password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
        Route::delete('/delete-account', [SettingsController::class, 'deleteAccount'])->name('settings.deleteAccount');
    });

    // ADMIN - Gestión de usuarios y sistema
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'getDashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'getAllUsers'])->name('admin.users');
        Route::get('/users/{userId}', [AdminController::class, 'getUserDetails'])->name('admin.userDetails');
        Route::post('/users', [AdminController::class, 'createUser'])->name('admin.createUser');
        Route::put('/users/{userId}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
        Route::delete('/users/{userId}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        Route::put('/users/{userId}/role', [AdminController::class, 'changeUserRole'])->name('admin.changeRole');
        Route::post('/users/{userId}/tamagochi/reset', [AdminController::class, 'resetUserTamagochi'])->name('admin.resetTamagochi');
        Route::get('/activity', [AdminController::class, 'getUserActivity'])->name('admin.activity');
    });
});


