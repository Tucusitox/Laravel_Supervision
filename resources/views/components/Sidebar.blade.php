<!-- DIV CON EL SIDEBAR -->

<div id="sideBar">
    <div class="w-25 bg-black text-white text-left offcanvas offcanvas-start" data-bs-scroll="true" id="offcanvasExample">

        <div class="d-flex justify-content-end p-4 fs-3">
            <a class="btn btn-outline-warning" data-bs-dismiss="offcanvas">
                <i class='bx bx-x'></i>
            </a>
        </div>

        <div class="cont-menu sidebar">

            <div class="cajaPadre my-3">
                <div class="sidebarHeader mx-3 p-2">
                    <h5>Empleados</h5>
                    <i class='bx bxs-down-arrow abrirLista'></i>
                    <i class='bx bxs-up-arrow d-none cerrarLista'></i>
                </div>
    
                <nav class="nav-links d-none opciones">
                    <a href="{{route('emp.viewEmp')}}">Resumen de Empleados</a>
                    <a href="{{route('asistencias.index')}}">Asistencias</a> 
                    <a href="{{route('permisos.index')}}">Permisos</a>
                    <a href="{{route("evaluaciones.index")}}">Evaluaciones de Empleados</a>
                    <a href="{{route("evaluaciones.empsDest")}}">Empleados Destacados</a>
                    <a href="{{route('emps.inactivos')}}">Empleados Inactivos</a>
                </nav>
            </div>
            <hr class="text-white">
    
            <div class="cajaPadre my-3">
                <div class="sidebarHeader mx-3 p-2">
                    <h5>Procesos</h5>
                    <i class='bx bxs-down-arrow abrirLista'></i>
                    <i class='bx bxs-up-arrow d-none cerrarLista'></i>
                </div>
    
                <nav class="nav-links d-none opciones">
                    <a href="{{route("procesos.index")}}">Resumen de Procesos</a>
                    <a href="{{route("procesos.evaluaciones")}}">Evaluaciones de Procesos</a>
                    <a href="{{route("procesos.procesDestac")}}">Procesos Destacados</a>
                </nav>
            </div>
            <hr class="text-white">

            <div class="cajaPadre my-3">
                <div class="sidebarHeader mx-3 p-2">
                    <h5>Infraestructura</h5>
                    <i class='bx bxs-down-arrow abrirLista'></i>
                    <i class='bx bxs-up-arrow d-none cerrarLista'></i>
                </div>
    
                <nav class="nav-links d-none opciones">
                    <a href="{{route("infraestructura.index")}}">Resumen de Equipos</a>
                    <a href="{{route("mantenimientos.index")}}">Mantenimientos de Fallas</a>
                </nav>
            </div>
            <hr class="text-white">

        </div>

    </div>

</div>
