<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacione;
use App\Models\Persona;
use App\Models\EmpleadosXEvaluacione;
use App\Models\EvaluacionesXItemsemp;
use Illuminate\Support\Facades\DB;

class EvaluacionesEmpsController
{
    // VISTA PARA VER TODAS LAS EVALUACIONES DE LOS EMPLEADOS Y SUS NOTAS
    public function index()
    {
        $bolean = TRUE;
        $notas = EvaluacionesXItemsemp::selectRaw('
            fk_evaluacion,
            MAX(CASE WHEN rn = 1 THEN nota_itemEmpleado END) AS nota1,
            MAX(CASE WHEN rn = 2 THEN nota_itemEmpleado END) AS nota2,
            MAX(CASE WHEN rn = 3 THEN nota_itemEmpleado END) AS nota3,
            MAX(CASE WHEN rn = 4 THEN nota_itemEmpleado END) AS nota4,
            MAX(CASE WHEN rn = 5 THEN nota_itemEmpleado END) AS nota5,
            SUM(nota_itemEmpleado) AS suma_notas
        ')
        ->from(DB::raw('(SELECT fk_evaluacion, nota_itemEmpleado, ROW_NUMBER() OVER (PARTITION BY fk_evaluacion ORDER BY id_eval_itemEmp) AS rn FROM evaluaciones_x_itemsemps) AS subquery'))
        ->groupBy('fk_evaluacion')
        ->get();

        $evaluaciones = Persona::select("id_persona","id_evaluacion",
                                        "codigo_eval","fecha_evaluacion")
        ->join("empleados", "empleados.fk_persona","=","personas.id_persona")
        ->join("empleados_x_evaluaciones","empleados_x_evaluaciones.fk_empleado","=","empleados.id_empleado")
        ->join("evaluaciones","evaluaciones.id_evaluacion","=","empleados_x_evaluaciones.fk_evaluacion")
        ->orderBy("fecha_evaluacion","desc")
        ->get();

        //return $notas;
        return view("viewsEmps.evaluacionResumen",compact("notas","evaluaciones","bolean"));
    }

    // VISTA PARA CREAR EVALUACION DE UN EMPLEADO
    public function create()
    {
        $ciEmp = NULL;
        return view("viewsEmps.crearEvaluacionEmp",compact("ciEmp"));
    }

    // CREEAR EVALUACION DESDE VISTA DETALLES EMPLEADOS
    public function show($id_persona)
    {
        $ciEmp = Persona::select("id_persona","identificacion")
        ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
        ->where("id_persona",$id_persona)
        ->first();

        return view("viewsEmps.crearEvaluacionEmp",compact("ciEmp"));    
    }

    // LOGICA PARA CREAR LA EVALUACION E INSERTARLA EN LA TABLA "evaluaciones"
    public function store(Request $request)
    {
        // VALIDAR LOS CAMPOS DE LOS FORMULARIOS
        $request->validate(
            [
                'identificacion' => 'required|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',

                'higiene' => 'required|numeric|min:1|max:20',

                'vestimenta' => 'required|min:1|max:20',

                'buenTrato_cliente' => 'required|numeric|min:1|max:20',

                'conocimiento_menus' => 'required|numeric|min:1|max:20',

                'trabajo_equipo' => 'required|numeric|min:1|max:20',

                'fecha_evaluacion' => 'required|regex:/^\d{4}\-\d{2}\-\d{2}$/',
            ]
        );

        // CAPTURAR EL ID DEL EMPLEADO
        $cedulaEmp = $request->post("identificacion");
        $idEmp = Persona::select("id_persona")
        ->where("identificacion","=",$cedulaEmp)
        ->get();

        // GUARDAR LOS DATOS DEL FORM EN UN ARRAY
        $itemsEmps = [
            $request->post("higiene"),
            $request->post("vestimenta"),
            $request->post("buenTrato_cliente"),
            $request->post("conocimiento_menus"),
            $request->post("trabajo_equipo")
        ];    
        
        if($idEmp->isNotEmpty()){

            // GENERAR CODIGO PARA LA EVALUACION
            $numeroAleatorio = rand(1000, 9999);
            $codigEval = "E-".$numeroAleatorio;

            // INSTANCIAR EL MODELO PARA REALIZAR EL INSERT
            $evaluacion = new Evaluacione;
            $evaluacion->codigo_eval = $codigEval;
            $evaluacion->calificacion_eval = array_sum($itemsEmps);
            $evaluacion->fecha_evaluacion = $request->post("fecha_evaluacion");
            $evaluacion->save();

            // GENERAR INSERT EN TABLA "evaluaciones_x_itemsEmps"
            if($evaluacion->save()){

                // CAPTURAR EL ULTIMO ID GENERADO EN LA TABLA "evaluaciones"
                $ultimoRegistro = Evaluacione::orderBy('id_evaluacion', 'desc')->first();  

                // CREAR ARRAY PARA INGRESAR LAS NOTAS EN LA TABLA "evaluaciones_x_itemsEmps" E ITERARLO
                $datosEvaluacion = [];
                foreach ($itemsEmps as $index => $itemNota) {
                    $datosEvaluacion[] = [
                        'fk_evaluacion' => $ultimoRegistro->id_evaluacion,
                        'fk_itemEmp' => $index + 1,
                        'nota_itemEmpleado' => $itemNota, 
                    ];
                }
                EvaluacionesXItemsemp::insert($datosEvaluacion);

                // GENERAR INSERT EN TABLA "empelados_x_evaluaciones"
                $empXeval = new EmpleadosXEvaluacione;
                $empXeval->fk_empleado = $idEmp->first()->id_persona;
                $empXeval->fk_evaluacion = $ultimoRegistro->id_evaluacion;
                $empXeval->save();

                if($empXeval->save()){
                    return redirect()->route('evaluaciones.index')->with("success", "¡Evaluación Realizada con Éxito!");
                }
            }
        }
        else{
            return redirect()->back()->withErrors([
                'identificacion' => '¡Este Empleado no existe en el Sistema!'
            ]);
        }
    }

    // LOGICA PARA BUSCAR UNA EVALUACION POR CODIGO O FECHA
    public function find(Request $request)
    {
        $bolean = FALSE;
        $codigEvaL = $request->post("buscarCodigo");
        $fechaEvaL = $request->post("fecha_evaluacion");

        if (preg_match('/^E-\d{4}$/', $codigEvaL) || preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $fechaEvaL)){

            $notas = EvaluacionesXItemsemp::selectRaw('
                fk_evaluacion,
                MAX(CASE WHEN rn = 1 THEN nota_itemEmpleado END) AS nota1,
                MAX(CASE WHEN rn = 2 THEN nota_itemEmpleado END) AS nota2,
                MAX(CASE WHEN rn = 3 THEN nota_itemEmpleado END) AS nota3,
                MAX(CASE WHEN rn = 4 THEN nota_itemEmpleado END) AS nota4,
                MAX(CASE WHEN rn = 5 THEN nota_itemEmpleado END) AS nota5,
                SUM(nota_itemEmpleado) AS suma_notas
            ')
            ->from(DB::raw('(SELECT fk_evaluacion, nota_itemEmpleado, ROW_NUMBER() OVER (PARTITION BY fk_evaluacion ORDER BY id_eval_itemEmp) AS rn FROM evaluaciones_x_itemsemps) AS subquery'))
            ->join('evaluaciones', 'evaluaciones.id_evaluacion', '=', 'subquery.fk_evaluacion')
            ->groupBy('fk_evaluacion')
            ->where("codigo_eval",$codigEvaL)
            ->orwhere("fecha_evaluacion",$fechaEvaL)
            ->get();
            
            $evaluaciones = Persona::select("id_persona","id_evaluacion",
                                                "codigo_eval","fecha_evaluacion")
            ->join("empleados", "empleados.fk_persona","=","personas.id_persona")
            ->join("empleados_x_evaluaciones","empleados_x_evaluaciones.fk_empleado","=","empleados.id_empleado")
            ->join("evaluaciones","evaluaciones.id_evaluacion","=","empleados_x_evaluaciones.fk_evaluacion")
            ->where("codigo_eval",$codigEvaL)
            ->orwhere("fecha_evaluacion",$fechaEvaL)
            ->get();
                
            if($notas->isNotEmpty() && $evaluaciones->isNotEmpty()){
                return view("viewsEmps.evaluacionResumen",compact("notas","evaluaciones","bolean"));
            }else{
                return redirect()->route('evaluaciones.index')->withErrors([
                    'buscarCodigo' => '¡No se Encontraron Evaluaciones con el Código ni con la Fecha Indicadas!'
                ]);
            }
        }
        else{
            return redirect()->route('evaluaciones.index')->withErrors([
                'buscarCodigo' => '¡El Código o La Fecha no conicide con el Formato Requerido!'
            ]);
        }
    }

    // PARA MOSTRAR LOS EMPLEADOS MAS DESTACADOS
    public function empsDest()
    {
        $empsDestac = DB::table('empleados_x_evaluaciones as empXeval')
        ->join("evaluaciones as ev","empXeval.fk_evaluacion","=","ev.id_evaluacion")
        ->join("empleados","empXeval.fk_empleado","=","empleados.id_empleado")
        ->join("personas","empleados.fk_persona","=","personas.id_persona")
        ->select("identificacion","id_persona",
                DB::raw("AVG(ev.calificacion_eval) AS promedio_empleado"), 
                DB::raw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
                )
        ->groupBy("empXeval.fk_empleado","identificacion","Nombre_Apellido","id_persona")
        ->having(DB::raw("AVG(ev.calificacion_eval)"), ">=", 80)
        ->get();

        return view("viewsEmps.empleadosDestacados",compact("empsDestac"));
    }

    // IR A LA VISTA DETALLES EMPLEADOS DESDE EVALUACIONES
    public function showEmp($id_persona)
    {
        $bolean = FALSE;
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

    // IR A LA VISTA DETALLES EMPLEADOS DESDE EMPLEADOS DESTACADOS
    public function empDestac($id_persona)
    {
        $bolean = "destacado";
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
