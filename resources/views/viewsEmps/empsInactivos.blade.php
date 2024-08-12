{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Empleados Inactivos') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <div class="w-100 text-center text-white">
            <h4>Empleados Inactivos</h4>
        </div>
        
        <hr class="text-white">

        <div class="row mt-4 mb-4">
            <div class="col">
                <input type="text" id="buscar" class="form-control bg-transparent border-white text-white me-2"
                    placeholder="Busqueda Rápida por Cédula" name="buscarUnEmp">
            </div>
        </div>

        <!-- TABLA PARA MOSTRAR LA INFO DE LOS EMPLEADOS -->

        <table class="table mt-2 table-bordered table-dark border-white text-center">
            <thead class="thead">
                <tr id="trFifo">
                    <th>Cedúla</th>
                    <th>Nombres y Apellido</th>
                    <th>Estado Laboral</th>
                    <th>Cambiar Estatus</th>
                </tr>
            </thead>
            <!-- PARA MOSTRAR LA INFORMCION ITERAMOS CON UN BUCLE FOREACH -->
            <tbody>
                @foreach ($empInactivo as $item)

                    <tr>
                        <td class="tdCedulas">{{$item->identificacion}}</td>
                        <td class="tdNombres">{{$item->Nombre_Apellido}}</td>
                        <td>{{$item->estado_laboral}}</td>
                        <td>
                            <a  href="{{route('empleado.activo', $item->id_persona)}}"
                                class="btn btn-primary mx-1 my-1" title="Cambiar Estatus">
                                <i class='bx bxs-user-plus' ></i>
                            </a>

                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    </div>

@endsection
