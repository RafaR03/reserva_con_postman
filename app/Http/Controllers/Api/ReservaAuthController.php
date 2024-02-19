<?php

namespace App\Http\Controllers\Api;

use App\Models\Reserva;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Models\Horario;


class ReservaAuthController extends Controller
{
    public function crearReserva(Request $request)
    {
        try {
            // Obtener los datos del formulario
            $data = $request->input();

            // Agregar el user_id desde el token
            $user_id = $request->user()->id;
            $data['user_id'] = $user_id;

            // Crear la reserva con los datos del formulario
            $reserva = Reserva::create($data);

            // Actualizar el estado de disponibilidad en la tabla Horarios
            $horario = Horario::where('fecha', $data['fecha'])
                ->where('hora', $data['hora'])
                ->first();

            if ($horario) {
                $horario->update(['disponible' => false]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Reserva creada'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Reserva no creada'
            ], 500);
        }
    }

    public function obtenerReserva(Request $request)
    {
        try {
            $user_id = $request->user()->id;
            $reservas = Reserva::where('user_id', $user_id)->get();

            return response()->json([
                'status' => true,
                'reservas' => $reservas // Devolver directamente las reservas
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'No se han encontrado reservas'
            ], 500);
        }
    }

    public function borrarReserva($id, Request $request)
    {
        $data = $request->input();
        $user_id = $request->user()->id;
        try {

            // Buscar la reserva por su ID
            $reserva = Reserva::where('id', $id)->where('user_id', $user_id)->first();

            // Verificar si la reserva existe
            if (!$reserva) {
                return response()->json(['message' => 'Reserva no encontrada'], 404);
            }

            // Eliminar la reserva
            $reserva->delete();

            // Actualizar el estado de disponibilidad en la tabla Horarios
            $horario = Horario::where('fecha', $data['fecha'])
                ->where('hora', $data['hora'])
                ->first();

            if ($horario) {
                $horario->update(['disponible' => true]);
            }
            // Devuelvo un mensaje para informar de que se ha borrado correctamente
            return response()->json(['message' => 'Reserva eliminada correctamente']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Reserva no eliminada ']);
        }
    }
}
