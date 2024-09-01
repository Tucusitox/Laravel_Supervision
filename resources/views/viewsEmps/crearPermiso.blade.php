{{-- VISTA PARA CREAR UN PERMISO --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Crear Permiso para Empleado') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- FOMRULARIO PARA INGRESAR UN NUEVO PERMISO --}}

        <form class="w-100 container from-createEmp bg-transparent" action="{{ route('permisos.store') }}" method="POST">
            @csrf

            <div class="d-flex justify-content-between align-items-center container">
                @if($ciEmp == NULL)
                    <h4 class="text-white">Ingresa los Datos Solicitados para  Generar el Permiso</h4>
                    {{-- BOTONES DEL FORMULARIO --}}
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-3" href="{{ route('permisos.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Crear</button>
                    </div>
                @else
                    <h4 class="text-white">Generar Permiso para el Empleado: <b class="text-warning">{{$ciEmp->first()->Nombre_Apellido}}</b></h4>
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
                    @else
                        <div class="mb-3 text-white">
                            <label class="form-label"><b>Cédula del Empleado:</b></label>
                            <input type="number" class="form-control bg-transparent text-white"
                            name="identificacion" value="{{ $ciEmp->first()->identificacion }}">
                        </div>
                    @endif
                        @error('identificacion')
                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror

                    <div class="mb-3 text-start text-white">
                        <label class="form-label bg-transparent text-white"><b>Tipo de Permiso:</b></label>
                        <select class="form-select text-white bg-transparent" name="permiso_asunto">
                            <option value="" {{ old('permiso_asunto') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                            <option value="Reposo Médico" {{ old('permiso_asunto') == 'Reposo Médico' ? 'selected' : '' }}>Reposo Médico</option>
                            <option value="Maternidad" {{ old('permiso_asunto') == 'Maternidad' ? 'selected' : '' }}>Maternidad</option>
                            <option value="Lactancia" {{ old('permiso_asunto') == 'Lactancia' ? 'selected' : '' }}>Lactancia</option>
                            <option value="Matrimonio" {{ old('permiso_asunto') == 'Matrimonio' ? 'selected' : '' }}>Matrimonio</option>
                            <option value="Mudanza" {{ old('permiso_asunto') == 'Mudanza' ? 'selected' : '' }}>Mudanza</option>
                            <option value="Asuntos Personales" {{ old('permiso_asunto') == 'Asuntos Personales' ? 'selected' : '' }}>Asuntos Personales</option>
                            <option value="Salida Temprana" {{ old('permiso_asunto') == 'Salida Temprana' ? 'selected' : '' }}>Salida Temprana</option>
                        </select>
                    </div>
                    @error('permiso_asunto')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Descripción del Permiso:</b></label>
                        <textarea type="text" class="form-control bg-transparent text-white" 
                        placeholder="Máximo 2000 Caracteres" name="permiso_descripcion" 
                        rows="8" maxlength="2000">{{old('permiso_descripcion')}}</textarea>
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
