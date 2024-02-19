<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditCard;

class CreditCardController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todas las tarjetas asociadas al usuario
        $user = $request->user();
        $tarjetas = CreditCard::where('user_id', $user->id)->get();
        return response()->json($tarjetas);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'numero_tarjeta' => 'required|string',
            'cvv' => 'required|string',
            'fecha_caducidad' => 'required|string',
        ]);

        // Obtener el usuario autenticado
        $user = $request->user();

        // Crear una nueva tarjeta asociada al usuario
        $tarjeta = new CreditCard();
        $tarjeta->user_id = $user->id;
        $tarjeta->numero_tarjeta = $request->input('numero_tarjeta');
        $tarjeta->cvv = $request->input('cvv');
        $tarjeta->fecha_caducidad = $request->input('fecha_caducidad');
        $tarjeta->save();

        return response()->json(['message' => 'Tarjeta agregada correctamente'], 201);
    }
}
