{{-- VISTA RESUMEN DE EVALUACIONES DE PROCESOS --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Evaluaciones de Procesos') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor"">

        <div class="d-flex w-100 text-center text-white">
            @if ($bolean == TRUE)
                <div class="flex-grow-1">
                    <h4>Evaluaciones de los Procesos</h4>
                </div>
            @else
                <div>
                    <a href="{{route('procesos.evaluaciones')}}" class="btn btn-outline-warning mx-1 my-1" title="Evaluaciones Procesos">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
                <div class="flex-grow-1">
                    <h4>¡Evaluaciones Encontradas con Éxito!</h4>
                </div>
            @endif
        </div>
        <hr class="text-white">

        {{-- FORMULARIO PARA BUSCAR EVALUACION POR FECHA O CODIGO --}}
        @if ($bolean !== FALSE)
            <div class="d-flex justify-content-between align-items-center py-2">
                <a class="btn btn-outline-warning me-3" href="{{route("procesos.evaluacionCreate")}}">Crear Evaluación</a>

                <form class="d-flex flex-grow-1 from-createEmp" id="formBusquedaCodigo" action="{{ route('procesos.evaluacionFiltro') }}" method="POST">
                    @csrf
                    <input type="date" class="form-control bg-transparent text-white me-2" 
                        name="fecha_proceso" value="{{ old('fecha_proceso') }}">

                    <input type="text" id="buscarForm" class="form-control bg-transparent border-white text-white me-2" placeholder="Buscar por Código" 
                        name="buscarCodigo" value="{{ old('buscarCodigo') }}"> 

                    <button class="btn btn-outline-warning" type="submit">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </form>
            </div>
            <hr class="text-white mb-4"> 
        @endif

        <!-- TABLA PARA MOSTRAR LAS EVALUACIONES DE LOS PROCESOS -->

        <table class="tabla mt-2">
            <thead class="thead">
                <tr id="trFifo">
                    <th>Código</th>
                    <th>Fecha</th>
                    <th>Eficiencia</th>
                    <th>Efectividad</th>
                    <th>Flexibilidad</th>
                    <th>Consistencia</th>
                    <th>Mejora Continua</th>
                    <th>Calificación</th>
                    <th>Proceso</th>
                </tr>
            </thead>
            {{-- PARA MOSTRAR LA INFORMCION ITERAMOS CON UN BUCLE FOREACH --}}
            <tbody>
                @foreach ($evaluaciones as $index => $item)
                    <tr class="tr">
                        <td>{{$item->codigo_eval}}</>
                        <td>{{\Carbon\Carbon::parse($item->fecha_evaluacion)->format('d/m/Y')}}</td>
                        <td>{{$notas[$index]->nota1}}</td>
                        <td>{{$notas[$index]->nota2}}</td>
                        <td>{{$notas[$index]->nota3}}</td>
                        <td>{{$notas[$index]->nota4}}</td>
                        <td>{{$notas[$index]->nota5}}</td>
                        <td>{{$notas[$index]->suma_notas}}</td>
                        <td>
                            <a href="{{route('procesos.unProceso', $item->id_proceso)}}"
                                class="btn btn-outline-primary mx-1 my-1" title="Detalles">
                                <i class='bx bx-cog'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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
