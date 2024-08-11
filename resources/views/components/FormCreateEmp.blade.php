{{-- FOMRULARIO PARA INGRESAR UN NUEVO EMPLEADO --}}

<form action="{{ route('empleado.store') }}" method="POST" enctype="multipart/form-data" 
    class="w-100 container from-createEmp bg-transparent">
    @csrf

    <div class="d-flex justify-content-between align-items-center container">
        <h4 class="text-white">Registrar Empleado</h4>

        {{-- BOTONES DEL FORMULARIO --}}
        <div class="d-flex justify-content-end nav-links">
            <a class="btn btn-danger mx-3" href="{{ route('emp.viewEmp') }}">Cancelar</a>
            <button type="submit" class="btn btn-dark">Crear</button>
        </div>
    </div>
    <hr class="text-white">

    {{-- INPUTS DEL FORMULARIO --}}

    <div class="d-flex container">
        <div class="mx-5 mt-4">

            <div class="container mb-5 text-white">
                <label class="form-label"><b>Fecha de Ingreso:</b></label>
                <input type="date" class="form-control bg-transparent text-white" 
                name="fecha_ingreso" value="{{ old('fecha_ingreso') }}">
            </div>
            @error('fecha_ingreso')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <div class="container mb-5">
                <img src="{{ asset('img/avatarDefault.webp') }}" 
                style="max-height: 250px; border-radius: 10px; border: 3px solid #ffff;" id="img"/>
            </div>

            <div class="d-flex justify-content-center container contenedor-btn-file bordeado w-75">
                <label class="form-label" for="foto">
                    <i class='bx bx-image-add my-1'></i>
                    Adjuntar Foto
                    <input type="file" name="foto" id="foto">
                </label>
            </div>
            @error('foto')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

        </div>

        <div class="detalleEmp mt-3 px-2 w-50">
            
            <div class="mb-3 text-white">
                <label class="form-label bg-transparent text-white"><b>Nombres:</b></label>
                <input type="text" class="form-control bg-transparent text-white" 
                name="nombre" placeholder="Nombres" value="{{ old('nombre') }}">
            </div>
            @error('nombre')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <div class="mb-3 text-white">
                <label class="form-label bg-transparent text-white"><b>Apellidos:</b></label>
                <input type="text" class="form-control bg-transparent text-white" 
                name="apellido" placeholder="Apellidos" value="{{ old('apellido') }}">
            </div>
            @error('apellido')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <div class="mb-3 text-white">
                <label class="form-label"><b>Cédula:</b></label>
                <input type="number" class="form-control bg-transparent text-white"
                name="identificacion" placeholder="Sin Símbolos" value="{{ old('identificacion') }}">
            </div>
            @error('identificacion')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <div class="mb-3 text-white">
                <label class="form-label"><b>Tipo de Cédula:</b></label>
                <select class="form-select" name="tipo_identificacion">
                    <option value="" {{ old('tipo_identificacion') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                    <option value="Venezolana" {{ old('tipo_identificacion') == 'Venezolana' ? 'selected' : '' }}>Venezolana</option>
                    <option value="Extranjera" {{ old('tipo_identificacion') == 'Extranjera' ? 'selected' : '' }}>Extranjera</option>
                </select>
            </div>
            @error('tipo_identificacion')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <div class="mb-3 text-white">
                <label class="form-label"><b>Fecha de Nacimiento:</b></label>
                <input type="date" class="form-control bg-transparent text-white" 
                name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
            </div>
            @error('fecha_nacimiento')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <div class="mb-3 text-white">
                <label class="form-label"><b>Dirección:</b></label>
                <input type="text" class="form-control bg-transparent text-white" 
                placeholder="Dirección de residencia" name="direccion" 
                value="{{ old('direccion') }}"></input>
            </div>
            @error('direccion')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror
            
        </div>

        <div class="detalleEmp mt-3 mx-4 w-50">

            <div class="mb-3 text-white">
                <label class="form-label"><b>Cargo de Empleado:</b></label> 
                <select class="form-select" name="cargo_emp">
                    <option value="" {{ old('cargo_emp') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                    <option value="Gerente" {{ old('cargo_emp') == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                    <option value="Maître" {{ old('cargo_emp') == 'Maître' ? 'selected' : '' }}>Maître</option>
                    <option value="Mesero" {{ old('cargo_emp') == 'Mesero' ? 'selected' : '' }}>Mesero</option>
                    <option value="Bartender" {{ old('cargo_emp') == 'Bartender' ? 'selected' : '' }}>Bartender</option>
                    <option value="Recepcionista" {{ old('cargo_emp') == 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                    <option value="Chef ejecutivo" {{ old('cargo_emp') == 'Chef ejecutivo' ? 'selected' : '' }}>Chef ejecutivo</option>
                    <option value="Jefe de cocina" {{ old('cargo_emp') == 'Jefe de cocina' ? 'selected' : '' }}>Jefe de cocina</option>
                    <option value="Sous chef" {{ old('cargo_emp') == 'Sous chef' ? 'selected' : '' }}>Sous chef</option>
                    <option value="Cocinero" {{ old('cargo_emp') == 'Cocinero' ? 'selected' : '' }}>Cocinero</option>
                    <option value="Asistente de cocina" {{ old('cargo_emp') == 'Asistente de cocina' ? 'selected' : '' }}>Asistente de cocina</option>
                    <option value="Almacenista" {{ old('cargo_emp') == 'Almacenista' ? 'selected' : '' }}>Almacenista</option>
                    <option value="Conserje" {{ old('cargo_emp') == 'Conserje' ? 'selected' : '' }}>Conserje</option>
                    <option value="Repartidor" {{ old('cargo_emp') == 'Repartidor' ? 'selected' : '' }}>Repartidor</option>
                    <option value="Abogado" {{ old('cargo_emp') == 'Abogado' ? 'selected' : '' }}>Abogado</option>
                </select>
            </div>
            @error('cargo_emp')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror
            
            <div class="mb-3 text-white">
                <label class="form-label"><b>Tipo de Empleado:</b></label>
                <select class="form-select" name="tipo_emp">
                    <option value="" {{ old('tipo_emp') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                    <option value="Fijo" {{ old('tipo_emp') == 'Fijo' ? 'selected' : '' }}>Fijo</option>
                    <option value="Contratado" {{ old('tipo_emp') == 'Contratado' ? 'selected' : '' }}>Contratado</option>
                    <option value="A Destajo" {{ old('tipo_emp') == 'A Destajo' ? 'selected' : '' }}>A Destajo</option>
                </select>
            </div>
            @error('tipo_emp')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <div class="mb-3 text-white">
                <label class="form-label"><b>Horario del Empleado:</b></label>
                <select class="form-select" name="nombre_horario">
                    <option value="" {{ old('nombre_horario') == '' ? 'selected' : '' }}>Abogado marque "No Aplica"</option>
                    <option value="Mañana" {{ old('nombre_horario') == 'Mañana' ? 'selected' : '' }}>Mañana</option>
                    <option value="Tarde/Noche" {{ old('nombre_horario') == 'Tarde/Noche' ? 'selected' : '' }}>Tarde/Noche</option>
                    <option value="Completo" {{ old('nombre_horario') == 'Completo' ? 'selected' : '' }}>Completo</option>
                    <option value="No Aplica" {{ old('nombre_horario') == 'No Aplica' ? 'selected' : '' }}>No Aplica</option>
                </select>
            </div>
            @error('nombre_horario')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <div class="mb-3 text-white">
                <label class="form-label"><b>Teléfono Celular:</b></label>
                <input type="text" class="form-control bg-transparent text-white" 
                name="tlf_celular" placeholder="Celular" value="{{ old('tlf_celular') }}">
            </div>
            @error('tlf_celular')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror
        
            <div class="mb-3 text-white">
                <label class="form-label"><b>Teléfono Local:</b></label>
                <input type="text" class="form-control bg-transparent text-white" 
                name="tlf_local" placeholder="Local" value="{{ old('tlf_local') }}">
            </div>
            @error('tlf_local')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror

            <div class="mb-3 text-white">
                <label class="form-label"><b>Género:</b></label>
                <select class="form-select" name="genero">
                    <option value="" {{ old('genero') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                    <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>
            @error('genero')
                <div class="alert alert-danger mt-3">{{ $message }}</div> 
            @enderror
        </div>
    </div>

</form>

