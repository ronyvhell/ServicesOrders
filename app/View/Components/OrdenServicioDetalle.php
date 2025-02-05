<?php

namespace App\View\Components;

use App\Models\OrdenesServicio;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrdenServicioDetalle extends Component
{
    /**
     * La orden de servicio que se va a mostrar.
     */
    public OrdenesServicio $orden;

    /**
     * Create a new component instance.
     */
    public function __construct(OrdenesServicio $orden)
    {
        $this->orden = $orden;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.orden-servicio-detalle', compact('record'));
    }
}
