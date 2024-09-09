{{-- VISTA PARA ACTUALIZAR UN PROCESO --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Actualizar un Proceso') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- FOMRULARIO PARA ACTUALIZAR UN PROCESO --}}

        <form class="w-100 container from-createEmp bg-transparent" action="{{route("procesos.update",$unProceso->id_proceso)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="d-flex justify-content-between align-items-center container">
                <h4 class="text-white">Actualizando Proceso: <b class="text-warning">{{$unProceso->codigo_proces}}</b></h4>
                {{-- BOTONES DEL FORMULARIO --}}
                <div class="d-flex justify-content-end">
                    <a class="btn btn-danger mx-3" href="{{ route('procesos.index') }}">Cancelar</a>
                    <button type="submit" class="btn btn-outline-warning">Actualizar</button>
                </div>
            </div>
            <hr class="text-white">

            {{-- INPUTS DEL FORMULARIO --}}
            <div class="d-flex container">

                <div class="w-100 my-2">
                    <div class="mb-3 text-start text-white">
                        <label class="form-label bg-transparent text-white"><b>Tipo de Proceso:</b></label>
                        <select class="form-select text-white bg-transparent" name="tipo_proceso">
                            <option value="planificacion" {{ Str::snake($unProceso->nombre_tipoProces) == 'planificación' ? 'selected' : '' }}>Planificación</option>
                            <option value="gestion_recursos" {{ Str::snake($unProceso->nombre_tipoProces) == 'gestión_de_recursos' ? 'selected' : '' }}>Gestión de Recursos</option>
                            <option value="produccion" {{ Str::snake($unProceso->nombre_tipoProces) == 'producción' ? 'selected' : '' }}>Producción</option>
                            <option value="medicion" {{ Str::snake($unProceso->nombre_tipoProces) == 'medición' ? 'selected' : '' }}>Medición</option>
                        </select>
                    </div>
                    @error('tipo_proceso')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-start text-white">
                        <label class="form-label bg-transparent text-white"><b>Espacios:</b></label>
                        <select class="form-select text-white bg-transparent" name="espacios_procesos">
                            @foreach ($espacios as $item)
                                <option value="{{ Str::snake($item->nombre_espacio) }}" {{Str::snake($unProceso->nombre_espacio) == Str::snake($item->nombre_espacio) ? 'selected' : ''}}>{{ $item->nombre_espacio }}</option>         
                            @endforeach
                        </select>     
                    </div>
                    @error('espacios_procesos')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Asunto del Proceso:</b></label>
                        <input type="text" class="form-control bg-transparent text-white"
                        name="asunto_proceso" placeholder="Sea Breve" value="{{$unProceso->asunto_proceso}}">
                    </div>
                    @error('asunto_proceso')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Descripción del Proceso:</b></label>
                        <textarea type="text" class="form-control bg-transparent text-white" 
                        placeholder="Máximo 2000 Caracteres" name="descripcion_proceso" 
                        rows="8" maxlength="2000">{{$unProceso->descripcion_proces}}</textarea>
                    </div>
                    @error('descripcion_proceso')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Tiempo de Duración:</b></label>
                        <input type="text" class="form-control bg-transparent text-white" 
                        name="tiempo_proceso" placeholder="hh:mm:ss" value="{{\Carbon\Carbon::parse($unProceso->tiempo_duracion)->format('h:i:s')}}">
                    </div>
                    @error('tiempo_proceso')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Fecha de Creación:</b></label>
                        <input type="date" class="form-control bg-transparent text-white" 
                        name="fecha_proceso" value="{{$unProceso->fecha_proceso->format("Y-m-d")}}">
                    </div>
                    @error('fecha_proceso')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>

            </div>

        </form>
        <hr class="text-white">
    </div>

@endsection
