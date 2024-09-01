{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_index') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Modulo Supervision", "Binevenido")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoIndex') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

<header class="bg-black" id="header">
    <div class="logo">
        <img src="{{ asset('img/iconoClaro.png') }}" alt="Logo de la marca">
    </div>
    <nav class="nav-links">
        <a class="btn btn-dark mx-2" href="{{route("emp.viewEmp")}}">Empleados</a>
        <a class="btn btn-dark mx-2" href="{{route("procesos.index")}}">Procesos</a>
        <a class="btn btn-dark mx-2" href="">Infraestructuras</a>     
    </nav>
</header>

<div class="cajaIndex container bg-black text-white text-center rounded-3 w-50 p-5 mt-5">
    <h1>Bienvenido al Módulo de Supervisión</h1>
    <div class="container">
        <img src="{{ asset('img/iconoClaro.png') }}" alt="Logo de la marca">
    </div>
</div>

<x-Footer/>


@endsection    