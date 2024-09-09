{{-- VISTA RESUMEN EMPLEADOS --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Resumen Empleados') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <div class="w-100 text-center text-white">
            <h4>Resumen de Empleados</h4>
        </div>
        
        <hr class="text-white">

        <div class="d-flex justify-content-between my-4">
            <a class="btn btn-outline-warning me-3" href="{{route("crearEmp.index")}}">Crear Empleado</a>

            <form class="d-flex from-createEmp flex-grow-1" action="{{ route('unEmp.findUnEmp') }}" method="POST">
                @csrf
                <input type="text" id="buscarForm" class="form-control bg-transparent border-white text-white me-2"
                    placeholder="Buscar por Cédula" name="buscarUnEmp">
                <button class="btn btn-outline-warning" type="submit">
                    <i class='bx bx-search-alt-2'></i>
                </button>

            </form>
        </div>
        <div class="mb-4">
            <input type="text" id="buscar" class="form-control bg-transparent border-white text-white"
                placeholder="Busqueda Rápida por Nombre o Apellido" name="buscarUnEmp">
        </div>
        <hr class="text-white">

        <!-- TABLA PARA MOSTRAR LA INFO DE LOS EMPLEADOS -->
        <table class="tabla mt-2">
            <thead class="thead">
                <tr id="trFifo">
                    <th>Cedúla</th>
                    <th>Nombres y Apellido</th>
                    <th>Cargo</th>
                    <th>Espacio Asignado</th>
                    <th>Estado Laboral</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            {{-- PARA MOSTRAR LA INFORMCION ITERAMOS CON UN BUCLE FOREACH --}}
            <tbody>
                @foreach ($datos as $item)
                    <tr class="tr">
                        <td class="tdCedulas">{{$item->identificacion}}</td>
                        <td class="tdNombres">{{$item->Nombre_Apellido}}</td>
                        <td>{{$item->nombre_car}}</td>
                        <td>{{$item->nombre_espacio}}</td>
                        <td>{{$item->estado_laboral}}</td>
                        <td>
                            <a href="{{route('empleado.show', $item->id_persona)}}"
                                class="btn btn-outline-warning mx-1 my-1" title="Detalles">
                                <i class='bx bxs-user-detail'></i>
                            </a>
                            <a href="{{route('empleado.editDesdeResum', $item->id_persona)}}" 
                                class="btn btn-outline-info mx-1 my-1" title="Editar">
                                <i class='bx bx-edit'></i>
                            </a>
                            <a href="{{route('empleado.delete1', $item->id_persona)}}" 
                                class="btn btn-outline-danger mx-1" title="Eliminar">
                                <i class='bx bx-trash'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
