<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Eventualidade;
use App\Models\EvaluacionesXItemsemp;
use Illuminate\Support\Facades\DB;

class ViewsController
{
    public function index()
    {
        return view("welcome");
    }

    // CONSULTA GENERAL PARA LA VISTA RESUMEN DE EMPLEADOS

    public function viewEmp()
    {
        $datos = Persona::select("id_persona","identificacion","nombre_car","estado_laboral","nombre_espacio")
        ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
        ->join("empleados", "empleados.fk_persona","=","personas.id_persona")
        ->join("tipos_emps", "tipos_emps.id_tipo_emp","=","empleados.fk_tipo_emp")
        ->join("cargos", "cargos.id_cargo","=","empleados.fk_cargo")
        ->join("espacios", "espacios.id_espacio","=","cargos.fk_espacio")
        ->where("estado_laboral","=","Activo")
        ->orderBy("nombre","asc")
        ->get();
        
        return view("viewsEmps/resumenEmps", compact("datos"));
    }

    // VISTA PARA CAMBIAR EL ESTATUS A "ACTIVO" DEL EMPLEADO

    public function activo($id_persona)
    {
        $empInactivo = Persona::select("id_persona","identificacion","estado_laboral")
            ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
            ->join("empleados", "empleados.fk_persona","=","personas.id_persona")
            ->where("id_persona","=", $id_persona)  
            ->get();   

        return view("viewsEmps.estatusActivo", compact("empInactivo"));
    }

    // CONSULTA GENERAL PARA LA VISTA DE EMPELADOS INACTIVOS

    public function empsInactivos()
    {
        $empInactivo = Persona::select("id_persona","identificacion","estado_laboral")
        ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
        ->join("empleados", "empleados.fk_persona","=","personas.id_persona")
        ->where("estado_laboral","=","Inactivo")
        ->orderBy("nombre","asc")
        ->get();
        
        return view("viewsEmps.empsInactivos", compact("empInactivo"));
    }

    // BUSQUEDA POR CEDULA DEL EMPLEADO

    public function findUnEmp(Request $request)
    {
        $bolean = TRUE;
        $cedula = $request->post('buscarUnEmp');
        
        if(preg_match('/^[0-9]{2}[0-9]{3}[0-9]{3}$/', $cedula)){

            $empExist = Persona::join("empleados", "empleados.fk_persona","=","personas.id_persona")
            ->where("identificacion","=", $cedula)  
            ->get();

            if($empExist->isNotEmpty()){

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
                ->where("identificacion","=", $cedula)  
                ->where("estado_laboral","=", "Activo")  
                ->get();

                $notasEmp = EvaluacionesXItemsemp::select("codigo_eval","fecha_evaluacion")
                ->selectRaw('
                        MAX(CASE WHEN rn = 1 THEN nota_itemEmpleado END) AS nota1,
                        MAX(CASE WHEN rn = 2 THEN nota_itemEmpleado END) AS nota2,
                        MAX(CASE WHEN rn = 3 THEN nota_itemEmpleado END) AS nota3,
                        MAX(CASE WHEN rn = 4 THEN nota_itemEmpleado END) AS nota4,
                        MAX(CASE WHEN rn = 5 THEN nota_itemEmpleado END) AS nota5,
                        SUM(nota_itemEmpleado) AS suma_notas
                ')
                ->from(DB::raw('(SELECT fk_evaluacion, nota_itemEmpleado, ROW_NUMBER() OVER (PARTITION BY fk_evaluacion ORDER BY id_eval_itemEmp) AS rn FROM evaluaciones_x_itemsemps) AS subquery'))
                ->groupBy('subquery.fk_evaluacion')
                ->join("evaluaciones", "evaluaciones.id_evaluacion", "=", "subquery.fk_evaluacion")
                ->join("empleados_x_evaluaciones", "empleados_x_evaluaciones.fk_evaluacion", "=", "evaluaciones.id_evaluacion")
                ->join("empleados", "empleados_x_evaluaciones.fk_empleado", "=", "empleados.id_empleado")
                ->join("personas", "empleados.fk_persona", "=", "personas.id_persona")
                ->where("identificacion","=", $cedula)  
                ->get();

                $permisosEmp = Eventualidade::select("codigo_event","asunto_event","descripcion_event",
                                                    "fecha_inicioEvent","fecha_finEvent","fechaCreacion_event")
                ->join("empleados_x_eventualidades","empleados_x_eventualidades.fk_eventualidad","=","eventualidades.id_eventualidad")
                ->join("empleados","empleados.id_empleado","=","empleados_x_eventualidades.fk_empleado")
                ->join("personas","personas.id_persona","=","empleados.fk_persona")
                ->where("identificacion","=", $cedula)  
                ->get();
            
                if($detallEmp->isNotEmpty()) {
                    return view("viewsEmps.detallesEmp",compact("detallEmp","notasEmp","permisosEmp","bolean"));
                } 
                else{
                    toastr()->info("¡Empleado Inactivo! Búscalo en la Sección de Empleados Inactivos!");
                    return redirect()->back();
                }
            }else{
                toastr()->error("¡Este Empleado no existe en el Sistema!");
                return redirect()->back();
            }
        }
        else{
            toastr()->warning("¡El Formato de la Cédula es Incorrecto!");
            return redirect()->back();
        }
    }

    // IR A DETALLES EMPLEADOS DESDE EMPLEADOS INACTIVOS
    public function empInactDetall($id_persona)
    {
        $bolean = "inactivo";
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

        $notasEmp = EvaluacionesXItemsemp::select("codigo_eval","fecha_evaluacion")
        ->selectRaw('
                MAX(CASE WHEN rn = 1 THEN nota_itemEmpleado END) AS nota1,
                MAX(CASE WHEN rn = 2 THEN nota_itemEmpleado END) AS nota2,
                MAX(CASE WHEN rn = 3 THEN nota_itemEmpleado END) AS nota3,
                MAX(CASE WHEN rn = 4 THEN nota_itemEmpleado END) AS nota4,
                MAX(CASE WHEN rn = 5 THEN nota_itemEmpleado END) AS nota5,
                SUM(nota_itemEmpleado) AS suma_notas
        ')
        ->from(DB::raw('(SELECT fk_evaluacion, nota_itemEmpleado, ROW_NUMBER() OVER (PARTITION BY fk_evaluacion ORDER BY id_eval_itemEmp) AS rn FROM evaluaciones_x_itemsemps) AS subquery'))
        ->groupBy('subquery.fk_evaluacion')
        ->join("evaluaciones", "evaluaciones.id_evaluacion", "=", "subquery.fk_evaluacion")
        ->join("empleados_x_evaluaciones", "empleados_x_evaluaciones.fk_evaluacion", "=", "evaluaciones.id_evaluacion")
        ->join("empleados", "empleados_x_evaluaciones.fk_empleado", "=", "empleados.id_empleado")
        ->join("personas", "empleados.fk_persona", "=", "personas.id_persona")
        ->where("id_persona","=", $id_persona)
        ->get();

        $permisosEmp = Eventualidade::select("codigo_event","asunto_event","descripcion_event",
                                            "fecha_inicioEvent","fecha_finEvent","fechaCreacion_event")
        ->join("empleados_x_eventualidades","empleados_x_eventualidades.fk_eventualidad","=","eventualidades.id_eventualidad")
        ->join("empleados","empleados.id_empleado","=","empleados_x_eventualidades.fk_empleado")
        ->join("personas","personas.id_persona","=","empleados.fk_persona")
        ->where("id_persona","=", $id_persona)
        ->get();
        
        return view("viewsEmps.detallesEmp",compact("detallEmp","notasEmp","permisosEmp","bolean"));
    }

}
