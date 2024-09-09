{{-- VISTA PROCESOS DESTACADOS --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Procesos Destacados') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <div class="w-100 text-center text-white">
            <h4>Procesos Destacados</h4>
        </div>
        
        <hr class="text-white">

        <div class="mb-4">
            <input type="text" id="buscar" class="form-control bg-transparent border-white text-white"
                placeholder="Busqueda Rápida por Código" name="buscarUnEmp">
        </div>
        <hr class="text-white">

        <!-- TABLA PARA MOSTRAR LA INFO DE LOS EMPLEADOS -->
        <table class="tabla mt-2">
            <thead class="thead">
                <tr id="trFifo">
                    <th>Código del Proceso</th>
                    <th>Promedio de Total de las Evaluaciones</th>
                    <th>Detalles del Proceso</th>
                </tr>
            </thead>
            {{-- PARA MOSTRAR LA INFORMCION ITERAMOS CON UN BUCLE FOREACH --}}
            <tbody>
                @foreach ($procesDestac as $item)
                    <tr class="tr">
                        <td class="tdCedulas">{{$item->codigo_proces}}</td>
                        <td class="tdNombres">{{number_format($item->promedio_proceso)}}%</td>
                        <td>
                            <a href="{{route('procesos.evaluacionFind', $item->id_proceso)}}"
                                class="btn btn-outline-warning mx-1 my-1" title="Detalles">
                                <i class='bx bx-cog'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
