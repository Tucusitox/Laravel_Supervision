{{-- VISTA PARA CREAR UN PERMISO --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Crear Permiso para Empleado') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- FOMRULARIO PARA INGRESAR UN NUEVO MANTENIMIENTO --}}
        <form class="w-100 container from-createEmp bg-transparent" action="{{ route('mantenimientos.store') }}" method="POST">
            @csrf

            <div class="d-flex justify-content-between align-items-center container">
                @if($numElement == TRUE)
                    <h4 class="text-white">Ingresa los Datos Solicitados para Reportar la Falla</h4>
                    {{-- BOTONES DEL FORMULARIO --}}
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-3" href="{{ route('mantenimientos.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Reportar</button>
                    </div>
                @else
                    <h4 class="text-white">Reportar Falla para el Equipo: <b class="text-warning">{{$numEquipo->nombre_element}}</b></h4>
                    {{-- BOTONES DEL FORMULARIO --}}
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-2" href="{{ route('infraestructura.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Reportar</button>
                    </div>
                @endif
            </div>
            <hr class="text-white">

            {{-- INPUTS DEL FORMULARIO --}}

            <div class="d-flex container">

                <div class="w-100 my-2">

                    @if($numElement == TRUE)
                        <div class="mb-3 text-white">
                            <label class="form-label"><b>Número del Equipo:</b></label>
                            <input type="number" class="form-control bg-transparent text-white"
                            name="id_elemento" placeholder="Sin Símbolos" value="{{ old('id_elemento') }}">
                        </div>
                    @else
                        <div class="mb-3 text-white">
                            <label class="form-label"><b>Número del Elemento:</b></label>
                            <input type="number" class="form-control bg-transparent text-white"
                            name="id_elemento" placeholder="Sin Símbolos" value="{{$numEquipo->id_elementInfra}}">
                        </div>
                    @endif
                    @error('id_elemento')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-start text-white">
                        <label class="form-label bg-transparent text-white"><b>Asunto de la Falla:</b></label>
                        <input type="text" class="form-control bg-transparent text-white"
                        name="mantenimiento_asunto" placeholder="Sea Breve" value="{{ old('mantenimiento_asunto') }}">
                    </div>
                    @error('mantenimiento_asunto')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Descripción de la Falla:</b></label>
                        <textarea type="text" class="form-control bg-transparent text-white" 
                        placeholder="Máximo 2000 Caracteres" name="mantenimiento_descripcion" 
                        rows="8" maxlength="2000">{{old('mantenimiento_descripcion')}}</textarea>
                    </div>
                    @error('mantenimiento_descripcion')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror


                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Fecha de Inicio de la Falla:</b></label>
                        <input type="date" class="form-control bg-transparent text-white" 
                        name="fecha_inicioEvent" value="{{ old('fecha_inicioEvent') }}">
                    </div>
                    @error('fecha_inicioEvent')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </form>
        <hr class="text-white">
    </div>

@endsection
