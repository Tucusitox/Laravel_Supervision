<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proceso;
use App\Models\Evaluacione;
use App\Models\EvaluacionesXItemsproceso;
use App\Models\ProcesosXEvaluacione;
use Illuminate\Support\Facades\DB;

class ProcesEvaluacionesController
{
    // VISTA PARA VER TODAS LAS EVALUACIONES DE LOS PROCESOS Y SUS NOTAS
    public function index()
    {
        $bolean = TRUE;
        $notas = EvaluacionesXItemsproceso::selectRaw('
            fk_evaluacion,
            MAX(CASE WHEN rn = 1 THEN nota_itemProceso END) AS nota1,
            MAX(CASE WHEN rn = 2 THEN nota_itemProceso END) AS nota2,
            MAX(CASE WHEN rn = 3 THEN nota_itemProceso END) AS nota3,
            MAX(CASE WHEN rn = 4 THEN nota_itemProceso END) AS nota4,
            MAX(CASE WHEN rn = 5 THEN nota_itemProceso END) AS nota5,
            SUM(nota_itemProceso) AS suma_notas
            ')
        ->from(DB::raw('(SELECT fk_evaluacion, nota_itemProceso, ROW_NUMBER() OVER (PARTITION BY fk_evaluacion ORDER BY eval_itemProceso) AS rn FROM evaluaciones_x_itemsProcesos) AS subquery'))
        ->groupBy('fk_evaluacion')
        ->get();

        $evaluaciones = Evaluacione::select("id_proceso","id_evaluacion",
                                            "codigo_eval","fecha_evaluacion")
        ->join("procesos_x_evaluaciones","procesos_x_evaluaciones.fk_evaluacion","=","evaluaciones.id_evaluacion")
        ->join("procesos","procesos_x_evaluaciones.fk_proceso","=","procesos.id_proceso")
        ->orderBy("fecha_evaluacion","desc")
        ->get();

        return view("viewsProcesos.procesosEvaluaciones",compact("bolean","notas","evaluaciones"));
    }
    
    // IR A LA VISTA CON FORMULARIO PARA CREAR EVALUACION PARA PROCESOS
    public function create()
    {
        $codProces = NULL;
        return view("viewsProcesos.procesoCrearEvaluacion",compact("codProces"));
    }

    // LOGICA PARA CREAR EVALUACION PARA UN PROCESO
    public function store(Request $request)
    {
        $request->validate(
            [
                'proceso_codigo' => 'required|regex:/^PR-\d{4}$/',

                'eficiencia' => 'required|numeric|min:1|max:20',

                'efectividad' => 'required|min:1|max:20',

                'flexibilidad' => 'required|numeric|min:1|max:20',

                'consistencia' => 'required|numeric|min:1|max:20',

                'mejora_continua' => 'required|numeric|min:1|max:20',

                'fecha_evaluacion' => 'required|regex:/^\d{4}\-\d{2}\-\d{2}$/',
            ]
        );

        // CAPTURAR EL ID DEL EMPLEADO
        $codigoProces = $request->post("proceso_codigo");
        $idProces = Proceso::select("id_proceso")
        ->where("codigo_proces","=",$codigoProces)
        ->get();

        // GUARDAR LOS DATOS DEL FORM EN UN ARRAY
        $itemsProcesos = [
            $request->post("eficiencia"),
            $request->post("efectividad"),
            $request->post("flexibilidad"),
            $request->post("consistencia"),
            $request->post("mejora_continua")
        ];    

        if($idProces->isNotEmpty()){

            // GENERAR CODIGO PARA LA EVALUACION
            $numeroAleatorio = rand(1000, 9999);
            $codigEval = "E-".$numeroAleatorio;

            // INSTANCIAR EL MODELO PARA REALIZAR EL INSERT
            $evaluacion = new Evaluacione;
            $evaluacion->codigo_eval = $codigEval;
            $evaluacion->calificacion_eval = array_sum($itemsProcesos);
            $evaluacion->fecha_evaluacion = $request->post("fecha_evaluacion");
            $evaluacion->save();

            // GENERAR INSERT EN TABLA "evaluaciones_x_itemsEmps"
            if($evaluacion->save()){

                // CAPTURAR EL ULTIMO ID GENERADO EN LA TABLA "evaluaciones"
                $ultimoRegistro = Evaluacione::orderBy('id_evaluacion', 'desc')->first();  

                // CREAR ARRAY PARA INGRESAR LAS NOTAS EN LA TABLA "evaluaciones_x_itemsEmps" E ITERARLO
                $datosEvaluacion = [];
                foreach ($itemsProcesos as $index => $itemNota) {
                    $datosEvaluacion[] = [
                        'fk_evaluacion' => $ultimoRegistro->id_evaluacion,
                        'fk_itemProceso' => $index + 1,
                        'nota_itemProceso' => $itemNota, 
                    ];
                }
                EvaluacionesXItemsproceso::insert($datosEvaluacion);

                // GENERAR INSERT EN TABLA "prcoesos_x_evaluaciones"
                $empXeval = new ProcesosXEvaluacione;
                $empXeval->fk_proceso = $idProces->first()->id_proceso;
                $empXeval->fk_evaluacion = $ultimoRegistro->id_evaluacion;
                $empXeval->save();

                if($empXeval->save()){
                    toastr()->success("¡Evaluación Realizada con Éxito!");
                    return redirect()->route('procesos.evaluaciones');
                }
            }
        }
        else{
            toastr()->error("¡Este Proceso no Existe en el Sistema!");
            return redirect()->back();
        }
    }

    // PARA MOSTRAR LOS PROCESOS MAS DESTACADOS
    public function procesDestac()
    {
        $procesDestac = DB::table('procesos_x_evaluaciones as procesXeval')
        ->join("evaluaciones as ev","procesXeval.fk_evaluacion","=","ev.id_evaluacion")
        ->join("procesos","procesXeval.fk_proceso","=","procesos.id_proceso")
        ->select("codigo_proces","id_proceso",DB::raw("AVG(ev.calificacion_eval) AS promedio_proceso"), )
        ->groupBy("procesXeval.fk_proceso","codigo_proces","id_proceso")
        ->having(DB::raw("AVG(ev.calificacion_eval)"), ">=", 80)
        ->get();

        return view("viewsProcesos.procesosDestacados",compact("procesDestac"));
    }

    // VER UN SOLO PROCESO DESDE LA VISTA DE PROCESOS DESTACADOS
    public function find($id_proceso)
    {
        $bolean = "procesDestac";
        $procesos = Proceso::select("id_proceso","nombre_espacio","asunto_proceso",
                "codigo_proces","descripcion_proces","tiempo_duracion",
                "fecha_proceso","nombre_tipoProces")
        ->join("espacios_x_procesos","espacios_x_procesos.fk_proceso","=","procesos.id_proceso")
        ->join("espacios","espacios_x_procesos.fk_espacio","=","espacios.id_espacio")
        ->join("tipos_procesos","tipos_procesos.id_tipoProces","=","procesos.fk_tipoProces")
        ->where("id_proceso",$id_proceso)
        ->get();

        return view("viewsProcesos.procesosResumen",compact("bolean","procesos"));
    }
    
    // CREEAR EVALUACION DESDE VISTA RESUMEN DE PROCESOS
    public function show($id_proceso)
    {
        $codProces = Proceso::select("codigo_proces")
        ->where("id_proceso",$id_proceso)
        ->first();

        return view("viewsProcesos.procesoCrearEvaluacion",compact("codProces")); 
    }

    // LOGICA PARA BUSCAR UNA EVALUACION POR CODIGO O FECHA
    public function filtro(Request $request)
    {
        $bolean = FALSE;
        $codigEvaL = $request->post("buscarCodigo");
        $fechaEvaL = $request->post("fecha_proceso");

        if (preg_match('/^E-\d{4}$/', $codigEvaL) || preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $fechaEvaL)){

            $notas = EvaluacionesXItemsproceso::selectRaw('
                fk_evaluacion,
                MAX(CASE WHEN rn = 1 THEN nota_itemProceso END) AS nota1,
                MAX(CASE WHEN rn = 2 THEN nota_itemProceso END) AS nota2,
                MAX(CASE WHEN rn = 3 THEN nota_itemProceso END) AS nota3,
                MAX(CASE WHEN rn = 4 THEN nota_itemProceso END) AS nota4,
                MAX(CASE WHEN rn = 5 THEN nota_itemProceso END) AS nota5,
                SUM(nota_itemProceso) AS suma_notas
                ')
            ->from(DB::raw('(SELECT fk_evaluacion, nota_itemProceso, ROW_NUMBER() OVER (PARTITION BY fk_evaluacion ORDER BY eval_itemProceso) AS rn FROM evaluaciones_x_itemsProcesos) AS subquery'))
            ->join('evaluaciones', 'evaluaciones.id_evaluacion', '=', 'subquery.fk_evaluacion')
            ->groupBy('fk_evaluacion')
            ->where("codigo_eval",$codigEvaL)
            ->orwhere("fecha_evaluacion",$fechaEvaL)
            ->get();
    
            $evaluaciones = Evaluacione::select("id_proceso","id_evaluacion",
                                                "codigo_eval","fecha_evaluacion")
            ->join("procesos_x_evaluaciones","procesos_x_evaluaciones.fk_evaluacion","=","evaluaciones.id_evaluacion")
            ->join("procesos","procesos_x_evaluaciones.fk_proceso","=","procesos.id_proceso")
            ->where("codigo_eval",$codigEvaL)
            ->orwhere("fecha_evaluacion",$fechaEvaL)
            ->get();
                
            if($notas->isNotEmpty() && $evaluaciones->isNotEmpty()){
                return view("viewsProcesos.procesosEvaluaciones",compact("bolean","notas","evaluaciones"));
            }else{
                toastr()->warning("¡No se Encontraron Evaluaciones en la Fecha o con el Código Indicados!");
                return redirect()->back();
            }
        }
        else{
            toastr()->warning("¡El Código o La Fecha no conicide con el Formato Requerido!");
            return redirect()->back();
        }
    }
}
