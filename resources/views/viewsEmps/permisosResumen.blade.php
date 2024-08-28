{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Resumen Permisos') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- ALERTA CUANDO HAY UN REGISTRO EXITOSO --}}

        @if ($mensaje = Session::get('success'))

            <div class="alert alert-success text-center container w-50" role="alert">
                {{$mensaje}}
            </div>

        @endif

        {{-- ALERTA PARA ERRORES DE VALIDACION AL BUSCAR POR CODIGO--}}

        @error('buscarCodigo')
            <div class="alert alert-danger text-center container w-50">{{ $message }}</div>
        @enderror

        <div class="d-flex w-100 text-center text-white">
            @if ($bolean == FALSE)
                <div>
                    <a href="{{route('permisos.index')}}" class="btn btn-warning mx-1 my-1" title="Resumen Permisos">
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

        <div class="row mt-4 mb-2">
            <div class="col mt-3">
                <a class="btn btn-dark mb-3 boton" href="{{route("permisos.create")}}">Crear Permiso</a>
            </div>

            <div class="col mt-3">
                <form class="d-flex from-createEmp mb-3" id="formBusquedaCodigo" action="{{ route('permisos.buscarCodigo') }}" method="POST">
                    @csrf
                    <input type="text" id="buscarForm" class="form-control bg-transparent border-white text-white me-2"
                    placeholder="Buscar por Código" name="buscarCodigo" value="{{ old('buscarCodigo') }}">   
                    <button class="btn btn-dark boton" type="submit">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="mb-3 text-start text-white from-createEmp">
            <select class="form-select" id="asuntoSelect">
                <option value="">Todos los Permisos</option>
                @foreach ($permisos as $item)
                    <option value="{{$item->asunto_event}}">{{$item->asunto_event}}</option>
                @endforeach
            </select>

        </div>
        <hr class="text-white mb-4">
        
        {{-- MOSTRAR LA INFORMACIÓN CON LA CONDICIONAL DE UN BOLEANO --}}
        @if ($bolean == TRUE)
            <div id="eventCards">
                @foreach ($permisos as $item)
                    <div class="card w-100 my-3 bg-transparent border border-white text-white p-2" data-asunto="{{$item->asunto_event}}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="codigo card-title mb-2 text-warning">{{$item->codigo_event}}</h5>
                                    <h5>{{$item->asunto_event}}</h5>
                                </div>
                                <div class="mt-1">
                                    <h6 class="card-subtitle mb-2 "><b class="text-warning">Fecha de Inicio:</b>
                                        {{$item->fecha_inicioEvent->format("d/m/Y")}}
                                    </h6>
                                    <h6 class="card-subtitle mb-2"><b class="text-warning">Fecha de Culminación:</b>
                                        {{$item->fecha_finEvent->format("d/m/Y")}}
                                    </h6>
                                </div>
                            </div>
                            <hr class="text-white">
                            <p class="card-text">{{$item->descripcion_event}}</p>
                            <hr class="text-white">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="text-warning">Datos del Empleado Solicitante:</h5><br>
                                    <p>
                                        <b class="text-warning">Nombre y Apellido:</b> {{$item->Nombre_Apellido}}<br>
                                        <b class="text-warning">C.I:</b> {{$item->identificacion}}
                                    </p>
                                </div>
                                <div class="mt-1">
                                    <h6 class="card-subtitle mb-2 "><b class="text-warning">Fecha de Creación:</b>
                                        {{$item->fechaCreacion_event->format("d/m/Y")}}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> 
        @else
            <div class="card w-100 my-3 bg-transparent border border-white text-white p-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="codigo card-title mb-2 text-warning">{{$permisos->first()->codigo_event}}</h5>
                            <h5>{{$permisos->first()->asunto_event}}</h5>
                        </div>
                        <div class="mt-1">
                            <h6 class="card-subtitle mb-2 "><b class="text-warning">Fecha de Inicio:</b>
                                {{$permisos->first()->fecha_inicioEvent->format("Y-m-d")}}
                            </h6>
                            <h6 class="card-subtitle mb-2"><b class="text-warning">Fecha de Culminación:</b>
                                {{$permisos->first()->fecha_finEvent->format("Y-m-d")}}
                            </h6>
                        </div>
                    </div>
                    <hr class="text-white">

                    <p class="card-text">{{$permisos->first()->descripcion_event}}</p>
                    
                    <hr class="text-white">

                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-warning">Datos del Empleado Solicitante:</h5><br>
                            <p>
                                <b class="text-warning">Nombre y Apellido:</b> {{$permisos->first()->Nombre_Apellido}}<br>
                                <b class="text-warning">C.I:</b> {{$permisos->first()->identificacion}}
                            </p>
                        </div>
                        <div class="mt-1">
                            <h6 class="card-subtitle mb-2 "><b class="text-warning">Fecha de Creación:</b>
                                {{$permisos->first()->fechaCreacion_event->format("d/m/Y")}}
                            </h6>
                        </div>
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
