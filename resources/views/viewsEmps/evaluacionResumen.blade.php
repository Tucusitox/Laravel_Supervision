{{-- VISTA RESUMEN DE EVALUACIONES DE EMPLEADOS --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Resumen Evaluciones') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor"">

        {{-- ALERTA CUANDO HAY UN REGISTRO EXITOSO --}}
        @if ($mensaje = Session::get('success'))
            <div class="alert alert-success text-center container w-50" role="alert">
                {{$mensaje}}
            </div>
        @endif

        {{-- ALERTA SI EL USUARIO NO LLENA EL CAMPO DEL INPUT DE BUSQUEDA --}}
        @error('buscarCodigo')
            <div class="alert alert-danger text-center container w-75">{{ $message }}</div>
        @enderror

        <div class="d-flex w-100 text-center text-white">
            @if ($bolean == TRUE)
                <div class="flex-grow-1">
                    <h4>Evaluaciones de los Empleados</h4>
                </div>
            @else
                <div>
                    <a href="{{route('evaluaciones.index')}}" class="btn btn-warning mx-1 my-1" title="Resumen Permisos">
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
        <div class="d-flex justify-content-between align-items-center py-2">
            <a class="btn btn-dark boton me-3" href="{{route("evaluaciones.create")}}">Crear Evaluación</a>

            <form class="d-flex flex-grow-1 from-createEmp" id="formBusquedaCodigo" action="{{ route('evaluaciones.find') }}" method="POST">
                @csrf
                <input type="date" class="form-control bg-transparent text-white me-2" 
                    name="fecha_evaluacion" value="{{ old('fecha_evaluacion') }}">

                <input type="text" id="buscarForm" class="form-control bg-transparent border-white text-white me-2" placeholder="Buscar por Código" 
                    name="buscarCodigo" value="{{ old('buscarCodigo') }}"> 

                <button class="btn btn-dark boton" type="submit">
                    <i class='bx bx-search-alt-2'></i>
                </button>
            </form>
        </div>
        <hr class="text-white mb-4">

        <!-- TABLA PARA MOSTRAR LAS EVALUACIONES DE LOS EMPLEADOS -->

        <table class="table table-bordered table-dark border-white text-center mt-2">
            <thead class="thead">
                <tr id="trFifo">
                    <th>Código</th>
                    <th>Fecha</th>
                    <th>Higiene</th>
                    <th>Vestimenta</th>
                    <th>Buen Trato al Cliente</th>
                    <th>Conocimiento de los Menús</th>
                    <th>Trabajo en Equipo</th>
                    <th>Calificación</th>
                    <th>Empleado</th>
                </tr>
            </thead>
            {{-- PARA MOSTRAR LA INFORMCION ITERAMOS CON UN BUCLE FOREACH --}}
            <tbody>
                @if ($bolean == TRUE)
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
                                <a href="{{route('evaluaciones.showEmp', $item->id_persona)}}"
                                    class="btn btn-warning mx-1 my-1" title="Detalles">
                                    <i class='bx bxs-user-detail'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
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
                                <a href="{{route('evaluaciones.showEmp', $item->id_persona)}}"
                                    class="btn btn-warning mx-1 my-1" title="Detalles">
                                    <i class='bx bxs-user-detail'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

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
