{{-- VISTA PARA ACTUALIZAR UN EQUIPO --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Actualizar un Equipo') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- FOMRULARIO PARA ACTUALIZAR ELEMENTOS DE INFRAESTRUCTURA --}}

        <form class="w-100 container from-createEmp bg-transparent" action="{{route("infraestructura.update",$elementUpdate->id_elementInfra)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="d-flex justify-content-between align-items-center container">
                <h4 class="text-white">Actualizar el Equipo: <b class="text-warning">{{$elementUpdate->nombre_element}}</b></h4>
                {{-- BOTONES DEL FORMULARIO --}}
                <div class="d-flex justify-content-end nav-links">
                    <a class="btn btn-danger mx-3" href="{{ route('infraestructura.index') }}">Cancelar</a>
                    <button type="submit" class="btn btn-outline-warning">Actualizar</button>
                </div>
            </div>
            <hr class="text-white">

            {{-- INPUTS DEL FORMULARIO --}}

            <div class="d-flex container">

                <div class="w-100 my-2">
                    <div class="mb-3 text-start text-white">
                        <label class="form-label bg-transparent text-white"><b>Tipo de Equipo:</b></label>
                        <select class="form-select text-white bg-transparent" name="tipo_elemento">
                            @foreach ($tipoElement as $item)
                                <option value="{{ Str::snake($item->tipo_elemento) }}" {{Str::snake($elementUpdate->tipo_elemento) == Str::snake($item->tipo_elemento) ? 'selected' : ''}}>{{ $item->tipo_elemento }}</option>         
                            @endforeach
                        </select>     
                    </div>
                    @error('tipo_elemento')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-start text-white">
                        <label class="form-label bg-transparent text-white"><b>Espacios:</b></label>
                        <select class="form-select text-white bg-transparent" name="espacios_infraestructura">
                            @foreach ($espacios as $item)
                                <option value="{{ Str::snake($item->nombre_espacio) }}" {{Str::snake($elementUpdate->nombre_espacio) == Str::snake($item->nombre_espacio) ? 'selected' : ''}}>{{ $item->nombre_espacio }}</option>         
                            @endforeach
                        </select>     
                    </div>
                    @error('espacios_infraestructura')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Nombre del Equipo:</b></label>
                        <input type="text" class="form-control bg-transparent text-white"
                        name="nombre_equipo" placeholder="Nombre Corto" value="{{$elementUpdate->nombre_element}}">
                    </div>
                    @error('nombre_equipo')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Descripción del Equipo:</b></label>
                        <textarea type="text" class="form-control bg-transparent text-white" 
                        placeholder="Máximo 2000 Caracteres" name="descripcion_equipo" 
                        rows="8" maxlength="2000">{{$elementUpdate->descripcion_element}}</textarea>
                    </div>
                    @error('descripcion_equipo')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </form>
        <hr class="text-white">
    </div>

@endsection
