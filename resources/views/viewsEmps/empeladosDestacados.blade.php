{{-- VISTA EMPLEADOS DESTACADOS --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Empleados Destacados') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- ALERTA CUANDO HAY UN REGISTRO EXITOSO --}}
        @if ($mensaje = Session::get('success'))
            <div class="alert alert-success text-center container w-50" role="alert">
                {{$mensaje}}
            </div>
        @endif

        {{-- ALERTA SI EL USUARIO NO LLENA EL CAMPO DEL INPUT DE BUSQUEDA --}}
        @error('buscarUnEmp')
            <div class="alert alert-danger text-center container w-50">{{ $message }}</div>
        @enderror

        <div class="w-100 text-center text-white">
            <h4>Empleados Destacados</h4>
        </div>
        
        <hr class="text-white">

        <div class="mb-4">
            <input type="text" id="buscar" class="form-control bg-transparent border-white text-white"
                placeholder="Busqueda Rápida por Cédula" name="buscarUnEmp">
        </div>
        <hr class="text-white">

        <!-- TABLA PARA MOSTRAR LA INFO DE LOS EMPLEADOS -->
        <table class="table table-bordered table-dark border-white text-center mt-2">
            <thead class="thead">
                <tr id="trFifo">
                    <th>Cedúla</th>
                    <th>Nombres y Apellido</th>
                    <th>Promedio de Total de las Evaluaciones</th>
                    <th>Detalles del Empleado</th>
                </tr>
            </thead>
            {{-- PARA MOSTRAR LA INFORMCION ITERAMOS CON UN BUCLE FOREACH --}}
            <tbody>
                @foreach ($empsDestac as $item)
                    <tr class="tr">
                        <td class="tdCedulas">{{$item->identificacion}}</td>
                        <td class="tdNombres">{{$item->Nombre_Apellido}}</td>
                        <td>{{number_format($item->promedio_empleado)}}%</td>
                        <td>
                            <a href="{{route('empleado.show', $item->id_persona)}}"
                                class="btn btn-warning mx-1 my-1" title="Detalles">
                                <i class='bx bxs-user-detail'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
