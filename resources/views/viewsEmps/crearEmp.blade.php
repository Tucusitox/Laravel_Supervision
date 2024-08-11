{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Registrar Empleado') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}

@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    {{-- AQUI LOS COMPONENTES A UTILIZAR EN LA VISTA --}}

    <div class="caja3 container p-5" id="contenedor">
    {{-- FORM PARA CREAR EMPLEADOS --}}
        <x-FormCreateEmp/>
    </div>


@endsection
