{{-- HEADER Y NAVBAR --}}

<header class="header p-3">
    <div class="me-auto">
        <a class="btn btn-outline-warning" data-bs-toggle="offcanvas" href="#offcanvasExample">&#9776</a>
    </div>

    <nav>
        <a class="btn btn-outline-warning mx-2" href="{{route("emp.viewEmp")}}">Empleados</a>
        <a class="btn btn-outline-warning mx-2" href="{{route("procesos.index")}}">Procesos</a>
        <a class="btn btn-outline-warning mx-2" href="{{route("infraestructura.index")}}">Infraestructuras</a>   
        <a class="btn btn-outline-warning mx-2" href="{{route("welcome.index")}}">Modulo Supervisión</a>
    </nav>
</header>
