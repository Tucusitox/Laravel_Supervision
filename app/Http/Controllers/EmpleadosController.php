<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Empleado;
use App\Models\HorariosXEmpleado;
use App\Models\Asistencia;
use App\Models\Eventualidade;
use App\Models\EmpleadosXEventualidade;
use App\Models\Evaluacione;
use App\Models\EmpleadosXEvaluacione;
use App\Models\EvaluacionesXItemsemp;


class EmpleadosController
{
    // VISTA CON EL FORMULARIO PARA CREAR EMPLEADOS

    public function index()
    {
        return view("viewsEmps/crearEmp");
    }

    // CREAR UN NUEVO EMPLEADO

    public function store(Request $request)
    {
        // VALIDAR LOS DATOS DE LOS FORMULARIOS
        $request->validate(
            [
                'foto' => 'required|image|max:2024',

                'tipo_identificacion' => 'required|in:Venezolana,Extranjera,Jurídica',

                'identificacion' => 'required|string|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',

                'nombre' => 'required|string|regex:/^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/',

                'apellido' => 'required|string|regex:/^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/',

                'direccion' => 'required|string|min:30|max:150',

                'fecha_nacimiento' => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',

                'tlf_celular' => 'required|string|regex:/^0\d{10}$/',

                'tlf_local' => 'required|string|regex:/^0\d{10}$/',

                'genero' => 'required|in:Masculino,Femenino',

                'fecha_ingreso' => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',

                'tipo_emp' => 'required|in:Fijo,Contratado,A Destajo',

                'cargo_emp' => 'required|in:Gerente,Maître,Mesero,Bartender,Recepcionista,Chef ejecutivo,Jefe de cocina,Sous chef,Cocinero,Asistente de cocina,Almacenista,Conserje,Repartidor,Abogado',

                'nombre_horario' => 'required|in:Mañana,Tarde/Noche,Completo,No Aplica',
            ]);

        // CAPTURAR LA IMAGEN DEL FORM PARA LA TABLA PERSONAS
        $persona = new Persona();

        if ($request->hasFile("foto")) {
            $foto = $request->file("foto");
            $destinoCarpeta = "img/fotosEmps";
            $rutaImg = "/" . $foto->getClientOriginalName();
            $request->file("foto")->move($destinoCarpeta,$rutaImg);

            $persona->foto = $destinoCarpeta.$rutaImg; //DEFINIMOS LA RUTA DE LA IMAGEN
        };


        $cedulaExis = Persona::select("identificacion")
        ->where("identificacion","=",$request->post('identificacion'))
        ->get();

        if($cedulaExis->isNotEmpty()){
            return back()->withErrors([
                'identificacion' => '¡La cédula ingresadasda ya se encuentra registrada en el sistema!'
            ]);
        }
        else{
            $persona->identificacion = $request->post('identificacion');
        }

        // CAPTURAR DATOS DEL FORM PARA LA TABLA PERSONAS
        $persona->nombre = $request->post('nombre');
        $persona->apellido = $request->post('apellido');
        $persona->direccion = $request->post('direccion');
        $persona->tlf_celular = $request->post('tlf_celular');
        $persona->tlf_local = $request->post('tlf_local');

        // EVALUAR SI EL EMPLEADO ES MAYOR DE EDAD

        $fecha_actual = date('Y-m-d');

        $edad = date_diff(date_create($request->post('fecha_nacimiento')), date_create($fecha_actual))->y;
        if ($edad >= 18) {
            $persona->fecha_nacimiento = $request->post('fecha_nacimiento');
        } else {
            return back()->withErrors([
                'fecha_nacimiento' => '¡El empleado debe ser mayor de edad!'
            ]);
        }
        
        // CAPTURAR EL GENERO DEL EMPLEADO
        $arrayGeneros = [
            "Masculino" => 1,
            "Femenino" => 2,
        ];
        $genero = $request->post('genero');
        if (array_key_exists($genero, $arrayGeneros)) {
            $persona->fk_genero = $arrayGeneros[$genero];
        }

        // VALIDACION DE LA CEDULA V o E
        $arrayTiposIdentificacion = [
            "Venezolana" => 1,
            "Extranjera" => 2,
        ];
        $tipoIdentificacion = $request->post('tipo_identificacion');
        if (array_key_exists($tipoIdentificacion, $arrayTiposIdentificacion)) {
            $persona->fk_tipoIde = $arrayTiposIdentificacion[$tipoIdentificacion];
        }

        // REALIZAR INSERSION EN TABLA PERSONAS
        $persona->save();

        // VALIDAR EL GUARDADO EN LA TABLA PERSONAS
        if($persona->save()){

            // CAPTURAR EL ULTIMO ID GENERADO EN LA TABLA PERSONAS
            $ultimoRegistro = Persona::orderBy('id_persona', 'desc')->first();
            $idPersona = $ultimoRegistro->id_persona;


            // CAPTURAR DATOS DEL FORM PARA LA TABLA EMPLEADOS
            $empleado = new Empleado();
            $empleado->fk_persona = $idPersona;

            // CAPTURAR EL TIPO DE EMPLEADO
            $arrayTiposEmpleados = [
                "Fijo" => 1,
                "Contratado" => 2,
                "A Destajo" => 3,
            ];
            $tipoEmp = $request->post('tipo_emp');
            if (array_key_exists($tipoEmp, $arrayTiposEmpleados)) {
                $empleado->fk_tipo_emp = $arrayTiposEmpleados[$tipoEmp];
            }

            // CAPTURAR EL CARGO DEL EMPELADO
            $arrayCargos = [
                "Gerente" => 1,
                "Maître" => 2,
                "Mesero" => 3,
                "Bartender" => 4,
                "Recepcionista" => 5,
                "Cheft ejecutivo" => 6,
                "Jefe de cocina" => 7,
                "Sous chef" => 8,
                "Cocinero" => 9,
                "Asistente de cocina" => 10,
                "Almacenista" => 11,
                "Conserje" => 12,
                "Repartidor" => 13,
                "Abogado" => 14,
            ];
            
            $cargoEmp = $request->post('cargo_emp');
            if (array_key_exists($cargoEmp, $arrayCargos)) {
                $empleado->fk_cargo = $arrayCargos[$cargoEmp];
            }

            $empleado->estado_laboral = "Activo";
            $empleado->fecha_ingreso = $request->post('fecha_ingreso');
            $empleado->fecha_egreso = NULL;

            // REALIZAR INSERSION EN TABLA EMPLEADOS
            $empleado->save();
        }

        // VALIDAR EL GUARDADO EN LA TABLA EMPLEADOS

        if($empleado->save()){

            // CAPTURAR EL ULTIMO ID GENERADO EN LA TABLA EMPLEADOS
            $ultimoRegistro = Empleado::orderBy('id_empleado', 'desc')->first();
            $idEmpleado = $ultimoRegistro->id_empleado;

            // CAPTURAR DATOS DEL FORM PARA LA TABLA HORARIOS_X_EMPLEADOS

            $horarioEmp = new HorariosXEmpleado();
            $horarioEmp ->fk_empleado = $idEmpleado;

            // CREAMOS UN ARRAY ASOCIATIVO PARA MAPEARLO
            $arrayHorarios = [
                "Mañana" => 1,
                "Tarde/Noche" => 2,
                "Completo" => 3,
                "No Aplica" => 4,
            ];

            // ASIGNACION DEL HORARIO
            $nombreHorario = $request->post('nombre_horario');
            if (array_key_exists($nombreHorario, $arrayHorarios)) {
                $horarioEmp->fk_horario = $arrayHorarios[$nombreHorario];
            }

            // REALIZAR INSERSION EN TABLA HORARIOS_X_EMPLEADOS
            $horarioEmp->save();

            // SI TODO SALE BIEN REDIRECCIONAR A LA VISTA resumenEmps
            if($horarioEmp->save()){
                return redirect()->route('emp.viewEmp')->with("success", "¡Empleado Registrado con Éxito!");
            }
        }
    }

    // OBTENER LOS DATOS DE UN SOLO EMPLEADO
    public function show($id_persona)
    {
        $bolean = TRUE;
        $detallEmp = Persona::select("id_persona","tipo_identificacion","identificacion","foto","nombre","apellido",
                    "fecha_nacimiento","direccion","tlf_celular","tlf_local","nombre_car","nombre_espacio",
                    "tipo_empleado","nombre_horario","descripcion_horario","estado_laboral","fecha_ingreso",
                    "fecha_egreso","nombre_genero")
        ->selectRaw("TIMESTAMPDIFF(YEAR, fecha_nacimiento, NOW()) AS edad_empleado")
        ->join("empleados", "empleados.fk_persona","=","personas.id_persona")
        ->join("tipos_emps", "tipos_emps.id_tipo_emp","=","empleados.fk_tipo_emp")
        ->join("cargos", "cargos.id_cargo","=","empleados.fk_cargo")
        ->join("espacios", "espacios.id_espacio","=","cargos.fk_espacio")
        ->join("horarios_x_empleados", "horarios_x_empleados.fk_empleado","=","empleados.id_empleado")
        ->join("horarios", "horarios_x_empleados.fk_horario","=","horarios.id_horario")
        ->join("tipos_identificaciones", "tipos_identificaciones.id_tipoIde","=","personas.fk_tipoIde")
        ->join("generos", "generos.id_genero","=","personas.fk_genero")
        ->where("id_persona","=", $id_persona)
        ->get();

        return view("viewsEmps.detallesEmp",compact("detallEmp","bolean"));
    }

    // OBTENER EL ID Y DATOS DEL EMPLEADO A ACTUALIZAR DESDE RESUMEN DE EMPLEADOS

    public function editDesdeResum($id_persona)
    {
        $bolean = TRUE;
        $oldEmp = Persona::select("id_persona","tipo_identificacion","identificacion","foto","nombre","apellido",
                "fecha_nacimiento","direccion","tlf_celular","tlf_local","nombre_car","nombre_espacio",
                "tipo_empleado","nombre_horario","descripcion_horario","estado_laboral","fecha_ingreso",
                "fecha_egreso","nombre_genero")
        ->join("empleados", "empleados.fk_persona","=","personas.id_persona")
        ->join("tipos_emps", "tipos_emps.id_tipo_emp","=","empleados.fk_tipo_emp")
        ->join("cargos", "cargos.id_cargo","=","empleados.fk_cargo")
        ->join("espacios", "espacios.id_espacio","=","cargos.fk_espacio")
        ->join("horarios_x_empleados", "horarios_x_empleados.fk_empleado","=","empleados.id_empleado")
        ->join("horarios", "horarios_x_empleados.fk_horario","=","horarios.id_horario")
        ->join("tipos_identificaciones", "tipos_identificaciones.id_tipoIde","=","personas.fk_tipoIde")
        ->join("generos", "generos.id_genero","=","personas.fk_genero")
        ->where("id_persona","=", $id_persona)
        ->get();

        return view('viewsEmps.updateEmp', compact('oldEmp',"bolean"));
    }

    // OBTENER EL ID Y DATOS DEL EMPLEADO A ACTUALIZAR DESDE DETALLES DEL EMPLEADO
    
    public function edit($id_persona)
    {
        $oldEmp = Persona::select("id_persona","tipo_identificacion","identificacion","foto","nombre","apellido",
                "fecha_nacimiento","direccion","tlf_celular","tlf_local","nombre_car","nombre_espacio",
                "tipo_empleado","nombre_horario","descripcion_horario","estado_laboral","fecha_ingreso",
                "fecha_egreso","nombre_genero")
        ->join("empleados", "empleados.fk_persona","=","personas.id_persona")
        ->join("tipos_emps", "tipos_emps.id_tipo_emp","=","empleados.fk_tipo_emp")
        ->join("cargos", "cargos.id_cargo","=","empleados.fk_cargo")
        ->join("espacios", "espacios.id_espacio","=","cargos.fk_espacio")
        ->join("horarios_x_empleados", "horarios_x_empleados.fk_empleado","=","empleados.id_empleado")
        ->join("horarios", "horarios_x_empleados.fk_horario","=","horarios.id_horario")
        ->join("tipos_identificaciones", "tipos_identificaciones.id_tipoIde","=","personas.fk_tipoIde")
        ->join("generos", "generos.id_genero","=","personas.fk_genero")
        ->where("id_persona","=", $id_persona)
        ->get();

        $bolean = FALSE;

        return view('viewsEmps.updateEmp', compact('oldEmp',"bolean"));

    }

    // ACTUALIZAR LA INFORMACION DEL EMPLEADO
    public function update(Request $request, $id_persona)
    {
        // VALIDAR LOS DATOS DE LOS FORMULARIOS

        $request->validate(
            [
                'foto' => 'image|max:2024',

                'tipo_identificacion' => 'required|in:Venezolana,Extranjera,Jurídica',

                'identificacion' => 'required|string|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',

                'nombre' => 'required|string|regex:/^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/',

                'apellido' => 'required|string|regex:/^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/',

                'direccion' => 'required|string|min:30|max:150',

                'fecha_nacimiento' => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',

                'tlf_celular' => 'required|string|regex:/^0\d{10}$/',

                'tlf_local' => 'required|string|regex:/^0\d{10}$/',

                'genero' => 'required|in:Masculino,Femenino',

                'fecha_ingreso' => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',

                'tipo_emp' => 'required|in:Fijo,Contratado,A Destajo',

                'cargo_emp' => 'required|in:Gerente,Maître,Mesero,Bartender,Recepcionista,Chef ejecutivo,Jefe de cocina,Sous chef,Cocinero,Asistente de cocina,Almacenista,Conserje,Repartidor,Abogado',

                'nombre_horario' => 'required|in:Mañana,Tarde/Noche,Completo,No Aplica',
            ]);
        
        // INVOCAR AL MODELO PERSONAS DE LA TABLA PERSONAS
        $persona = Persona::find($id_persona);

        // EVALUAR SI EL EMPLEADO ES MAYOR DE EDAD

        $fecha_actual = date('Y-m-d');

        $edad = date_diff(date_create($request->post('fecha_nacimiento')), date_create($fecha_actual))->y;
        if ($edad >= 18) {
            $persona->fecha_nacimiento = $request->post('fecha_nacimiento');
        } else {

            return back()->withErrors([
                'fecha_nacimiento' => '¡El empleado debe ser mayor de edad!'
            ]);
        }

        // CAPTURAR LA IMAGEN DEL FORM PARA LA TABLA PERSONAS

        if ($request->hasFile("foto")) {
            $foto = $request->file("foto");
            $destinoCarpeta = "img/fotosEmps";
            $rutaImg = "/" . $foto->getClientOriginalName();
            $request->file("foto")->move($destinoCarpeta,$rutaImg);
            // CAPTURAR LA RUTA DE LA IMAGEN ANTERIO
            $rutaImagenAnterior = $persona->foto;

            if($rutaImagenAnterior){
                // ELIMINAR LA RUTA DE LA IMG ANTERIOR PARA AHORRAR ESPACIO
                unlink($rutaImagenAnterior);
            }
            $persona->foto = $destinoCarpeta.$rutaImg;
        };

        // CAPTURAR DATOS DEL FORM PARA LA TABLA PERSONAS

        $persona->identificacion = $request->post('identificacion');
        $persona->nombre = $request->post('nombre');
        $persona->apellido = $request->post('apellido');
        $persona->direccion = $request->post('direccion');
        $persona->tlf_celular = $request->post('tlf_celular');
        $persona->tlf_local = $request->post('tlf_local');

        // CAPTURAR EL GENERO DEL EMPLEADO
        $arrayGeneros = [
            "Masculino" => 1,
            "Femenino" => 2,
        ];
        $genero = $request->post('genero');
        if (array_key_exists($genero, $arrayGeneros)) {
            $persona->fk_genero = $arrayGeneros[$genero];
        }

        // VALIDACION DE LA CEDULA V o E
        $arrayTiposIdentificacion = [
            "Venezolana" => 1,
            "Extranjera" => 2,
        ];
        $tipoIdentificacion = $request->post('tipo_identificacion');
        if (array_key_exists($tipoIdentificacion, $arrayTiposIdentificacion)) {
            $persona->fk_tipoIde = $arrayTiposIdentificacion[$tipoIdentificacion];
        }

        // REALIZAR UPDATE EN TABLA PERSONAS
        $persona->save();

        // VALIDAR EL GUARDADO EN LA TABLA PERSONAS
        if($persona->save()){

            $empleado = Empleado::find($id_persona);

            // CAPTURAR EL TIPO DE EMPLEADO
            $arrayTiposEmpleados = [
                "Fijo" => 1,
                "Contratado" => 2,
                "A Destajo" => 3,
            ];
            $tipoEmp = $request->post('tipo_emp');
            if (array_key_exists($tipoEmp, $arrayTiposEmpleados)) {
                $empleado->fk_tipo_emp = $arrayTiposEmpleados[$tipoEmp];
            }

            // CAPTURAR EL CARGO DEL EMPELADO
            $arrayCargos = [
                "Gerente" => 1,
                "Maître" => 2,
                "Mesero" => 3,
                "Bartender" => 4,
                "Recepcionista" => 5,
                "Cheft ejecutivo" => 6,
                "Jefe de cocina" => 7,
                "Sous chef" => 8,
                "Cocinero" => 9,
                "Asistente de cocina" => 10,
                "Almacenista" => 11,
                "Conserje" => 12,
                "Repartidor" => 13,
                "Abogado" => 14,
            ];
            
            $cargoEmp = $request->post('cargo_emp');
            if (array_key_exists($cargoEmp, $arrayCargos)) {
                $empleado->fk_cargo = $arrayCargos[$cargoEmp];
            }

            $empleado->fecha_ingreso = $request->post('fecha_ingreso');
            $empleado->estado_laboral = "Activo";
            $empleado->fecha_egreso = NULL;

            // REALIZAR UPDATE EN TABLA EMPLEADOS
            $empleado->save();
        }

        // VALIDAR EL GUARDADO EN LA TABLA EMPLEADOS

        if($empleado->save()){

            // CAPTURAR DATOS DEL FORM PARA LA TABLA HORARIOS_X_EMPLEADOS
            $horarioEmp = HorariosXEmpleado::find($id_persona);

            // CREAMOS UN ARRAY ASOCIATIVO PARA MAPEARLO
            $arrayHorarios = [
                "Mañana" => 1,
                "Tarde/Noche" => 2,
                "Completo" => 3,
                "No Aplica" => 4,
            ];

            // ASIGNACION DEL HORARIO
            $nombreHorario = $request->post('nombre_horario');
            if (array_key_exists($nombreHorario, $arrayHorarios)) {
                $horarioEmp->fk_horario = $arrayHorarios[$nombreHorario];
            }

            // REALIZAR ACTUALIZACIÓN EN LA TABLA HORARIOS_X_EMPLEADOS
            $horarioEmp->save();

            // SI TODO SALE BIEN REDIRECCIONAR A LA VISTA resumenEmps
            if($horarioEmp->save()){
                return redirect()->route('empleado.show', $id_persona)->with("success", "¡Actualizado con Éxito!");
            }
        }
    }

    // CAMBIAR EL ESTATUS A "INACTIVO" DEL EMPLEADO

    public function changeEstatus($id_persona)
    {
        // INVOCAR AL MODELO PERSONAS DE LA TABLA PERSONAS
        $empleado = Empleado::find($id_persona);
        $empleado->estado_laboral = "Inactivo";
        $empleado->fecha_egreso = now()->setTimezone('America/Caracas');
        $empleado->save();
        return redirect()->route('empleado.show', $id_persona)->with("success", "¡Empleado Inactivo!");

    }

    // CAMBIAR EL ESTATUS A "ACTIVO" DEL EMPLEADO

    public function statusActivo($id_persona)
    {
        //INVOCAR AL MODELO PERSONAS DE LA TABLA PERSONAS
        $empleado = Empleado::find($id_persona);
        $empleado->estado_laboral = "Activo";
        $empleado->fecha_ingreso = now()->setTimezone('America/Caracas')->format('Y-m-d');
        $empleado->fecha_egreso = NULL;
        $empleado->save();
        return redirect()->route('empleado.show', $id_persona)->with("success", "¡Empleado nuevamente Activo!");
    }

    // IR A LA VISTA DE DELETE EMPLEADO DESDE RESUMEN EMPLEADO

    public function viewDeleteEmp1($id_persona)
    {
        $deletEmp = Persona::select("id_persona")
            ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
            ->where("id_persona", "=", $id_persona)  
            ->get();

        $bolean = TRUE;
        return view("viewsEmps.deleteEmp", compact("deletEmp", "bolean"));
    }

    // IR A LA VISTA DE DELETE EMPLEADO DESDE DETALLES

    public function viewDeleteEmp2($id_persona)
    {
        $deletEmp = Persona::select("id_persona")
            ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
            ->where("id_persona","=", $id_persona)  
            ->get();
        
        $bolean = FALSE;
        return view("viewsEmps.deleteEmp", compact("deletEmp","bolean"));
    }

    // ELIMINAR PERMANENTEMENTE AL EMPLEADO DE LA BASE DE DATOS
    
    public function destroy($id_persona)
    {
        // CAPTURAR LOPS REGISTROS A ELIMINAR CON LOS SIGUIENTES MODELOS
        $persona = Persona::find($id_persona);
        $empleado = Empleado::find($id_persona);
        $horarioEmp = HorariosXEmpleado::find($id_persona);
        $asistencia = Asistencia::where("fk_empleado", $id_persona);

        $eventEmp = EmpleadosXEventualidade::select("id_empleadoEvent")->where("fk_empleado", $id_persona);
        $permisosEmp = Eventualidade::select("id_eventualidad")
        ->join("empleados_x_eventualidades","empleados_x_eventualidades.fk_eventualidad","=","eventualidades.id_eventualidad")
        ->where("fk_empleado", $id_persona);

        $notasEmp = EvaluacionesXItemsemp::select("id_eval_itemEmp")
        ->join("evaluaciones","evaluaciones_x_itemsEmps.fk_evaluacion","=","evaluaciones.id_evaluacion")
        ->join("empleados_x_evaluaciones","empleados_x_evaluaciones.fk_evaluacion","=","evaluaciones.id_evaluacion")
        ->where("fk_empleado", $id_persona);

        $empsEvals = EmpleadosXEvaluacione::select("id_empEval")
        ->where("fk_empleado", $id_persona);

        $evaluacionesEmp = Evaluacione::select("id_evaluacion")
        ->join("empleados_x_evaluaciones","empleados_x_evaluaciones.fk_evaluacion","=","evaluaciones.id_evaluacion")
        ->where("fk_empleado", $id_persona);

        // REALIZAR EL DELETE EN LAS TABLAS DE LA BASE DE DATOS
        $notasEmp->delete();
        $empsEvals->delete();
        $evaluacionesEmp->delete();
        $eventEmp->delete();
        $permisosEmp->delete();
        $horarioEmp->delete();
        $asistencia->delete();
        $empleado->delete();
        $persona->delete();

        // SI TODO SALE BIEN REDIRECCIONAR A LA VISTA resumenEmps
        return redirect()->route('emp.viewEmp')->with("success", "¡Empleado Eliminado del Sistema con Éxito!");
    }
}
