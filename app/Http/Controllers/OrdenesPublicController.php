<?php

namespace App\Http\Controllers;

use App\Models\OrdenesServicio;
use Illuminate\Http\Request;

class OrdenesPublicController extends Controller
{
    public function show($public_token)
    {
        // Busca la orden utilizando el token público
        $record = OrdenesServicio::with(['cliente', 'vehiculo', 'tecnico']) // Carga las relaciones necesarias
            ->where('public_token', $public_token)
            ->firstOrFail();

        // Retorna la vista pública
        return view('public.orden-servicio-publico', compact('record'));
    }
}


