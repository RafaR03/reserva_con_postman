<?php

namespace App\Http\Controllers;

use App\Models\Reservanolog;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservaMail;

class ReservaNologController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validar y crear la reserva
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:reservasnologs',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
                'tarjeta_credito' => 'required|string|max:255',
                'numero_personas' => 'required|integer|min:1',
            ]);

            // Crear la reserva
            $reserva = Reservanolog::create($validatedData);

            // Actualizar el estado de disponibilidad en la tabla Horarios
            $horario = Horario::where('fecha', $validatedData['fecha'])
                ->where('hora', $validatedData['hora'])
                ->first();

            if ($horario) {
                $horario->update(['disponible' => false]);
            }/*  */

            return response()->json(['message' => 'Reserva creada correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear la reserva: ' . $e->getMessage()], 500);
        }
    }


    public function enviarCorreo(Request $request)
    {
        try {
            $data = $request->all();

            // Verifica si existe la clave 'email' en los datos recibidos
            if (isset($data['email'])) {
                $correoDestino = $data['email'];

                // Enviar el correo al correo electrónico obtenido de los datos
                Mail::to($correoDestino)->send(new ReservaMail($data));

                return response()->json(['message' => 'Correo enviado correctamente'], 200);
            } else {
                // Si no se proporcionó una dirección de correo electrónico, devuelve un error
                return response()->json(['message' => 'No se proporcionó una dirección de correo electrónico'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al enviar el correo electrónico: ' . $e->getMessage()], 500);
        }
    }
}
