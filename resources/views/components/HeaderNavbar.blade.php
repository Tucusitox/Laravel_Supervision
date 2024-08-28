{{-- HEADER Y NAVBAR --}}

<header class="header p-3">
    <div class="me-auto nav-links">
        <a class="btn btn-dark" data-bs-toggle="offcanvas" href="#offcanvasExample">&#9776</a>
    </div>

    <nav class="nav-links">
        <a class="btn btn-dark mx-2" href="{{route("emp.viewEmp")}}">Empleados</a>
        <a class="btn btn-dark mx-2">Procesos</a>
        <a class="btn btn-dark mx-2">Infraestructuras</a>
        <a class="btn btn-dark mx-2" href="{{route("welcome.index")}}">Modulo Supervisión</a>
    </nav>
</header>
