{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Detalles de un Empleado') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- ALERTA CUANDO HAY UNA ACTUALIZACION EXITOSA --}}

        @if ($mensaje = Session::get('success'))
            <div class="alert alert-success text-center container w-50" role="alert">
            {{$mensaje}}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center container">
            <h4 class="text-white">{{$detallEmp->first()->nombre." ".$detallEmp->first()->apellido}}</h4>

            {{-- BOTONES DE EDIT Y DELETE --}} 
            <div class="text-center">
                <a href="{{route('emp.viewEmp')}}" class="btn btn-warning mx-1 my-1" title="Volver">
                    <i class='bx bx-arrow-back'></i>
                </a>
                <a href="{{route('permisos.show', $detallEmp->first()->id_persona)}}" class="btn btn-success mx-1 my-1" title="Crear un Permiso">
                    <i class='bx bx-notepad' ></i>
                </a>
                <a href="{{route('empleado.edit', $detallEmp->first()->id_persona)}}" class="btn btn-info mx-1 my-1" title="Editar">
                    <i class='bx bx-edit'></i>
                </a>
                <a href="{{route('empleado.delete2', $detallEmp->first()->id_persona)}}" class="btn btn-danger mx-1" title="Eliminar">
                    <i class='bx bx-trash'></i>
                </a>
            </div>
        </div>
        <hr class="text-white">

        <div class="d-flex container">
            <div class="mt-4 mx-5">
                <img src="{{ asset($detallEmp->first()->foto) }}" 
                style="max-width: 350px; max-height: 300px; border-radius: 10px; border: 3px solid #ffff;" id="img"/>
            </div>
            <div class="detalleEmp border-end mt-3 px-1 w-50">
                <p><b>Cédula:</b>{{" ".$detallEmp->first()->identificacion}}</p>
                <p><b>Tipo de Cédula:</b>{{" ".$detallEmp->first()->tipo_identificacion}}</p>
                <p><b>Fecha de Nacimiento:</b>{{" ".$detallEmp->first()->fecha_nacimiento->format('Y-m-d')}}</p>
                <p><b>Edad:</b>{{" ".$detallEmp->first()->edad_empleado}}</p>
                <p><b>Género:</b>{{" ".$detallEmp->first()->nombre_genero}}</p>
                <p><b>Cargo:</b>{{" ".$detallEmp->first()->nombre_car}}</p>
                <p><b>Espacio Asignado:</b>{{" ".$detallEmp->first()->nombre_espacio}}</p>
                <p><b>Tipo de Empleado:</b>{{" ".$detallEmp->first()->tipo_empleado}}</p>
            </div>
            <div class="detalleEmp mt-3 mx-4 w-50">
                <p><b>Horario del Empleado:</b>{{" ".$detallEmp->first()->nombre_horario." "."(".$detallEmp->first()->descripcion_horario.")"}}</p>
                <p><b>Teléfono Celular:</b>{{" ".$detallEmp->first()->tlf_celular}}</p>
                <p><b>Teléfono Local:</b>{{" ".$detallEmp->first()->tlf_local}}</p>
                <p><b>Dirección:</b>{{" ".$detallEmp->first()->direccion}}</p>
                <p><b>Fecha de Ingreso:</b>{{" ".$detallEmp->first()->fecha_ingreso}}</p>
                <p><b>Fecha de Egreso:</b>
                    @if(!$detallEmp->first()->fecha_egreso)
                        No Definida
                    @else
                        {{ $detallEmp->first()->fecha_egreso }}
                    @endif
                </p>
                <p><b>Estado Laboral:</b>{{" ".$detallEmp->first()->estado_laboral}}</p>
            </div>
        </div>
        <hr class="text-white">
    </div>

@endsection
