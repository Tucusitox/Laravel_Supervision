{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Empleados Inactivos') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        <div class="w-100 text-center text-white">
            <h4>Cambiar estatus a Activo</h4>
        </div>

        <hr class="text-white">
        <p class="mb-4 text-white">¿Seguro que deseas colocar <b class="text-warning">"Activo"</b> a este antiguo empleado?</p>
        <p class="mb-4 text-white"><b class="text-warning">Nota:</b> La fecha de ingreso y esgreso seran eliminadas ya que el 
            empelado se estará reincorporando. Además se le creara una nueva fecha de ingreso con el día: 
            <b class="text-warning">{{ now()->setTimezone('America/Caracas')->format('Y/m/d') }}</b>
        </p>
        <hr class="text-white">

        <table class="table table-bordered table-dark border-white text-center">
            <thead >
                <tr>
                    <th scope="col">Identificación</th>
                    <th scope="col">Nombre y Apellido</th>
                    <th scope="col">Estado Laboral</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$empInactivo->first()->identificacion}}</td>
                    <td>{{$empInactivo->first()->Nombre_Apellido}}</td>
                    <td>{{$empInactivo->first()->estado_laboral}}</td>
                </tr>
            </tbody>
        </table>
        <hr class="text-white">

        <form action="{{route('empleado.cambioActivo', $empInactivo->first()->id_persona)}}" method="POST">
            @csrf
            @method("PUT")
            
            <div class="mt-4">
                <a  href="{{ route('emps.inactivos', $empInactivo->first()->id_persona) }}"
                class="btn btn-danger">Cancelar</a> 
                
                <button class="btn btn-warning mx-2">Si, Estoy seguro</button>
            </div>

        </form>
        
    </div>

@endsection
