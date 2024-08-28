{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Eliminar a un Empleado') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja4 container p-5" id="contenedor">

        <div class="d-flex align-items-center w-100 text-center text-white">
            @if ($bolean == TRUE)
                <div>
                    <a href="{{route('emp.viewEmp')}}" class="btn btn-warning mx-1 my-1" title="Volver">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
            @else
                <div>
                    <a href="{{route('empleado.show', $deletEmp->first()->id_persona)}}" class="btn btn-warning mx-1 my-1" title="Volver">
                        <i class='bx bx-arrow-back'></i>
                    </a>
                </div>
            @endif
            <div class="flex-grow-1">
                <h4>¿Qué deseas hacer?</h4>
            </div>
        </div>

        <hr class="text-white">

        <div class="d-flex justify-content-center w-100 p-3">

            <button class="btn btn-dark p-4 mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal_1">
                <p>Cambiar el estatus a <b class="text-warning">"Inactivo"</b> del empelado:</p>
                <p><b class="text-warning">{{$deletEmp->first()->Nombre_Apellido}}</b></p>
                <p>y asignarle la fecha de <b class="text-warning">Egreso</b> automáticamente.</p>
            </button>
    
            <button class="btn btn-dark p-4 mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal_2">
                <p>Eliminar <b class="text-danger">"Permanentemente"</b> del sistema al empelado:</p>
                <p><b class="text-danger">{{$deletEmp->first()->Nombre_Apellido}}</b></p>
            </button>

        </div>

        {{-- MODAL PARA CAMBIAR EL ESTATUS DEL EMPLEADO --}}
        <div class="modal fade mt-5" id="exampleModal_1">

            <div class="modal-dialog">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">¿Estas Seguro?</h1>
                        <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="p-3" action="{{route('empleado.estatus', $deletEmp->first()->id_persona)}}" method="POST">
                        @csrf
                        @method("PUT")

                        <div class="container text-center">
                            <p>El estatus del empleado
                                <b class="text-warning">{{$deletEmp->first()->Nombre_Apellido}}</b>
                                será cambiado a <b class="text-warning">"Inactivo"</b>
                                y se le asignara la fecha de egreso
                                <b class="text-warning">{{ now()->setTimezone('America/Caracas')->format('d/m/y') }}</b>
                            </p>
                        </div>
                        
                        <div class="mt-2 text-center text-white">
                            <button type="button" class="btn btn-danger mx-3" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning">Si, Estoy Seguro</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL ELIMINAR AL EMPLEADO DEL SISTEMA --}}
        <div class="modal fade mt-5" id="exampleModal_2">

            <div class="modal-dialog">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">¿Estas Seguro?</h1>
                        <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="p-3" action="{{route('empleado.destroy', $deletEmp->first()->id_persona)}}" method="POST">
                        @csrf
                        @method("DELETE") 

                        <div class="container text-center">
                            <p> El empelado <b class="text-danger">{{$deletEmp->first()->Nombre_Apellido}}</b> será eliminado
                                permanentemente del sistema junto con toda la información relacionada
                                con él a excepción de los procesos en los que participo.
                            </p>
                        </div>

                        <div class="mt-2 text-center text-white">
                            <button type="button" class="btn btn-danger mx-3" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning">Si, Estoy Seguro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
