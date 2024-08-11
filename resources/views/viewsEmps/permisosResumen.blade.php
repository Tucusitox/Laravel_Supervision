{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Resumen Empleados') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- ALERTA CUANDO HAY UN REGISTRO EXITOSO --}}

        @if ($mensaje = Session::get('success'))

            <div class="alert alert-success text-center container w-50" role="alert">
                {{$mensaje}}
            </div>

        @endif

        {{-- ALERTA SI EL EMPLEADO NO EXISTE --}}

        @error('empNoExiste')
            <div class="alert alert-danger text-center container w-50">{{ $message }}</div>
        @enderror

        <div class="w-100 text-center text-white">
            <h4>Resumen de los Permisos de los Empleados</h4>
        </div>
        
        <hr class="text-white">

        <div class="w-100 my-3">
            <a class="btn btn-dark mb-3 boton" href="{{route("eventualidades.create")}}">Crear Permiso</a>
            <input type="text" id="buscar" class="form-control bg-transparent border-white text-white me-2"
                   placeholder="Busqueda Rápida por Nombre o Apellido" name="buscarUnEmp">
        </div>

        @foreach ($permisos as $item)
            <div class="card w-100 my-3 bg-transparent border border-white text-white p-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title mb-2 text-warning">{{$item->codigo_event}}</h5>
                            <h6 class="card-subtitle mb-2 ">{{$item->asunto_event}}</h6>
                        </div>
                        <div class="mt-1">
                            <h6 class="card-subtitle mb-2 "><b class="text-warning">Fecha de Inicio:</b>
                                {{$item->fecha_inicioEvent->format("Y-m-d")}}
                            </h6>
                            <h6 class="card-subtitle mb-2"><b class="text-warning">Fecha de Culminación:</b>
                                {{$item->fecha_finEvent->format("Y-m-d")}}
                            </h6>
                        </div>
                    </div>
                    <hr class="text-white">

                    <p class="card-text">{{$item->descripcion_event}}</p>
                    
                    <hr class="text-white">

                    <div class="w-100">
                        <h5 class="text-warning">Datos del Empleado Solicitante:</h5>
                        <b>{{$item->Nombre_Apellido}}</b><br>
                        <b>C.I: {{$item->identificacion}}</b>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
