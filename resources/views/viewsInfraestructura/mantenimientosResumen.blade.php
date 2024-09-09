{{-- VISTA RESUMEN DE MANTENIMIENTOS --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Resumen Infraestructura') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <div class="d-flex w-100 text-center text-white">
            @if ($bolean == FALSE)
                <div>
                    <a href="{{route('mantenimientos.index')}}" class="btn btn-warning mx-1 my-1" title="Resumen Mantenimientos">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
                <div class="flex-grow-1">
                    <h4>¡Mantenimiento Encontrado con Éxito!</h4>
                </div>
            @else
                <div class="flex-grow-1">
                    <h4>Resumen de Mantenimientos</h4>
                </div>
            @endif
        </div>
        <hr class="text-white">

        @if ($bolean !== FALSE)
            <div class="d-flex align-items-center my-4">
                <a class="btn btn-outline-warning me-3" href="{{route("mantenimientos.create")}}">Reportar Falla</a>
                {{-- BUSCADOR POR TIPO DE EQUIPO--}}
                <form class="d-flex from-createEmp flex-grow-1" id="formBusquedaCodigo" action="{{ route('mantenimientos.find') }}" method="POST">
                    @csrf
                    <input type="date" class="form-control bg-transparent text-white me-2" 
                        name="fecha_falla" value="{{ old('fecha_falla') }}">

                    <input type="text" id="buscarForm" class="form-control bg-transparent border-white text-white me-2" placeholder="Buscar por Código" 
                        name="buscarCodigo" value="{{ old('buscarCodigo') }}"> 
                    <button class="btn btn-outline-warning" type="submit">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </form>
            </div>
            <hr class="text-white">
        @endif

        {{-- MOSTRAR LA INFORMACION EN CARDS ITERANDOLAS CON UN FOREACH --}}
        @foreach ($fallas as $item)
            <div class="card bg-transparent text-white border my-3 py-2">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h5>Código de la Falla: <b class="text-warning">{{$item->codigo_event}}</b></h5>
                    <h5 class="card-title">Fecha de Creación: <b class="text-warning">{{$item->fechaCreacion_event->format("d/m/Y")}}</b></h5>
                </div>
                <div class="card-body border-bottom">
                    <h5 class="card-title text-warning">{{$item->asunto_event}}</h5>
                    <p class="card-text">
                        {{$item->descripcion_event}}
                    </p>
                </div>
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div class="card-footer">
                        <h6 class="card-title">Fecha de Incio de la Falla: <b class="text-warning">{{$item->fecha_inicioEvent->format("d/m/Y")}}</b></h6>
                        @if ($item->fecha_finEvent !== NULL)
                            <h6 class="card-title">Fecha de Solución de la Falla: <b class="text-warning">{{$item->fecha_inicioEvent->format("d/m/Y")}}</b></h6>
                        @else
                            <h6 class="card-title">Fecha de Solución de la Falla: <b class="text-warning">Por Definir</b></h6>
                        @endif
                        @if ($item->tipo_estatu === "Iniciada")
                            <h6 class="card-title">Estatus de la Falla: <b class="text-warning">{{$item->tipo_estatu}}</b></h6>
                        @elseif ($item->tipo_estatu === "En Proceso")
                            <h6 class="card-title">Estatus de la Falla: <b class="text-info">{{$item->tipo_estatu}}</b></h6>
                        @else
                            <h6 class="card-title">Estatus de la Falla: <b class="text-success">{{$item->tipo_estatu}}</b></h6>
                        @endif
                    </div>
                    <div class="card-footer">
                        @if ($item->tipo_estatu === "Solucionada")
                            <a href="{{route('mantenimientos.show', $item->id_elementInfra)}}" 
                                class="btn btn-outline-warning mx-1 my-1" title="Ver Equipo">
                                Ver Equipo
                            </a>
                        @else
                            <a href="{{route('mantenimientos.edit', $item->id_eventualidad)}}" 
                                class="btn btn-outline-info mx-1 my-1" title="Cambiar Estatus">
                                Cambiar Estatus
                            </a>
                            <a href="{{route('mantenimientos.show', $item->id_elementInfra)}}" 
                                class="btn btn-outline-warning mx-1 my-1" title="Ver Equipo">
                                Ver Equipo
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- PREVENIR EL ENVIO DEl FORMULARIO DE BUSQUEDA --}}
    <script>
        const formBusquedaCodigo = document.getElementById("formBusquedaCodigo");

        formBusquedaCodigo.addEventListener("submit", (e) => {
            const codigoInput = formBusquedaCodigo.querySelector('input[name="buscarCodigo"]');
            const fechaInput = formBusquedaCodigo.querySelector('input[name="fecha_falla"]');
            
            if (!codigoInput.value && !fechaInput.value) {
                e.preventDefault(); 
                alertify.error('¡Ingresa un Código o Fecha para poder Buscar!');
            } else {
                console.log("Formulario de código enviado");
            }
        });
    </script>

@endsection
