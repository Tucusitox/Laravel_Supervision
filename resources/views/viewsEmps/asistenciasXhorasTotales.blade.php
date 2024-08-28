{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Horas Totales Trabajadas') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


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

        <div class="d-flex w-100 text-white text-center">
            <div>
                <a href="{{route('asistencias.index')}}" class="btn btn-warning mx-1 my-1" title="Resumen Asistencias">
                    <i class='bx bx-arrow-back'></i>
                </a>
            </div>

            <div class="flex-grow-1">
                <h4>Horas Totales del Empleado:
                    <b class="text-warning">{{$infoEmpleado->first()->Nombre_Apellido}}</b>
                </h4>
            </div>
        </div>

        <hr class="text-white">

        <!-- TABLA PARA MOSTRAR LA INFO DE LOS EMPLEADOS -->

        <table class="table table-bordered table-dark border-white text-center mt-4">
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

@endsection
