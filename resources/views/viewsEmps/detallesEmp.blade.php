{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Detalles de un Empleado') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- VER LA INFORMACION DEL EMPLEADO --}}
        <div class="tabs">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-center">
                    <h4 class="active">{{$detallEmp->first()->nombre." ".$detallEmp->first()->apellido}}</h4> 
                    <h4>Permisos</h4>
                    <h4>Evaluaciones</h4>
                </div>
    
                {{-- BOTONES DE EDIT Y DELETE --}} 
                <div class="text-center">
                    @if ($bolean === TRUE)
                        <a href="{{route('emp.viewEmp')}}" class="btn btn-outline-warning mx-1 my-1" title="Volver">
                            <i class='bx bx-arrow-back'></i>
                        </a> 
                    @elseif($bolean === FALSE)
                        <a href="{{route('evaluaciones.index')}}" class="btn btn-outline-warning mx-1 my-1" title="Volver">
                            <i class='bx bx-arrow-back'></i>
                        </a> 
                    @elseif($bolean === "destacado")
                        <a href="{{route('evaluaciones.empsDest')}}" class="btn btn-outline-warning mx-1 my-1" title="Volver">
                            <i class='bx bx-arrow-back'></i>
                        </a> 
                    @elseif($bolean === "permiso")
                        <a href="{{route('permisos.index')}}" class="btn btn-outline-warning mx-1 my-1" title="Volver">
                            <i class='bx bx-arrow-back'></i>
                        </a> 
                    @elseif($bolean === "inactivo")
                        <a href="{{route('emps.inactivos')}}" class="btn btn-outline-warning mx-1 my-1" title="Volver">
                            <i class='bx bx-arrow-back'></i>
                        </a> 
                    @endif
                    <a href="{{route('permisos.show', $detallEmp->first()->id_persona)}}" class="btn btn-outline-success mx-1 my-1" title="Crear un Permiso">
                        <i class='bx bx-notepad' ></i>
                    </a>
                    <a href="{{route('evaluaciones.show', $detallEmp->first()->id_persona)}}" class="btn btn-outline-primary mx-1 my-1" title="Crear una Evaluación">
                        <i class='bx bxs-user-check'></i>
                    </a>
                    <a href="{{route('empleado.edit', $detallEmp->first()->id_persona)}}" class="btn btn-outline-info mx-1 my-1" title="Editar">
                        <i class='bx bx-edit'></i>
                    </a>
                    <a href="{{route('empleado.delete2', $detallEmp->first()->id_persona)}}" class="btn btn-outline-danger mx-1" title="Eliminar">
                        <i class='bx bx-trash'></i>
                    </a>
                </div>
            </div>
          </div>
          <hr class="text-white">
    
          <div class="tab-content">

            <article class="active">

                <div class="d-flex container">
                    <div class="mt-4 mx-5">
                        <img src="{{ asset($detallEmp->first()->foto) }}" 
                        style="max-width: 350px; max-height: 300px; border-radius: 10px; border: 1px solid #ffc107;;" id="img"/>
                    </div>
                    <div class="text-white border-end mt-3 px-1 w-50">
                        <p><b>Cédula:</b><b class="text-warning">{{" ".$detallEmp->first()->identificacion}}</b></p>
                        <p><b>Tipo de Cédula:</b><b class="text-warning">{{" ".$detallEmp->first()->tipo_identificacion}}</b></p>
                        <p><b>Fecha de Nacimiento:</b><b class="text-warning">{{" ".$detallEmp->first()->fecha_nacimiento->format('Y-m-d')}}</b></p>
                        <p><b>Edad:</b><b class="text-warning">{{" ".$detallEmp->first()->edad_empleado}}</b></p>
                        <p><b>Género:</b><b class="text-warning">{{" ".$detallEmp->first()->nombre_genero}}</b></p>
                        <p><b>Cargo:</b><b class="text-warning">{{" ".$detallEmp->first()->nombre_car}}</b></p>
                        <p><b>Espacio Asignado:</b><b class="text-warning">{{" ".$detallEmp->first()->nombre_espacio}}</b></p>
                        <p><b>Tipo de Empleado:</b><b class="text-warning">{{" ".$detallEmp->first()->tipo_empleado}}</b></p>
                    </div>
                    <div class="text-white mt-3 mx-4 w-50">
                        <p><b>Horario del Empleado:</b> <b class="text-warning">{{$detallEmp->first()->nombre_horario." ".$detallEmp->first()->descripcion_horario}}</b></p>
                        <p><b>Teléfono Celular:</b><b class="text-warning">{{" ".$detallEmp->first()->tlf_celular}}</b></p>
                        <p><b>Teléfono Local:</b> <b class="text-warning">{{" ".$detallEmp->first()->tlf_local}}</b></p>
                        <p><b>Dirección:</b><b class="text-warning">{{" ".$detallEmp->first()->direccion}}</b></p>
                        <p><b>Fecha de Ingreso:</b><b class="text-warning">{{" ".$detallEmp->first()->fecha_ingreso}}</b></p>
                        <p><b>Fecha de Egreso:</b>
                            @if(!$detallEmp->first()->fecha_egreso)
                                <b class="text-warning">No Definida</b>
                            @else
                                <b class="text-warning">{{ $detallEmp->first()->fecha_egreso }}</b>
                            @endif
                        </p>
                        <p><b>Estado Laboral:</b><b class="text-warning">{{" ".$detallEmp->first()->estado_laboral}}</b></p>
                    </div>
                </div>

            </article>
    
            {{-- MOSTRAR LOS PERMISOS DEL EMPLEADO --}}
            <article>
                @if ($permisosEmp->isNotEmpty())
                    @foreach ($permisosEmp as $item)
                        <div class="card bg-transparent text-white border my-4 py-2">
                            <div class="card-header border-bottom d-flex justify-content-between">
                                <h5>Código de Permiso: <b class="text-warning">{{$item->codigo_event}}</b></h5>
                                <h5 class="card-title">Fecha de Creación: <b class="text-warning">{{$item->fechaCreacion_event->format("d/m/Y")}}</b></h5>
                            </div>
                            <div class="card-body border-bottom">
                                <h5 class="card-title text-warning">{{$item->asunto_event}}</h5>
                                <p class="card-text">
                                    {{$item->descripcion_event}}
                                </p>
                            </div>
                            <div class="card-footer">
                                <h6 class="card-title">Fecha de Incio del Permiso: <b class="text-warning">{{$item->fecha_inicioEvent->format("d/m/Y")}}</b></h6>
                                <h6 class="card-title">Fecha de Culminación del Permiso: <b class="text-warning">{{$item->fecha_inicioEvent->format("d/m/Y")}}</b></h6>
                            </div>
                        </div>
                    @endforeach 
                @else
                    <div class="container text-warning text-center">
                        <h3>¡Este Empleado no ha Solicitado Permisos!</h3>
                    </div>
                @endif
            </article>
    
            {{-- MOSTRAR LAS EVALUACIONES DEL EMPELADO Y SUS NOTAS --}}
            <article>
                @if ($notasEmp->isNotEmpty())
                    <table class="tabla my-3">
                        <thead class="text-warning">
                            <tr>
                                <th>Código</th>
                                <th>Fecha</th>
                                <th>Higiene</th>
                                <th>Vestimenta</th>
                                <th>Buen Trato al Cliente</th>
                                <th>Conocimiento de Menús</th>
                                <th>Trabajo en Equipo</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notasEmp as $item)
                                <tr>
                                    <td>{{$item->codigo_eval}}</td>
                                    <td>{{$item->fecha_evaluacion}}</td>
                                    <td>{{$item->nota1}}</td>
                                    <td>{{$item->nota2}}</td>
                                    <td>{{$item->nota3}}</td>
                                    <td>{{$item->nota4}}</td>
                                    <td>{{$item->nota5}}</td>
                                    <td>{{$item->suma_notas}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="container text-warning text-center">
                        <h3>¡Este Empleado no tiene Evaluaciones!</h3>
                    </div>
                @endif
            </article>
        </div>

        <hr class="text-white">
    </div>

    {{-- ANIMACION DE LA TAB --}}
    <script>
        let tabs = document.querySelectorAll(".tabs h4");
        let tabContents = document.querySelectorAll(".tab-content article");

        tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            tabContents.forEach((content) => {
            content.classList.remove("active");
            });
            tabs.forEach((tab) => {
            tab.classList.remove("active");
            });
            tabContents[index].classList.add("active");
            tabs[index].classList.add("active");
        });
        });
    </script>

    {{-- ESTILOS DE LAS TABS --}}
    <style>
        h4 {
            margin-right: 10px;
            padding: 5px;
            color: rgb(133, 131, 131);
            cursor: pointer;
        }
        h4:hover {
            color: #c8a53e;
        }
    </style>

@endsection
