{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Empleados Inactivos') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <form action="{{route('mantenimientos.update', $falla->id_eventualidad)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="d-flex justify-content-between align-items-center text-white">
                <h3>Código de la Falla: <b class="text-warning">{{$falla->codigo_event}}</b></h3>
                <div>
                    <a  href="{{ route('mantenimientos.index', $falla->id_eventualidad) }}"class="btn btn-danger">Cancelar</a> 
                    <button class="btn btn-outline-warning mx-2">Actualizar Estatus</button>
                </div>
            </div>
            <hr class="text-white">

            <div class="mb-3 text-start text-white">
                <label class="form-label bg-transparent text-white"><b>Estatus a Cambiar:</b></label>
                <select class="form-select text-white bg-black" name="tipo_estatus">
                    <option value="" {{ old('tipo_estatus') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                    <option value="Iniciada" {{ old('tipo_estatus') == 'Iniciada' ? 'selected' : '' }}>Iniciada</option>
                    <option value="En Proceso" {{ old('tipo_estatus') == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="Solucionada" {{ old('tipo_estatus') == 'Solucionada' ? 'selected' : '' }}>Solucionada</option>
                </select>   
            </div>
            @error('tipo_estatus')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

        </form>
        
    </div>

@endsection
