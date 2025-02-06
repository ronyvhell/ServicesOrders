<?php

namespace App\Http\Controllers;

use App\Models\ClientesRecurrentes;
use Illuminate\Http\Request;

class ClientesRecurrentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientesRecurrentes = ClientesRecurrentes::with('cliente')
            ->orderBy('total_visitas', 'desc')
            ->paginate(10);

        return view('clientes-recurrentes.index', compact('clientesRecurrentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Método para actualizar o crear registro de cliente recurrente
    public function actualizarClienteRecurrente($clienteId, $servicio)
    {
        $clienteRecurrente = ClientesRecurrentes::where('cliente_id', $clienteId)->first();

        if (!$clienteRecurrente) {
            $clienteRecurrente = new ClientesRecurrentes();
            $clienteRecurrente->cliente_id = $clienteId;
            $clienteRecurrente->total_visitas = 1;
        } else {
            $clienteRecurrente->total_visitas++;
        }

        $clienteRecurrente->ultimo_servicio = $servicio;
        $clienteRecurrente->tipo_servicio = $this->obtenerTipoServicio($servicio);
        $clienteRecurrente->fecha_ultima_visita = now();
        $clienteRecurrente->save();
    }

    private function obtenerTipoServicio($servicio)
    {
        // Lógica para determinar el tipo de servicio
        // Puedes personalizar según tus necesidades
        return 'Tipo de Servicio';
    }
}
