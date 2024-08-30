<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Eventualidade;
use App\Models\EmpleadosXEventualidade;
use Illuminate\Http\Request;
use Mockery\Undefined;

class PermisosController
{
    // VER TODOS LOS PERMISOS CREADOS
    public function index()
    {
        $permisos = Eventualidade::select("id_persona","codigo_event","identificacion","asunto_event",
                                          "descripcion_event","fecha_inicioEvent","fecha_finEvent",
                                          "fechaCreacion_event")
        ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
        ->join("empleados_x_eventualidades","empleados_x_eventualidades.fk_eventualidad","=","eventualidades.id_eventualidad")
        ->join("empleados","empleados.id_empleado","=","empleados_x_eventualidades.fk_empleado")
        ->join("personas","personas.id_persona","=","empleados.fk_persona")
        ->orderBy("fechaCreacion_event","desc")
        ->get();

        $bolean = TRUE;
        return view("viewsEmps.permisosResumen", compact("permisos","bolean"));
    }

    // BUSCAR UN PERMISO POR EL CODIGO
    public function buscarCodigo(Request $request)
    {
        $request->validate([
            "buscarCodigo" => "required|regex:/^P-\d{4}$/"
        ]);

        $codigoPermiso = $request->post("buscarCodigo"); 
        $permisos = Eventualidade::select("codigo_event","identificacion","asunto_event","descripcion_event",
                                          "fecha_inicioEvent","fecha_finEvent","fechaCreacion_event")
        ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
        ->join("empleados_x_eventualidades","empleados_x_eventualidades.fk_eventualidad","=","eventualidades.id_eventualidad")
        ->join("empleados","empleados.id_empleado","=","empleados_x_eventualidades.fk_empleado")
        ->join("personas","personas.id_persona","=","empleados.fk_persona")
        ->where("codigo_event","=",$codigoPermiso)
        ->get();

        $bolean = FALSE;

        return view("viewsEmps.permisosResumen", compact("permisos","bolean"));
    }

    // CREEAR PERMISO DESDE VISTA DETALLES EMPLEADOS
    public function show($id_persona)
    {
        $ciEmp = Persona::select("id_persona","identificacion")
        ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
        ->where("id_persona",$id_persona)
        ->get();

        return view("viewsEmps.crearPermiso", compact("ciEmp"));       
    }

    // CREEAR PERMISO DESDE VISTA RESUMEN PERMISOS
    public function create()
    {
        $ciEmp = NULL;
        return view("viewsEmps.crearPermiso", compact("ciEmp"));             
    }

    // CREAR UN PERMISO PARA UN EMPELADO

    public function store(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|string|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',
            'permiso_asunto' => 'required|in:Reposo Médico,Maternidad,Lactancia,Matrimonio,Mudanza,Asuntos Personales,Otros',
            "permiso_descripcion" => "required|string",
            "fecha_inicioEvent" => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',
            "fecha_finEvent" => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',
        ]);

        // CREAR EL CODIGO DEL PERMISO
        $numeroAleatorio = rand(1000, 9999);
        $codigoEvent = "P-".$numeroAleatorio;
        
        // CAPTURAR EL ID DEL EMPLEADO
        $cedulaEmp = $request->post("identificacion");
        $idEmp = Persona::select("id_persona")
            ->where("identificacion","=",$cedulaEmp)
            ->get();
        
        if($idEmp->isNotEmpty()){

            $permiso = new Eventualidade;
            $permiso->fk_tipoEvent = 1;
            $permiso->fk_tipoEstatusEvent = 4;
            $permiso->codigo_event = $codigoEvent;

            // CAPTURAR EL TIPO DE PERMISO INDICADO POR LE USUARIO
            
            if ($request->post("permiso_asunto") == "Reposo Médico") {

                $permiso->asunto_event = 'Reposo Médico';
            } 
            if ($request->post("permiso_asunto") == "Maternidad") {

                $permiso->asunto_event = 'Maternidad';
            } 
            if ($request->post("permiso_asunto") == "Lactancia") {

                $permiso->asunto_event = 'Lactancia';
            } 
            if ($request->post("permiso_asunto") == "Matrimonio") {

                $permiso->asunto_event = 'Matrimonio';
            } 
            if ($request->post("permiso_asunto") == "Mudanza") {

                $permiso->asunto_event = 'Mudanza';
            } 
            if ($request->post("permiso_asunto") == "Asuntos Personales") {

                $permiso->asunto_event = 'Asuntos Personales';
            } 
            if ($request->post("permiso_asunto") == "Salida Temprana") {

                $permiso->asunto_event = 'Salida Temprana';
            }

            $permiso->descripcion_event = $request->post("permiso_descripcion");
            $permiso->fecha_inicioEvent = $request->post("fecha_inicioEvent");
            $permiso->fecha_finEvent = $request->post("fecha_finEvent");
            $permiso->fechaCreacion_event = NOW();
            $permiso->save();

            if($permiso->save()){

                // CAPTURAR EL ULTIMO ID GENERADO EN LA TABLA PERSONAS
                $ultimoRegistro = Eventualidade::orderBy('id_eventualidad', 'desc')->first();
                $idEvent = $ultimoRegistro->id_eventualidad;

                // INSERT EN LA TABLA "empleados_x_eventualidades"
                $empXevent = new EmpleadosXEventualidade;
                $empXevent->fk_empleado = $idEmp->first()->id_persona;
                $empXevent->fk_eventualidad = $idEvent;
                $empXevent->save();

                return redirect()->route('permisos.index')->with("success", "¡Permiso Registrado con Éxito!");
            }
        }
        else{
            return redirect()->back()->withErrors([
                'identificacion' => '¡Este Empleado no existe en el Sistema!'
            ]);
        }
    }

    // IR A DETALLES DE EMPLEADOS DESDE PERMISOS
    public function permisoEmp($id_persona)
    {
        $bolean = "permiso";
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
}
