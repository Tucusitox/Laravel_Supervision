<!-- DIV CON EL SIDEBAR -->

<div id="sideBar">
    <div class="w-25 bg-black text-white text-left offcanvas offcanvas-start" data-bs-scroll="true" id="offcanvasExample">

        <div class="d-flex justify-content-start nav-links p-4 fs-3">
            <a class="btn btn-dark" data-bs-dismiss="offcanvas">
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
                    <a href="{{ route('emp.viewEmp') }}">Resumen de Empleados</a>
                    <a href="{{ route('crearEmp.index') }}">Crear un Empleado</a>
                    <a href="{{ route('asistencias.index') }}">Asistencias</a> 
                    <a href="{{ route('eventualidades.index') }}">Permisos</a>
                    <a href="#">Evaluar a un Empleado</a>
                    <a href="#">Empleados Destacados</a>
                    <a href="{{ route('emps.inactivos') }}">Empleados Inactivos</a>
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
                    <a href="#">Eventualidades</a>
                    <a href="#">Evaluar a un Empleado</a>
                    <a href="#">Calculo de Horas</a>
                    <a href="#">Empleados Destacados</a>
                </nav>
            </div>
            <hr class="text-white">
    
        </div>

    </div>

</div>
