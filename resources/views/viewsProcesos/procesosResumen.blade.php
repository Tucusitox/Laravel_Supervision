{{-- VISTA RESUMEN PROCESOS --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Resumen Procesos') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <div class="d-flex w-100 text-center text-white">
            @if ($bolean === TRUE)
                <div class="flex-grow-1">
                    <h4>Resumen de Procesos</h4>
                </div>
            @elseif ($bolean === "evaluado")
                <div>
                    <a href="{{route('procesos.evaluaciones')}}" class="btn btn-outline-warning mx-1 my-1" title="Resumen Evaluaciones">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
                <div class="flex-grow-1">
                    <h4>¡Proceso Encontrado con Éxito!</h4>
                </div>
            @elseif ($bolean === "procesDestac")
                <div>
                    <a href="{{route('procesos.procesDestac')}}" class="btn btn-outline-warning mx-1 my-1" title="Procesos Destacados">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
                <div class="flex-grow-1">
                    <h4>¡Proceso Encontrado con Éxito!</h4>
                </div>
            @else
                <div>
                    <a href="{{route('procesos.index')}}" class="btn btn-outline-warning mx-1 my-1" title="Resumen Procesos">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
                <div class="flex-grow-1">
                    <h4>¡Proceso Encontrado con Éxito!</h4>
                </div>
            @endif
        </div>
        <hr class="text-white">

        {{-- FORMULARIO PARA BUSCAR UN PROCESO POR FECHA O CODIGO --}}
        @if ($bolean === TRUE)
            <div class="d-flex justify-content-between align-items-center py-2">
                <a class="btn btn-outline-warning boton me-3" href="{{route("procesos.create")}}">Crear Proceso</a>

                <form class="d-flex flex-grow-1 from-createEmp" id="formBusquedaCodigo" action="{{ route('procesos.show') }}" method="POST">
                    @csrf
                    <input type="date" class="form-control bg-transparent text-white me-2" 
                        name="fecha_proceso" value="{{ old('fecha_proceso') }}">

                    <input type="text" id="buscarForm" class="form-control bg-transparent border-white text-white me-2" placeholder="Buscar por Código" 
                        name="buscarCodigo" value="{{ old('buscarCodigo') }}"> 

                    <button class="btn btn-outline-warning boton" type="submit">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </form>
            </div>
            <hr class="text-white">
        @endif
        
        {{-- MOSTRAR LOS PROCESOS EN CARDS COON UN CONDICIONAL --}}
        @foreach ($procesos as $item)
            <div class="card w-100 my-3 bg-transparent border border-white text-white p-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="codigo card-title mb-2 text-warning">{{$item->codigo_proces}}</h5>
                            <h5>{{$item->asunto_proceso}}</h5>
                        </div>
                        <div class="mt-1">
                            <h6 class="card-subtitle mb-2 "><b class="text-warning">Tipo de Proceso:</b>
                                {{$item->nombre_tipoProces}}
                            </h6>
                            <h6 class="card-subtitle mb-2"><b class="text-warning">Tiempo de Duración:</b>
                                {{\Carbon\Carbon::parse($item->tiempo_duracion)->format('h:i:s')}}
                            </h6>
                        </div>
                    </div>
                    <hr class="text-white">
                    <p class="card-text">{{$item->descripcion_proces}}</p>
                    <hr class="text-white">
                    <div class="d-flex justify-content-between">
                        <div class="mt-1">
                            <h6 class="card-subtitle mb-2"><b class="text-warning">Espacio del Proceso:</b>
                                {{$item->nombre_espacio}}
                            </h6>
                            <h6 class="card-subtitle mb-2 "><b class="text-warning">Fecha de Creación:</b>
                                {{\Carbon\Carbon::parse($item->fecha_proceso)->format('d/m/Y')}}
                            </h6>
                        </div>
                        <div class="text-center">
                            <a href="{{route("procesos.evaluacionShow",$item->id_proceso)}}" 
                                class="btn btn-outline-primary mx-1 my-1" title="Crear una Evaluación">
                                <i class='bx bxs-user-check'></i>
                            </a>
                            <a href="{{route("procesos.edit", $item->id_proceso)}}" 
                                class="btn btn-outline-info mx-1 my-1" title="Editar">
                                <i class='bx bx-edit'></i>
                            </a>
                            <a href="{{route("procesos.delete",$item->id_proceso)}}" class="btn btn-outline-danger mx-1" title="Eliminar">
                                <i class='bx bx-trash'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- SCRIPTS URILIZADOS EN ESTA VISTA --}}
    <script>
        // PREVENIR EL ENVIO DEl FORMULARIO DE BUSQUEDA
        const formBusquedaCodigo = document.getElementById("formBusquedaCodigo");

        formBusquedaCodigo.addEventListener("submit", (e) => {
            const codigoInput = formBusquedaCodigo.querySelector('input[name="buscarCodigo"]');
            const fechaInput = formBusquedaCodigo.querySelector('input[name="fecha_proceso"]');
            
            if (!codigoInput.value && !fechaInput.value) {
                e.preventDefault(); 
                alertify.error('¡Ingresa un Código o Fecha para poder Buscar!');
            } else {
                console.log("Formulario de código enviado");
            }
        });
    </script>

@endsection
