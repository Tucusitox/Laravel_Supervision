{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Asistencias de Empleados') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}


    <div class="caja3 container p-5" id="contenedor">
        
        <div class="d-flex w-100 text-center text-white">
            @if ($bolean == FALSE)
                <div>
                    <a href="{{route('asistencias.index')}}" class="btn btn-outline-warning mx-1 my-1" title="Resumen Asistencias">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
                <div class="flex-grow-1">
                    <h4>Asistencias de Empleados en la Fecha: 
                        <b class="text-warning">{{$fechaAsis->first()->fecha_asistencia->format('d/m/y')}}</b>
                    </h4>
                </div>
            @else
                <div class="flex-grow-1">
                    <h4>Asistencias de Empleados</h4>
                </div>
            @endif
        </div>
        <hr class="text-white">

        <div class="d-flex flex-column mb-3"> 
            @if ($bolean == TRUE)
                <div class="col">
                    <a class="btn btn-outline-warning mb-3 boton" data-bs-toggle="modal" data-bs-target="#exampleModal_3">Crear Asistencia</a>
                    <a class="btn btn-outline-warning mb-3 boton mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal_4">Calcular Horas Totales de un Empleado</a>
                </div>
            @endif

            <div class="col">
                @if ($bolean !== FALSE)
                    <form class="d-flex from-createEmp" id="formBusquedaFecha" action="{{route("asistencias.fecha")}}" method="POST">
                        @csrf
                        <input type="date" class="form-control bg-transparent text-white me-2" 
                        name="fecha_asistencia" value="{{ old('fecha_asistencia') }}">   
                        <button class="btn btn-outline-warning boton" type="submit">
                            <i class='bx bx-search-alt-2'></i>
                        </button>
                    </form>
                @endif
                @if ($bolean == FALSE)
                    <input type="text" id="buscar" class="form-control bg-transparent border-white text-white"
                    placeholder="Busqueda Rápida por Cédula" name="buscarUnEmp">
                @endif
            </div>
        </div>
        <hr class="text-white">

        <!-- TABLA PARA MOSTRAR LA INFO DE LOS EMPLEADOS -->

        <table class="tabla mt-2">
            <thead class="thead">
                <tr id="trFifo">
                    <th>Fecha</th>
                    <th>Cedúla</th>
                    <th>Nombres y Apellido</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Horas del Día</th>
                </tr>
            </thead>
            <!-- PARA MOSTRAR LA INFORMCION ITERAMOS CON UN BUCLE FOREACH -->
            <tbody>
                @if ($bolean == TRUE)
                    @foreach ($empAsis as $item)
                        <tr>
                            <td>{{ $item->fecha_asistencia->format('d/m/y') }}</td>
                            <td class="tdCedulas">{{$item->identificacion }}</td>
                            <td class="tdNombres">{{$item->Nombre_Apellido }}</td>
                            <td>{{ $item->hora_llegada->format('h:i A') }}</td>
                            <td>
                                @if(!$item->hora_salida)
                                    Por Definir
                                @else
                                    {{ $item->hora_salida->format('h:i A') }}
                                @endif
                            </td>
                            <td>
                                @if(!$item->HorasTotales_Dia)
                                    Por Definir
                                @else
                                    {{ $item->HorasTotales_Dia }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($fechaAsis as $item)
                        <tr>
                            <td>{{$item->fecha_asistencia->format('d/m/y')}}</td>
                            <td class="tdCedulas">{{$item->identificacion}}</td>
                            <td class="tdNombres">{{$item->Nombre_Apellido}}</td>
                            <td>{{$item->hora_llegada->format('h:i A')}}</td>
                            <td>
                                @if(!$item->hora_salida)
                                    Por Definir
                                @else
                                    {{$item->hora_salida->format('h:i A')}}
                                @endif
                            </td>
                            <td>
                                @if(!$item->HorasTotales_Dia)
                                    Por Definir
                                @else
                                    {{ $item->HorasTotales_Dia }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>

    </div>

    {{-- FORMULARIO PARA REGISTRAR LA ASISTENCIA DE LOS EMPLEADOS --}}
    <x-FormAsistenciaEmp/>

    {{-- FORMULARIO PARA BUSCAR LAS ASISTENCIAS DE LOS EMPLEADOS ENTRE DOS FECHAS --}}
    <x-FormAsisHorasTotales/>

    {{-- PREVENIR EL ENVIO DEl FORMULARIO DE BUSQUEDA --}}
    <script>
        const formBusquedaFecha = document.getElementById("formBusquedaFecha");

        formBusquedaFecha.addEventListener("submit", (e) => {
            const fechaInput = formBusquedaFecha.querySelector('input[name="fecha_asistencia"]');
            
            if (!fechaInput.value) {
                e.preventDefault(); 
                alertify.error('¡Ingresa una Fecha para poder Buscar!');
            } else {
                console.log("Formulario de fecha enviado");
            }
        });
    </script>

@endsection