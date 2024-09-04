{{-- VISTA ELIMINAR UN EQUIPO --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Elminar un Equipo') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <div class="d-flex justify-content-between text-danger">
            <h4>¿Estas Seguro de Eliminar este Equipo del Sistema?</h4>
            <form class="d-flex nav-links" action="{{route("infraestructura.destroy",$elementDelete->id_elementInfra)}}" method="POST">
                @csrf
                @method("DELETE")

                <a class="btn btn-warning mx-3" href="{{ route('infraestructura.index') }}">Cancelar</a>
                <button type="submit" class="btn btn-outline-danger">Si, Estoy Seguro</button>
            </form>
        </div>
        
        <hr class="text-white">

        {{-- MOSTRAR EL EQUIPO A ELIMINAR EN UNA CARD --}}
        <div class="d-flex justify-content-center">
            <div class="card bg-transparent text-white border w-50 mx-3">
                <div class="card-header border-bottom">
                    <h6><b class="text-warning">Tipo de Equipo:</b> {{$elementDelete->tipo_elemento}}</h6>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-warning">{{$elementDelete->nombre_element}}</h5>
                    <p class="card-text">
                        {{$elementDelete->descripcion_element}}
                    </p>
                    <h6><b class="text-warning">Espacio Asignado:</b> {{$elementDelete->nombre_espacio}}</h6>
                </div>
            </div>
        </div>

    </div>

@endsection
