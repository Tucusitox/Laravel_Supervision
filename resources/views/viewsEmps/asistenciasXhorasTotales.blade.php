{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Asistencias de Empleados') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}


    <div class="caja3 container p-5" id="contenedor">

        {{-- ALERTA CUANDO HAY UN REGISTRO EXITOSO --}}

        @if ($mensaje = Session::get('success'))

            <div class="alert alert-success text-center container w-50" role="alert">
                {{$mensaje}}
            </div>

        @endif

        {{-- ALERTA PARA ERRORES DE VALIDACION --}}
        @if ($errors->any())
            <div class="alert alert-danger text-center container w-75">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="w-100 text-white text-center">
            <h4>Horas Totales</h4>
        </div>

        <hr class="text-white">

        <div class="d-flex flex-column"> 
            <div class="col">
                <a class="btn btn-dark mb-3 boton" data-bs-toggle="modal" data-bs-target="#exampleModal_4">Calcular Horas Totales de un Empleado</a>
            </div>

            <div class="col">
                <form class="d-flex from-createEmp mb-3" action="{{route("asistencias.fecha")}}" method="POST">
                    @csrf
                    <input type="date" class="form-control bg-transparent text-white me-2" 
                    name="fecha_asistencia" value="{{ old('fecha_asistencia') }}">
                        
                    <button class="btn btn-dark boton" type="submit">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- TABLA PARA MOSTRAR LA INFO DE LOS EMPLEADOS -->

        <table class="table table-bordered table-dark border-white text-center mt-2">
            <thead class="thead">
                <tr id="trFifo">
                    <th>Fechas</th>
                    <th>Cedúla</th>
                    <th>Nombres y Apellido</th>
                    <th>Horas Totales Trabajadas</th>
                </tr>
            </thead>
            <!-- PARA MOSTRAR LA INFORMCION ITERAMOS CON UN BUCLE FOREACH -->
            <tbody>
                <tr> 
                    <td>{{ $fechaN1." / ".$fechaN2 }}</td>
                    <td>{{ $infoEmpleado->first()->identificacion }}</td>
                    <td>{{ $infoEmpleado->first()->Nombre_Apellido }}</td>
                    <td>{{ $horasTotales->first()->Horas_Totales }}</td>
                </tr>
            </tbody>
        </table>

    </div>

    {{-- FORMULARIO PARA BUSCAR LAS ASISTENCIAS DE LOS EMPLEADOS ENTRE DOS FECHAS --}}
    <x-FormAsisHorasTotales/>

@endsection
