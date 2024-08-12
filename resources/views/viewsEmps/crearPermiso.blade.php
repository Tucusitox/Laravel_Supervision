{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Actualización del Empleado') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- FOMRULARIO PARA INGRESAR UN NUEVO EMPLEADO --}}

        <form class="w-100 container from-createEmp bg-transparent" action="{{ route('permisos.store') }}" method="POST">
            @csrf

            <div class="d-flex justify-content-between align-items-center container">
                <h4 class="text-white">Ingresa los Datos Solicitados para  Generar el Permiso</h4>

                @if($ciEmp == NULL)
                    {{-- BOTONES DEL FORMULARIO --}}
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-3" href="{{ route('permisos.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Crear</button>
                    </div>
                @else
                    {{-- BOTONES DEL FORMULARIO --}}
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-2" href="{{ route('empleado.show',$ciEmp->first()->id_persona) }}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Crear</button>
                    </div>
                @endif

            </div>
            <hr class="text-white">

            {{-- INPUTS DEL FORMULARIO --}}

            <div class="d-flex container">

                <div class="w-100 my-2">

                    @if($ciEmp == NULL)
                        <div class="mb-3 text-white">
                            <label class="form-label"><b>Cédula del Empleado:</b></label>
                            <input type="number" class="form-control bg-transparent text-white"
                            name="identificacion" placeholder="Sin Símbolos" value="{{ old('identificacion') }}">
                        </div>
                        @error('identificacion')
                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    @else
                        <div class="mb-3 text-white">
                            <label class="form-label"><b>Cédula del Empleado:</b></label>
                            <input type="number" class="form-control bg-transparent text-white"
                            name="identificacion" value="{{ $ciEmp->first()->identificacion }}">
                        </div>
                        @error('identificacion')
                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    @endif

                    <div class="mb-3 text-white">
                        <label class="form-label bg-transparent text-white"><b>Asunto del Permiso:</b></label>
                        <input type="text" class="form-control bg-transparent text-white" placeholder="Asunto Breve"
                        name="permiso_asunto" value="{{ old('permiso_asunto') }}">
                    </div>
                    @error('permiso_asunto')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Descripción del Permiso:</b></label>
                        <textarea type="text" class="form-control bg-transparent text-white" 
                        placeholder="Máximo 2000 Caracteres" name="permiso_descripcion" 
                        rows="8" maxlength="2000"></textarea>
                    </div>
                    @error('permiso_descripcion')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror


                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Fecha de Inicio del Permiso:</b></label>
                        <input type="date" class="form-control bg-transparent text-white" 
                        name="fecha_inicioEvent" value="{{ old('fecha_inicioEvent') }}">
                    </div>
                    @error('fecha_inicioEvent')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Fecha Final del Permiso:</b></label>
                        <input type="date" class="form-control bg-transparent text-white" 
                        name="fecha_finEvent" value="{{ old('fecha_finEvent') }}">
                    </div>
                    @error('fecha_finEvent')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </form>
        <hr class="text-white">
    </div>

@endsection
