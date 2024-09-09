<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

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
        if($request->post('buscarUnEmp')){

            $cedula = $request->post('buscarUnEmp');

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
            
                if($detallEmp->isNotEmpty()) {
                    $bolean = TRUE;
                    return view("viewsEmps.detallesEmp", compact("detallEmp","bolean"));
                } 
                else{
                    toastr()->error("¡Empleado Inactivo! Búscalo en la Sección de Empleados Inactivos");
                    return redirect()->back();
                }
            }
            else{
                toastr()->error("¡Este Empleado no existe en el Sistema!");
                return redirect()->back();
            }
        }
        else{
            toastr()->error("¡Ingrese un valor en el Campo para Continuar!");
            return redirect()->back();
        }
    }

}
