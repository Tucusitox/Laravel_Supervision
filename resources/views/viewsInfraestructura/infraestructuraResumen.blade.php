{{-- VISTA RESUMEN DE INFRAESTRUCTURA --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Resumen Infraestructura') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <div class="d-flex w-100 text-center text-white">
            @if ($bolean === FALSE)
                <div>
                    <a href="{{route('infraestructura.index')}}" class="btn btn-outline-warning mx-1 my-1" title="Resumen Equipos">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
                <div class="flex-grow-1">
                    <h4>¡Equipo Encontrado con Éxito!</h4>
                </div>
            @elseif ($bolean === "mantenimiento")
                <div>
                    <a href="{{route('mantenimientos.index')}}" class="btn btn-outline-warning mx-1 my-1" title="Resumen Mantenimientos">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
                <div class="flex-grow-1">
                    <h4>¡Equipo Encontrado con Éxito!</h4>
                </div>
            @else
                <div class="flex-grow-1">
                    <h4>Resumen de Equipos</h4>
                </div>
            @endif
        </div>
        <hr class="text-white">

        @if ($bolean !== FALSE && $bolean !== "mantenimiento")
            <div class="d-flex align-items-center my-4">
                <a class="btn btn-outline-warning me-3" href="{{route("infraestructura.create")}}">Registrar Equipo</a>
                {{-- BUSCADOR POR TIPO DE EQUIPO--}}
                <form class="d-flex from-createEmp flex-grow-1" id="formBusquedaTipo" action="{{ route('infraestructura.show') }}" method="POST">
                    @csrf
                    <select class="form-select text-white bg-black me-2" name="tipo_elemento">
                        <option value="Busca por Tipo de Elemento" {{ old('tipo_elemento') == 'Busca por Tipo de Elemento' ? 'selected' : '' }}>Busca por Tipo de Elemento</option>
                        @foreach ($tipoElement as $item)
                            <option value="{{ Str::snake($item->tipo_elemento) }}" {{old('tipo_elemento') == Str::snake($item->tipo_elemento) ? 'selected' : ''}}>{{ $item->tipo_elemento }}</option>         
                        @endforeach
                    </select>
                    <button class="btn btn-outline-warning" type="submit">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </form>
            </div>
            <hr class="text-white">
        @endif

        {{-- MOSTRAR LA INFORMACION EN CARDS ITERANDOLAS CON UN FOREACH --}}
        <div class="d-flex flex-wrap justify-content-center mt-4">
            @foreach ($elementosInfras as $item)
                <div class="card bg-transparent text-white border mb-3 me-3" style="width: 500px;">
                    <div class="card-header border-bottom">
                        <h6><b class="text-warning">Tipo de Equipo:</b> {{$item->tipo_elemento}}</h6>
                    </div>
                    <div class="card-body border-bottom">
                        <h5 class="card-title text-warning">{{$item->nombre_element}}</h5>
                        <p class="card-text">
                            {{$item->descripcion_element}}
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <h6><b class="text-warning">Espacio Asignado:</b> {{$item->nombre_espacio}}</h6>
                            <h6><b class="text-warning">Número del Equipo:</b> {{$item->id_elementInfra}}</h6>
                        </div>
                        <div class="d-flex align-items-center p-2">
                            <a href="{{route('mantenimientos.createResum', $item->id_elementInfra)}}"
                                class="btn btn-outline-warning mx-1 my-1" title="Reportar Falla">
                                Reportar Falla
                            </a>
                            <a href="{{route('infraestructura.edit', $item->id_elementInfra)}}" 
                                class="btn btn-outline-info mx-1 my-1" title="Editar">
                                <i class='bx bx-edit'></i>
                            </a>
                            <a href="{{route('infraestructura.delete', $item->id_elementInfra)}}" 
                                class="btn btn-outline-danger mx-1" title="Eliminar">
                                <i class='bx bx-trash'></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    {{-- PREVENIR EL ENVIO DEl FORMULARIO DE BUSQUEDA --}}
    <script>
        const formBusquedaEquipo = document.getElementById("formBusquedaTipo");

        formBusquedaEquipo.addEventListener("submit", (e) => {
            const tipoEquipo = formBusquedaEquipo.querySelector('select[name="tipo_elemento"]');
            
            if (!tipoEquipo.value || tipoEquipo.value === "Busca por Tipo de Elemento") {
                e.preventDefault(); 
                alertify.error('¡Ingresa un Tipo para poder Buscar!');
            } else {
                console.log("Formulario de código enviado");
            }
        });
    </script>

@endsection
