{{-- VISTA DELETE PROCESO --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Eliminar un Proceso') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <div class="d-flex w-100 text-center text-danger">
            <h4>¿Estás Seguro que deseas Eliminar este Proceso?</h4>
        </div>
        <hr class="text-white">

        {{-- MOSTRAR LOS PROCESOS A ELIMINAR EN UNA CARD --}}
        <div class="card w-100 bg-transparent border border-white text-white p-2 mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="codigo card-title mb-2 text-danger">{{$deleteProceso->codigo_proces}}</h5>
                        <h5>{{$deleteProceso->asunto_proceso}}</h5>
                    </div>
                    <div class="mt-1">
                        <h6 class="card-subtitle mb-2 "><b class="text-danger">Tipo de Proceso:</b>
                            {{$deleteProceso->nombre_tipoProces}}
                        </h6>
                        <h6 class="card-subtitle mb-2"><b class="text-danger">Tiempo de Duración:</b>
                            {{\Carbon\Carbon::parse($deleteProceso->tiempo_duracion)->format('h:i:s')}}
                        </h6>
                    </div>
                </div>
                <hr class="text-white">
                <p class="card-text">{{$deleteProceso->descripcion_proces}}</p>
                <hr class="text-white">
                <div class="d-flex justify-content-between">
                    <div class="mt-1">
                        <h6 class="card-subtitle mb-2"><b class="text-danger">Espacio del Proceso:</b>
                            {{$deleteProceso->nombre_espacio}}
                        </h6>
                        <h6 class="card-subtitle mb-2 "><b class="text-danger">Fecha de Creación:</b>
                            {{\Carbon\Carbon::parse($deleteProceso->fecha_proceso)->format('d/m/Y')}}
                        </h6>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{route("procesos.index")}}" class="btn btn-warning me-2" title="Cancelar">
                            Cancelar
                        </a>
                        <form action="{{route("procesos.destroy",$deleteProceso->id_proceso)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-outline-danger" title="Eliminar">
                                Si, Estoy Seguro
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection
