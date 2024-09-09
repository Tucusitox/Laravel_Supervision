{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Resumen Permisos') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">
        <div class="d-flex w-100 text-center text-white">
            @if ($bolean == FALSE)
                <div>
                    <a href="{{route('permisos.index')}}" class="btn btn-outline-warning mx-1 my-1" title="Resumen Permisos">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
                <div class="flex-grow-1">
                    <h4>¡Permiso Encontrado con Éxito!</h4>
                </div>
            @else
                <div class="flex-grow-1">
                    <h4>Resumen de los Permisos de los Empleados</h4>
                </div>
            @endif
        </div>
        <hr class="text-white">

        @if ($bolean !== FALSE)
            <div class="d-flex justify-content-between my-4">
                <a class="btn btn-outline-warning me-3" href="{{route("permisos.create")}}">Crear Permiso</a>

                <form class="d-flex from-createEmp flex-grow-1" id="formBusquedaCodigo" action="{{ route('permisos.buscarCodigo') }}" method="POST">
                    @csrf
                    <input type="text" id="buscarForm" class="form-control bg-transparent border-white text-white me-2"
                    placeholder="Buscar por Código" name="buscarCodigo" value="{{ old('buscarCodigo') }}">   
                    <button class="btn btn-outline-warning" type="submit">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </form>
            </div>
        @endif

        @if ($bolean !== FALSE)
            {{-- BUSCADOR POR TIPO DE PERMISO --}}
            <div class="mb-3 text-start text-white">
                <select class="form-select text-white bg-black" id="asuntoSelect">
                    <option value="">Todos los Permisos</option>
                    @foreach ($permisos as $item)
                        <option value="{{$item->asunto_event}}">{{$item->asunto_event}}</option>
                    @endforeach
                </select>
            </div>
            <hr class="text-white mb-4">
        @endif
        
        {{-- MOSTRAR LA INFORMACIÓN CON LA CONDICIONAL DE UN BOLEANO --}}
        @if ($bolean == TRUE)
            <div id="eventCards">
                @foreach ($permisos as $item)
                    <div class="card bg-transparent text-white border my-3 py-2"  data-asunto="{{$item->asunto_event}}">
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
                        <div class="d-flex justify-content-between align-items-center card-body border-bottom py-2">
                            <div class="text-start">
                                <h5 class="text-warning">Datos del Empleado Solicitante:</h5>
                                <h6 class="card-title">Nombre y Apellido: <b class="text-warning">{{$item->Nombre_Apellido}}</b></h6>
                                <h6 class="card-title">C.I: <b class="text-warning">{{$item->identificacion}}</b></h6>
                            </div>
                            <div class="text-center">
                                <h5 class="text-warning">Empleado</h5>
                                <a href="{{route('permisos.permisoEmp',$permisos->first()->id_persona)}}"
                                    class="btn btn-outline-warning" title="Detalles">
                                    <i class='bx bxs-user-detail'></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div class="card-footer">
                                <h6 class="card-title">Fecha de Incio del Permiso: <b class="text-warning">{{$item->fecha_inicioEvent->format("d/m/Y")}}</b></h6>
                                <h6 class="card-title">Fecha de Culminación del Permiso: <b class="text-warning">{{$item->fecha_inicioEvent->format("d/m/Y")}}</b></h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> 
        @else
            <div class="card bg-transparent text-white border my-3 py-2">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h5>Código de Permiso: <b class="text-warning">{{$permisos->first()->codigo_event}}</b></h5>
                    <h5 class="card-title">Fecha de Creación: <b class="text-warning">{{$permisos->first()->fechaCreacion_event->format("d/m/Y")}}</b></h5>
                </div>
                <div class="card-body border-bottom">
                    <h5 class="card-title text-warning">{{$permisos->first()->asunto_event}}</h5>
                    <p class="card-text">
                        {{$permisos->first()->descripcion_event}}
                    </p>
                </div>
                <div class="d-flex justify-content-between align-items-center card-body border-bottom py-2">
                    <div class="text-start">
                        <h5 class="text-warning">Datos del Empleado Solicitante:</h5>
                        <h6 class="card-title">Nombre y Apellido: <b class="text-warning">{{$permisos->first()->Nombre_Apellido}}</b></h6>
                        <h6 class="card-title">C.I: <b class="text-warning">{{$permisos->first()->identificacion}}</b></h6>
                    </div>
                    <div class="text-center">
                        <h5 class="text-warning">Empleado</h5>
                        <a href="{{route('permisos.permisoEmp',$permisos->first()->id_persona)}}"
                            class="btn btn-outline-warning" title="Detalles">
                            <i class='bx bxs-user-detail'></i>
                        </a>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div class="card-footer">
                        <h6 class="card-title">Fecha de Incio del Permiso: <b class="text-warning">{{$permisos->first()->fecha_inicioEvent->format("d/m/Y")}}</b></h6>
                        <h6 class="card-title">Fecha de Culminación del Permiso: <b class="text-warning">{{$permisos->first()->fecha_inicioEvent->format("d/m/Y")}}</b></h6>
                    </div>
                </div>
            </div>
        @endif

    </div>

    {{-- SCRIPTS URILIZADOS EN ESTA VISTA --}}
    <script>
        // PREVENIR EL ENVIO DEl FORMULARIO DE BUSQUEDA
        const formBusquedaCodigo = document.getElementById("formBusquedaCodigo");

        formBusquedaCodigo.addEventListener("submit", (e) => {
            const codigoInput = formBusquedaCodigo.querySelector('input[name="buscarCodigo"]');
            
            if (!codigoInput.value) {
                e.preventDefault(); 
                alertify.error('¡Ingresa un Código para poder Buscar!');
            } else {
                console.log("Formulario de código enviado");
            }
        });

        // BUSCAR PERMISO POR ASUNTO
        const permisos = document.getElementById('asuntoSelect');
        permisos.addEventListener('change', function() {
            const selectedValue = this.value;
            const cards = document.querySelectorAll('#eventCards .card');

            if(selectedValue){
                cards.forEach(card => {
                    if (card.getAttribute('data-asunto') === selectedValue) {
                        card.classList.remove('d-none');
                        card.classList.add('d-block');
                    } else {
                        card.classList.remove('d-block');
                        card.classList.add('d-none');
                    }
                });
            }else{
                cards.forEach(card => {
                    if (card.getAttribute('data-asunto') === selectedValue) {
                        card.classList.remove('d-block');
                        card.classList.add('d-none');
                    } else {
                        card.classList.remove('d-none');
                        card.classList.add('d-block');
                    }
                });
            }
        });
    </script>

@endsection
