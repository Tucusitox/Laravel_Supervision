<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Eventualidade;
use App\Models\EmpleadosXEventualidade;
use App\Models\EvaluacionesXItemsemp;
use Illuminate\Support\Facades\DB;

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
        ->join("tipos_eventualidades","tipos_eventualidades.id_tipoEvent","=","eventualidades.fk_tipoEvent")
        ->orderBy("fechaCreacion_event","desc")
        ->where("tipo_eventualidad","Permiso")
        ->get();

        $bolean = TRUE;
        return view("viewsEmps.permisosResumen", compact("permisos","bolean"));
    }

    // BUSCAR UN PERMISO POR EL CODIGO
    public function buscarCodigo(Request $request)
    {
        $codigoPermiso = $request->post("buscarCodigo"); 

        if(preg_match('/^P-\d{4}$/', $codigoPermiso)){
            $permisos = Eventualidade::select("codigo_event","identificacion","asunto_event","descripcion_event",
                                              "fecha_inicioEvent","fecha_finEvent","fechaCreacion_event","id_persona")
            ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
            ->join("empleados_x_eventualidades","empleados_x_eventualidades.fk_eventualidad","=","eventualidades.id_eventualidad")
            ->join("empleados","empleados.id_empleado","=","empleados_x_eventualidades.fk_empleado")
            ->join("personas","personas.id_persona","=","empleados.fk_persona")
            ->where("codigo_event","=",$codigoPermiso)
            ->get();

            $bolean = FALSE;
            return view("viewsEmps.permisosResumen", compact("permisos","bolean"));
        }
        else{
            toastr()->warning("¡El Código no conicide con el Formato Requerido!");
            return redirect()->back();
        }
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
            $arrayTiposPermisos = [
                "Reposo Médico" => 'Reposo Médico',
                "Maternidad" => 'Maternidad',
                "Lactancia" => 'Lactancia',
                "Matrimonio" => 'Matrimonio',
                "Mudanza" => 'Mudanza',
                "Asuntos Personales" => 'Asuntos Personales',
                "Salida Temprana" => 'Salida Temprana',
            ];

            // ASIGNACION DEL TIPO DE PERMISO
            $permisoAsunto = $request->post("permiso_asunto");
            if (array_key_exists($permisoAsunto, $arrayTiposPermisos)) {
                $permiso->asunto_event = $arrayTiposPermisos[$permisoAsunto];
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
                
                toastr()->success("¡Permiso Registrado con Éxito!");
                return redirect()->route('permisos.index');
            }
        }
        else{
            toastr()->error("¡Este Empleado no existe en el Sistema!");
            return redirect()->back();
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
