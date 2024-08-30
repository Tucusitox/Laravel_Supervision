{{-- VISTA PARA CREAR EVALUACION DE EMPLEADO --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Crear Evaluación de un Empleado') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- FOMRULARIO PARA INGRESAR UNA NUEVA EVALUACION --}}

        <form class="w-100 container from-createEmp bg-transparent" action="{{ route('evaluaciones.store') }}" method="POST">
            @csrf

            <div class="d-flex justify-content-between align-items-center container">
                @if($ciEmp == NULL)
                    <h4 class="text-white">Crear Evaluación para un Empleado</h4>
                    {{-- BOTONES DEL FORMULARIO --}}
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-3" href="{{ route('evaluaciones.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Crear</button>
                    </div>
                @else
                    <h4 class="text-white">Crear Evaluación para: <b class="text-warning">{{$ciEmp->Nombre_Apellido}}</b></h4>
                    {{-- BOTONES DEL FORMULARIO --}}
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-2" href="{{ route('empleado.show',$ciEmp->id_persona) }}">Cancelar</a>
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
                            name="identificacion" value="{{ $ciEmp->identificacion }}">
                        </div>
                    @endif

                    @error('identificacion')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Higiene:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="higiene"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{ old("higiene") }}">
                    </div>
                    @error("higiene")
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Vestimenta:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="vestimenta"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{ old("vestimenta") }}">
                    </div>
                    @error("vestimenta")
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Buen Trato al Cliente:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="buenTrato_cliente"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{ old("buenTrato_cliente") }}">
                    </div>
                    @error("buenTrato_cliente")
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Conocimiento de los Menús:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="conocimiento_menus"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{ old("conocimiento_menus") }}">
                    </div>
                    @error("conocimiento_menus")
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Trabajo en Equipo:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="trabajo_equipo"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{ old("trabajo_equipo") }}">
                    </div>
                    @error("trabajo_equipo")
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Fecha de la Evaluación:</b></label>
                        <input type="date" class="form-control bg-transparent text-white" 
                        name="fecha_evaluacion" value="{{ old('fecha_evaluacion') }}">
                    </div>
                    @error('fecha_evaluacion')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </form>
        <hr class="text-white">
    </div>

@endsection
