{{-- MODAL PARA CAMBIAR EL ESTATUS DEL EMPLEADO --}}
<div class="modal fade mt-5" id="exampleModal_3">

    <div class="modal-dialog">
        <div class="modal-content bg-black text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Ingrese los Datos Solicitados</h1>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="p-3" action="{{ route('asistencias.store') }}" method="POST"> 
                @csrf

                <div class="mb-3 text-center text-white">
                    <h6>Hora Actual: <b id="reloj"></b></h6>
                </div>

                <div class="mb-3 text-start text-white">
                    <label class="form-label"><b>Elija la hora:</b></label>
                    <select class="form-select text-white bg-black" name="tipo_hora">
                        <option value="" {{ old('tipo_hora') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                        <option value="Hora de Entrada" {{ old('tipo_hora') == 'Hora de Entrada' ? 'selected' : '' }}>Hora de Entrada</option>
                        <option value="Hora de Salida" {{ old('tipo_hora') == 'Hora de Salida' ? 'selected' : '' }}>Hora de Salida</option>
                    </select>
                </div>

                <div class="mb-3 from-createEmp text-start text-white">
                    <label class="form-label"><b>Cédula del Empleado:</b></label>
                    <input type="number" class="form-control bg-transparent text-white"
                    name="identificacion" placeholder="Sin Símbolos" value="{{ old('identificacion') }}">
                </div>

                <div class="mt-2 text-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-success mx-2">Guardar Asistencia</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>

    // ACTUALIZAR HORA CADA SEGUNDO
    function updateTime() {
        const now = new Date();
        const options = { timeZone: 'America/Caracas', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        const timeString = now.toLocaleTimeString('es-VE', options);
        document.getElementById('reloj').textContent = timeString;
    }

    setInterval(updateTime, 1000);
</script>