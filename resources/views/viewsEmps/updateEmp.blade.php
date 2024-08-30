{{-- VISTA PARA REGISTRAR O INICIAR LA SESION --}}

@extends('layout/layout_interfaces') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section('Modulo Supervision', 'Actualización del Empleado') {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('ContenidoInterfaces') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="caja3 container p-5" id="contenedor">

        {{-- FOMRULARIO PARA ACTUALIZAR UN EMPLEADO --}}
        
        <form action="{{route('empleado.update', $oldEmp->first()->id_persona)}}" method="POST" enctype="multipart/form-data"
            class="w-100 container from-createEmp bg-transparent">
            @csrf
            @method("PUT")

            <div class="d-flex justify-content-between align-items-center container">
                <h4 class="text-white">Actualizar Empleado</h4>

                {{-- BOTONES DEL FORMULARIO --}}
                @if($bolean == TRUE)
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-3" href="{{route('emp.viewEmp')}}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                @else
                    <div class="d-flex justify-content-end nav-links">
                        <a class="btn btn-danger mx-3" href="{{route('empleado.show', $oldEmp->first()->id_persona)}}">Cancelar</a>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                @endif
    
            </div>
            <hr class="text-white">

            {{-- DETALLES A ACTUALIZAR DEL EMPLEADO --}}

            <div class="d-flex container">
                <div class="mx-5 mt-4">

                    <div class="container mb-5 text-white">
                        <label class="form-label"><b>Fecha de Ingreso:</b></label>
                        <input type="date" class="form-control bg-transparent text-white" 
                        name="fecha_ingreso" value="{{ $oldEmp->first()->fecha_ingreso }}">
                    </div>
                    @error('fecha_ingreso')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="container mb-5">
                        <img src="{{ asset($oldEmp->first()->foto) }}" 
                        style="max-height: 250px; border-radius: 10px; border: 3px solid #ffff;" id="img"/>
                    </div>
    
                    <div class="d-flex justify-content-center container contenedor-btn-file bordeado w-75">
                        <label class="form-label" for="foto">
                            <i class='bx bx-image-add my-1'></i>
                            Actualizar Foto
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
                        name="nombre" placeholder="Nombres" value="{{ $oldEmp->first()->nombre }}">
                    </div>
                    @error('nombre')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
    
                    <div class="mb-3 text-white">
                        <label class="form-label bg-transparent text-white"><b>Apellidos:</b></label>
                        <input type="text" class="form-control bg-transparent text-white" 
                        name="apellido" placeholder="Apellidos" value="{{ $oldEmp->first()->apellido }}">
                    </div>
                    @error('apellido')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
    
                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Cédula:</b></label>
                        <input type="number" class="form-control bg-transparent text-white"
                        name="identificacion" placeholder="Sin Símbolos" value="{{ $oldEmp->first()->identificacion }}">
                    </div>
                    @error('identificacion')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Tipo de Cédula:</b></label>
                        <select class="form-select text-white bg-transparent" name="tipo_identificacion">
                            <option value="Venezolana" {{ $oldEmp->first()->tipo_identificacion == 'Venezolana' ? 'selected' : '' }}>Venezolana</option>
                            <option value="Extranjera" {{ $oldEmp->first()->tipo_identificacion == 'Extranjera' ? 'selected' : '' }}>Extranjera</option>
                        </select>
                    </div>
                    @error('tipo_identificacion')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Fecha de Nacimiento:</b></label>
                        <input type="date" class="form-control bg-transparent text-white" 
                        name="fecha_nacimiento" value="{{ $oldEmp->first()->fecha_nacimiento->format('Y-m-d') }}">
                    </div>
                    @error('fecha_nacimiento')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Dirección:</b></label>
                        <textarea type="text" class="form-control bg-transparent text-white" 
                        placeholder="Dirección de residencia" name="direccion" 
                        rows="4" maxlength="2000">{{ $oldEmp->first()->direccion }}</textarea>
                    </div>
                    @error('direccion')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                </div>

                <div class="detalleEmp mt-3 mx-4 w-50">

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Cargo de Empleado:</b></label> 
                        <select class="form-select text-white bg-transparent" name="cargo_emp">
                            <option value="Gerente" {{ $oldEmp->first()->nombre_car == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                            <option value="Maître" {{ $oldEmp->first()->nombre_car == 'Maître' ? 'selected' : '' }}>Maître</option>
                            <option value="Mesero" {{ $oldEmp->first()->nombre_car == 'Mesero' ? 'selected' : '' }}>Mesero</option>
                            <option value="Bartender" {{ $oldEmp->first()->nombre_car == 'Bartender' ? 'selected' : '' }}>Bartender</option>
                            <option value="Recepcionista" {{ $oldEmp->first()->nombre_car == 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                            <option value="Chef ejecutivo" {{ $oldEmp->first()->nombre_car == 'Chef ejecutivo' ? 'selected' : '' }}>Chef ejecutivo</option>
                            <option value="Jefe de cocina" {{ $oldEmp->first()->nombre_car == 'Jefe de cocina' ? 'selected' : '' }}>Jefe de cocina</option>
                            <option value="Sous chef" {{ $oldEmp->first()->nombre_car == 'Sous chef' ? 'selected' : '' }}>Sous chef</option>
                            <option value="Cocinero" {{ $oldEmp->first()->nombre_car == 'Cocinero' ? 'selected' : '' }}>Cocinero</option>
                            <option value="Asistente de cocina" {{ $oldEmp->first()->nombre_car == 'Asistente de cocina' ? 'selected' : '' }}>Asistente de cocina</option>
                            <option value="Almacenista" {{ $oldEmp->first()->nombre_car == 'Almacenista' ? 'selected' : '' }}>Almacenista</option>
                            <option value="Conserje" {{ $oldEmp->first()->nombre_car == 'Conserje' ? 'selected' : '' }}>Conserje</option>
                            <option value="Repartidor" {{ $oldEmp->first()->nombre_car == 'Repartidor' ? 'selected' : '' }}>Repartidor</option>
                            <option value="Abogado" {{ $oldEmp->first()->nombre_car == 'Abogado' ? 'selected' : '' }}>Abogado</option>
                        </select>
                    </div>
                    @error('cargo_emp')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    
                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Tipo de Empleado:</b></label>
                        <select class="form-select text-white bg-transparent" name="tipo_emp">
                            <option value="Fijo" {{ $oldEmp->first()->tipo_empleado == 'Fijo' ? 'selected' : '' }}>Fijo</option>
                            <option value="Contratado" {{ $oldEmp->first()->tipo_empleado == 'Contratado' ? 'selected' : '' }}>Contratado</option>
                            <option value="A Destajo" {{ $oldEmp->first()->tipo_empleado == 'A Destajo' ? 'selected' : '' }}>A Destajo</option>
                        </select>
                    </div>
                    @error('tipo_emp')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Horario del Empleado:</b></label>
                        <p>(Para Abogado marque "No Aplica")</p> 
                        <select class="form-select text-white bg-transparent" name="nombre_horario">
                            <option value="Mañana" {{ $oldEmp->first()->nombre_horario == 'Mañana' ? 'selected' : '' }}>Mañana</option>
                            <option value="Tarde/Noche" {{ $oldEmp->first()->nombre_horario == 'Tarde/Noche' ? 'selected' : '' }}>Tarde/Noche</option>
                            <option value="Completo" {{ $oldEmp->first()->nombre_horario == 'Completo' ? 'selected' : '' }}>Completo</option>
                            <option value="No Aplica" {{ $oldEmp->first()->nombre_horario == 'No Aplica' ? 'selected' : '' }}>No Aplica</option>
                        </select>
                    </div>
                    @error('nombre_horario')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Teléfono Celular:</b></label>
                        <input type="text" class="form-control bg-transparent text-white" 
                        name="tlf_celular" placeholder="Celular" value="{{ $oldEmp->first()->tlf_celular }}">
                    </div>
                    @error('tlf_celular')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                
                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Teléfono Local:</b></label>
                        <input type="text" class="form-control bg-transparent text-white" 
                        name="tlf_local" placeholder="Local" value="{{ $oldEmp->first()->tlf_local }}">
                    </div>
                    @error('tlf_local')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 text-white">
                        <label class="form-label"><b>Género:</b></label>
                        <select class="form-select text-white bg-transparent" name="genero">
                            <option value="Masculino" {{ $oldEmp->first()->nombre_genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ $oldEmp->first()->nombre_genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>
                    @error('genero')
                        <div class="alert alert-danger mt-3">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

        </form>

        <hr class="text-white">
    </div>

@endsection
