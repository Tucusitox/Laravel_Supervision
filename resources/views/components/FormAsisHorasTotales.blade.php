{{-- MODAL PARA CAMBIAR EL ESTATUS DEL EMPLEADO --}}
<div class="modal fade mt-5" id="exampleModal_4">

    <div class="modal-dialog">
        <div class="modal-content bg-black text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Ingrese los Datos Solicitados</h1>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="from-createEmp p-3" action="{{ route('asistencias.horasTotales') }}" method="POST"> 
                @csrf

                <div class="mb-3 text-start text-white">
                    <label class="form-label"><b>Cédula del Empleado:</b></label>
                    <input type="number" class="form-control bg-transparent text-white"
                    name="identificacion" placeholder="Sin Símbolos" value="{{ old('identificacion') }}">
                </div>
                
                <div class="mb-3 text-white">
                    <label class="form-label"><b>Primera Fecha:</b></label>
                    <input type="date" class="form-control bg-transparent text-white" 
                    name="fecha_primera" value="{{ old('fecha_primera') }}">
                </div>

                <div class="mb-3 text-white">
                    <label class="form-label"><b>Segunda Fecha:</b></label>
                    <input type="date" class="form-control bg-transparent text-white" 
                    name="fecha_segunda" value="{{ old('fecha_segunda') }}">
                </div>

                <div class="mt-2 text-center text-white">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-success mx-2">Calcular Horas</button>
                </div>

            </form>
        </div>
    </div>
</div>