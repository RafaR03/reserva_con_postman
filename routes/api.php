<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\ReservaNologController;
use App\Http\Controllers\Api\ReservaAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/userRegister', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser']);

Route::put('/loginPrueba', [ReservaController::class, 'loginPrueba']);

Route::get('/horarios', [HorariosController::class, 'index']);
Route::post('/reservasnologs', [ReservaNologController::class, 'store']);
Route::post('/enviar-correo', [ReservaNologController::class, 'enviarCorreo']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user-data', [AuthController::class, 'getUserData']);
    Route::post('/crearReserva', [ReservaAuthController::class, 'crearReserva']);
    Route::get('/obtenerReserva', [ReservaAuthController::class, 'obtenerReserva']);
    Route::delete('/borrarReserva/{id}', [ReservaAuthController::class, 'borrarReserva']);
    Route::put('/actualizarDisponibilidad/{fecha}/{hora}', [HorariosController::class, 'actualizarDisponibilidad']);
    Route::get('/tarjetas', [CreditCardController::class, 'index']);
    Route::post('/tarjetas', [CreditCardController::class, 'store']);
})
?>