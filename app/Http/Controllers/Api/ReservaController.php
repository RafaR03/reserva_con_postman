<?php

namespace App\Http\Controllers\Api;

use App\Models\Reserva;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ReservaController extends Controller
{

    //La función "consultarReservas" recupera todas las reservas de la base de datos y las devuelve como respuesta JSON.
    public function consultarReservas()
    {
        // Consulta todas las reservas
        $reservas = Reserva::all();
        //Devuelvo un json con todas las reservas que tengo creadas en la tabla de la base de datos
        return response()->json($reservas);
    }

    //La función insertarReserva inserta una nueva reserva en la base de datos y devuelve una respuesta
    // JSON indicando si la inserción fue exitosa o no.
    public function insertarReserva(Request $request)
    {
        try {
            // Crear una nueva reserva
            $reserva = Reserva::create([
                'num_personas' => $request->input('num_personas'),
                'fecha_hora' => $request->input('fecha_hora'),
            ]);

            // Guardar la reserva en la base de datos
            $reserva->save();

            // Devuelvo un mensaje para informar de que se ha insertado correctamente
            return response()->json(['message' => 'Reserva insertada correctamente']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Reserva no insertada ']);
        }
    }

    //La función "borrarReserva" elimina una reserva por su ID y devuelve una respuesta JSON indicando si
    // la eliminación fue exitosa o no.
    public function borrarReserva($id)
    {
        try {
            // Buscar la reserva por su ID
            $reserva = Reserva::find($id);

            // Verificar si la reserva existe
            if (!$reserva) {
                return response()->json(['message' => 'Reserva no encontrada'], 404);
            }

            // Eliminar la reserva
            $reserva->delete();

            // Devuelvo un mensaje para informar de que se ha borrado correctamente
            return response()->json(['message' => 'Reserva eliminada correctamente']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Reserva no eliminada ']);
        }
    }

    // La función actualiza una reserva con los datos proporcionados si existe.
    public function actualizarReserva(Request $request, $id)
    {
        try {
            // Buscar la reserva por su ID
            $reserva = Reserva::find($id);

            // Verificar si la reserva existe
            if (!$reserva) {
                return response()->json(['message' => 'Reserva no encontrada'], 404);
            }

            // Actualizar los campos de la reserva si se proporcionan en la solicitud
            if ($request->has('num_personas')) {
                $reserva->num_personas = $request->input('num_personas');
            }

            if ($request->has('fecha_hora')) {
                $reserva->fecha_hora = $request->input('fecha_hora');
            }

            // Guardar los cambios en la base de datos
            $reserva->save();

            // Devuelvo un mensaje para informar de que se ha actualizado correctamente
            return response()->json(['message' => 'Reserva actualizada correctamente']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Reserva no actualizada']);
        }
    }
    public function loginPrueba()
    {
        $user = User::find(1);

        return $user->createToken('asdadfdas')->plainTextToken;
    }
}
