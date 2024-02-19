<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Horario;

class HorariosController extends Controller
{
    public function index()
    {
        $horarios = Horario::where('disponible', true)->get();
        return response()->json($horarios);
    }
    public function actualizarDisponibilidad($fecha, $hora)
{
    try {
        // Buscar el horario por fecha y hora
        $horario = Horario::where('fecha', $fecha)->where('hora', $hora)->first();

        if (!$horario) {
            return response()->json(['message' => 'Horario no encontrado'], 404);
        }

        // Actualizar el campo disponible a true
        $horario->update(['disponible' => true]);

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Disponibilidad actualizada correctamente']);
    } catch (Exception $e) {
        return response()->json(['message' => 'Error al actualizar la disponibilidad'], 500);
    }
}
}
