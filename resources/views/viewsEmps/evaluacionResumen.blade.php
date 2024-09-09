{{-- VISTA RESUMEN DE EVALUACIONES DE EMPLEADOS --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Resumen Evaluciones') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor"">

        <div class="d-flex w-100 text-center text-white">
            @if ($bolean == TRUE)
                <div class="flex-grow-1">
                    <h4>Evaluaciones de los Empleados</h4>
                </div>
            @else
                <div>
                    <a href="{{route('evaluaciones.index')}}" class="btn btn-outline-warning mx-1 my-1" title="Resumen Permisos">
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
                <a class="btn btn-outline-warning me-3" href="{{route("evaluaciones.create")}}">Crear Evaluación</a>

                <form class="d-flex flex-grow-1 from-createEmp" id="formBusquedaCodigo" action="{{ route('evaluaciones.find') }}" method="POST">
                    @csrf
                    <input type="date" class="form-control bg-transparent text-white me-2" 
                        name="fecha_evaluacion" value="{{ old('fecha_evaluacion') }}">

                    <input type="text" id="buscarForm" class="form-control bg-transparent border-white text-white me-2" placeholder="Buscar por Código" 
                        name="buscarCodigo" value="{{ old('buscarCodigo') }}"> 

                    <button class="btn btn-outline-warning" type="submit">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </form>
            </div>
            <hr class="text-white mb-4"> 
        @endif

        <div class="d-flex flex-wrap justify-content-center mt-4">
            @foreach ($evaluaciones as $item)
                <div class="card bg-transparent text-white border mb-3 me-3" style="width: 500px;">
                    <div class="card-header border-bottom d-flex justify-content-between">
                        <h5>Código de la Evaluación: <b class="text-warning">{{$item->codigo_eval}}</b></h5>
                    </div>
                    <div class="card-body border-bottom d-flex justify-content-between">
                        <div class="text-start">
                            <h5 class="card-title text-warning">Aspectos Evaluados</h5>
                            <h6 class="card-title">Higiene: <b class="text-warning">{{$item->nota1}}</b></h6>
                            <h6 class="card-title">Vestimenta: <b class="text-warning">{{$item->nota2}}</b></h6>
                            <h6 class="card-title">Buen Trato al Cliente: <b class="text-warning">{{$item->nota3}}</b></h6>
                            <h6 class="card-title">Conocimiento de Menús: <b class="text-warning">{{$item->nota4}}</b></h6>
                            <h6 class="card-title">Trabajo en Equipo: <b class="text-warning">{{$item->nota5}}</b></h6>
                            <h6 class="card-title">Calificación Total: <b class="text-success">{{$item->suma_notas}}</b></h6>
                        </div>
                        <div class="text-center">
                            <h5 class="card-title text-warning">Empleado</h5>
                            <a href="{{route('evaluaciones.showEmp', $item->id_persona)}}"
                                class="btn btn-outline-warning" title="Detalles">
                                {{$item->identificacion}}
                            </a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h6 class="card-title">Fecha de la Evaluación: <b class="text-warning">{{\Carbon\Carbon::parse($item->fecha_evaluacion)->format('d/m/Y')}}</b></h6>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    {{-- SCRIPTS URILIZADOS EN ESTA VISTA --}}
    <script>
        // PREVENIR EL ENVIO DEl FORMULARIO DE BUSQUEDA
        const formBusquedaCodigo = document.getElementById("formBusquedaCodigo");

        formBusquedaCodigo.addEventListener("submit", (e) => {
            const codigoInput = formBusquedaCodigo.querySelector('input[name="buscarCodigo"]');
            const fechaInput = formBusquedaCodigo.querySelector('input[name="fecha_evaluacion"]');
            
            if (!codigoInput.value && !fechaInput.value) {
                e.preventDefault(); 
                alertify.error('¡Ingresa un Código o Fecha para poder Buscar!');
            } else {
                console.log("Formulario de código enviado");
            }
        });
    </script>

@endsection
