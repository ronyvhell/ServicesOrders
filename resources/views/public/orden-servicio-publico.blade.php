<!DOCTYPE html>
<html lang="es" class="bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Servicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm mb-8">
        <div class="max-w-7xl mx-auto px-2 py-2 sm:px-3 lg:px-3 flex items-center justify-center">
            <img src="/images/logo.png" alt="Logo" class="h-auto w-[200px]">
        </div>
    </header>
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 pb-6 border-b">
                <div>
                    <h1 class="text-2xl font-bold flex items-center gap-2 text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Orden de Servicio ORD-{{$record->id}}
                    </h1>
                    @php
                    $estado = $record->estado;
                    $estadoText = '';
                    $badgeColorClass = '';

                    switch ($estado) {
                        case 'recibido':
                            $estadoText = 'Recibido';
                            $badgeColorClass = 'bg-blue-500 text-white';  // color primario
                            break;
                        case 'diagnostico':
                            $estadoText = 'En Diagnóstico';
                            $badgeColorClass = 'bg-yellow-500 text-white';  // color de advertencia
                            break;
                        case 'aprobacion':
                            $estadoText = 'Esperando Aprobación';
                            $badgeColorClass = 'bg-blue-300 text-white';  // color de información
                            break;
                        case 'reparacion':
                            $estadoText = 'En Reparación';
                            $badgeColorClass = 'bg-green-500 text-white';  // color de éxito
                            break;
                        case 'entrega':
                            $estadoText = 'Listo para Entrega';
                            $badgeColorClass = 'bg-red-500 text-white';  // color de peligro
                            break;
                        case 'entregado':
                            $estadoText = 'Entregado';
                            $badgeColorClass = 'bg-gray-500 text-white';  // color gris
                            break;
                        case 'cancelado':
                            $estadoText = 'Cancelado';
                            $badgeColorClass = 'bg-black text-white';  // color oscuro
                            break;
                        default:
                            $estadoText = 'Desconocido';
                            $badgeColorClass = 'bg-gray-300 text-gray-800';  // color secundario
                    }
                @endphp

                <!-- Visualización del Estado con Estilos -->
                <span class="inline-block rounded-full px-3 py-1 text-sm font-semibold {{ $badgeColorClass }}">
                    {{ $estadoText }}
                </span>

                </div>
                <div class="mt-4 md:mt-0 flex flex-col md:flex-row gap-4 md:gap-8">
                    <div>
                        <p class="text-sm text-gray-600">Fecha de Ingreso</p>
                        <p class="font-semibold">{{$record->created_at}}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Fecha Estimada de Finalización</p>
                        <p class="font-semibold">{{$record->updated_at}}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Cliente -->
                <div class="bg-white p-6 rounded-lg shadow">
                     
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gray-300 rounded-full mx-auto mb-4"></div>
                        <h3 class="font-semibold text-lg">{{$record->cliente->nombre}} {{$record->cliente->apellido}}</h3>
                        <p class="text-gray-600">{{$record->cliente->telefono}}</p>
                        <p class="text-blue-600">{{$record->cliente->email}}</p>
                    </div>
                </div>

                <!-- Detalles del Vehículo -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Detalles del Vehículo
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 mb-4">
                            <div class="mx-auto max-w-[280px] aspect-[2.5/1] bg-yellow-400 rounded border-2 border-gray-800 p-2 shadow-lg">
                                <div class="h-full flex flex-col justify-center items-center bg-yellow-400 font-bold">
                                    <div class="text-3xl tracking-widest text-gray-900">{{$record->vehiculo->placa}}</div>
                                    <div class="text-sm text-gray-900 font-semibold">Care Autos</div>
                                </div>
                            </div>
                            <p class="text-center mt-2 text-sm text-gray-600">Placa del Vehículo</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Marca/Modelo</p>
                            <p class="font-semibold">{{$record->vehiculo->marca}}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Año</p>
                            <p class="font-semibold">{{$record->vehiculo->año}}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Color</p>
                            <p class="font-semibold">{{$record->vehiculo->color}}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Kilometraje</p>
                            <p class="font-semibold">{{$record->kilometraje}}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Nivel de Combustible</p>
                            <p class="font-semibold">{{$record->nivel_combustible}}</p>
                        </div>
                    </div>
                </div>

                <!-- Estado de Fluidos -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        Estado de Fluidos
                    </h2>
                    <div class="grid grid-cols-3 gap-4 text-center">
                        @foreach (['Aceite', 'Refrigerante', 'Líquido de Freno'] as $fluido)
                            <div>
                                @php
                                    $isAdecuado = in_array($fluido, $record->verificacion_fluidos);
                                    $iconColorClass = $isAdecuado ? 'bg-green-500' : 'bg-red-500';
                                    $textColorClass = $isAdecuado ? 'text-green-600' : 'text-red-600';
                                    $estadoText = $isAdecuado ? 'Adecuado' : 'Bajo';
                                    $iconPath = $isAdecuado 
                                        ? 'M5 13l4 4L19 7'  // Icono de check (adecuado)
                                        : 'M6 18L18 6M6 6l12 12'; // Icono de cruz (bajo)
                                @endphp

                                <div class="w-12 h-12 {{ $iconColorClass }} rounded-full mx-auto mb-2 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path>
                                    </svg>
                                </div>
                                <p class="font-semibold">{{ $fluido }}</p>
                                <p class="{{ $textColorClass }} text-sm">{{ $estadoText }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!--  -->
            </div>


            <!-- Detalles del Servicio -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Detalles del Servicio
                </h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700">Fallas Reportadas</h3>
                        <p>{!! $record->fallas_reportadas !!}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Servicio</h3>
                        <p>{{$record->servicio}}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Procedimientos Autorizados</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($record->procedimientos_autorizados as $procedimiento)
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    {{ $procedimiento }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Técnico Asignado</h3>
                        <p>{{ $record->tecnico->nombre ?? 'No asignado' }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Autorización de Ruta</h3>
                        <div class="flex items-center gap-2">
                        @if($record->autorizacion_prueba_ruta)
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                Sí, autorizo para prueba de Ruta
                            </span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                No, autorizo para prueba de Ruta
                            </span>
                        @endif
                    </div>
                    </div>
                </div>
            </div>

            <!-- Documentos y Objetos de Valor -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Documentos y Objetos de Valor
                </h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700">Documentos del Vehículo</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($record->documentos_vehiculo as $documento)
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $documento }}
                            </span>
                        @endforeach
                    </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Objetos de Valor</h3>
                        <p>{{$record->objetos_valor}}</p>
                    </div>
                </div>
            </div>

            <!-- Fotografías del Vehículo -->
            <!--  -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Fotografías del Vehículo
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach (['foto_frente' => 'Fotografía 1', 'foto_atras' => 'Fotografía 2', 'foto_lateral_izquierdo' => 'Fotografía 3', 'foto_lateral_derecho' => 'Fotografía 4'] as $foto => $label)
                        <div class="text-center">
                            <div 
                                class="bg-gray-100 dark:bg-gray-800 aspect-video rounded-lg flex items-center justify-center cursor-pointer"
                                onclick="openImageModal('{{ $record->$foto ? asset('storage/' . $record->$foto) : '' }}', '{{ $label }}')"
                            >
                                @if($record->$foto)
                                    <img src="{{ asset('storage/' . $record->$foto) }}" alt="Foto {{ $label }}" class="object-cover rounded-lg w-full h-full">
                                @else
                                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M8 7v10m8-10v10m4 0H4"></path>
                                    </svg>
                                @endif
                            </div>
                            <p class="font-medium mt-2">{{ $label }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Modal -->
                <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden" onclick="closeImageModal(event)">
                    <div class="relative max-w-4xl w-full p-4 bg-white rounded-lg">
                        <button 
                            onclick="closeImageModal(event)" 
                            class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 focus:outline-none"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <img id="modalImage" class="w-full h-auto max-h-[90vh] object-contain rounded-lg" />
                        <p id="modalLabel" class="text-center mt-4 text-lg font-semibold"></p>
                    </div>
                </div>
            </div>

            <script>
                function openImageModal(imageUrl, label) {
                    if (!imageUrl) return; // No hacer nada si no hay URL
                    const modal = document.getElementById('imageModal');
                    const modalImage = document.getElementById('modalImage');
                    const modalLabel = document.getElementById('modalLabel');
                    modalImage.src = imageUrl;
                    modalLabel.textContent = label;
                    modal.classList.remove('hidden');
                }

                function closeImageModal(event) {
                    const modal = document.getElementById('imageModal');
                    // Cierra solo si haces clic fuera del contenido del modal
                    if (event.target.id === 'imageModal' || event.type === 'click') {
                        modal.classList.add('hidden');
                    }
                }
            </script>


            <!--  -->

            <!-- Botones de Descarga -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Orden de Servicio
                </h2>
                <a href="{{ asset('storage/' . $record->orden_servicio) }}" download class="w-full">
                    <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Descargar
                    </button>
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Orden de Entrega
                </h2>
                <a href="{{ asset('storage/' . $record->orden_salida) }}" download class="w-full">
                    <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Descargar
                    </button>
                </a>
            </div>
        </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>