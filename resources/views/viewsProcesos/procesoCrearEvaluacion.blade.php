{{-- VISTA PARA CREAR EVALUACION DE PROCESO --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Crear Evaluación de un Proceso') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- FOMRULARIO PARA INGRESAR UNA NUEVA EVALUACION --}}
        <form class="w-100 container from-createEmp bg-transparent" action="{{ route('procesos.evaluacionStore') }}" method="POST">
            @csrf

            <div class="d-flex justify-content-between align-items-center container">
                @if($codProces == NULL)
                    <h4 class="text-white">Crear Evaluación para un Proceso</h4>
                    {{-- BOTONES DEL FORMULARIO --}}
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-3" href="{{ route('procesos.evaluaciones') }}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Crear</button>
                    </div>
                @else
                    <h4 class="text-white">Crear Evaluación para el Proceso: <b class="text-warning">{{$codProces->codigo_proces}}</b></h4>
                    {{-- BOTONES DEL FORMULARIO --}}
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-2" href="{{ route('procesos.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Crear</button>
                    </div>
                @endif

            </div>
            <hr class="text-white">

            {{-- INPUTS DEL FORMULARIO --}}
            <div class="d-flex container">

                <div class="w-100 my-2">

                    @if($codProces == NULL)
                        <div class="mb-3 text-white">
                            <label class="form-label"><b>Código del Proceso:</b></label>
                            <input type="text" class="form-control bg-transparent text-white"
                            name="proceso_codigo" placeholder="PR-0000" value="{{ old('proceso_codigo') }}">
                        </div>
                    @else
                        <div class="mb-3 text-white">
                            <label class="form-label"><b>Código del Proceso:</b></label>
                            <input type="text" class="form-control bg-transparent text-white"
                                name="proceso_codigo" value="{{$codProces->codigo_proces}}">
                        </div>
                    @endif
                    @error('proceso_codigo')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Eficiencia:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="eficiencia"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{old("eficiencia")}}">
                    </div>
                    @error("eficiencia")
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Eficiencia:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="efectividad"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{old("efectividad")}}">
                    </div>
                    @error("efectividad")
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Flexibilidad:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="flexibilidad"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{old("flexibilidad")}}">
                    </div>
                    @error("flexibilidad")
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Consistencia:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="consistencia"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{old("flexibilidad")}}">
                    </div>
                    @error("consistencia")
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 inputsEvaluaciones text-start text-white">
                        <label class="form-label"><b>Mejora Continua:</b></label>
                        <input type="number" class="form-control bg-transparent text-white" name="mejora_continua"
                        placeholder="Ingresa una Nota del 1 al 20" value="{{old("mejora_continua")}}">
                    </div>
                    @error("mejora_continua")
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
