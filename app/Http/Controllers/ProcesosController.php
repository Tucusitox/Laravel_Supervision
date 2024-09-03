<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proceso;
use App\Models\Espacio;
use App\Models\EspaciosXProceso;
use App\Models\EvaluacionesXItemsproceso;
use App\Models\ProcesosXEvaluacione;
use App\Models\Evaluacione;

class ProcesosController
{
    // CONSULTA PARA LA VISTA "procesosResumen"
    public function index()
    {
        $bolean = TRUE;
        $procesos = Proceso::select("id_proceso","nombre_espacio","asunto_proceso",
                                    "codigo_proces","descripcion_proces","tiempo_duracion",
                                    "fecha_proceso","nombre_tipoProces")
        ->join("espacios_x_procesos","espacios_x_procesos.fk_proceso","=","procesos.id_proceso")
        ->join("espacios","espacios_x_procesos.fk_espacio","=","espacios.id_espacio")
        ->join("tipos_procesos","tipos_procesos.id_tipoProces","=","procesos.fk_tipoProces")
        ->orderBy("fecha_proceso","desc")
        ->get();

        return view("viewsProcesos.procesosResumen",compact("bolean","procesos"));
    }

    // IR AL FORMULARIO PARA CREAR PROCESOS
    public function create()
    {
        $espacios = Espacio::select("nombre_espacio")->get();
        return view("viewsProcesos.procesosCrear",compact("espacios"));
    }

    // LOGICA PARA GUARDAR EL PROCESO EN LA TABLA "procesos"
    public function store(Request $request)
    {
        $request->validate([
            'tipo_proceso' => 'required|in:planificacion,gestion_recursos,produccion,medicion',
            'asunto_proceso' => 'required|string|max:500',
            'espacios_procesos' => 'required|in:almacen,servicio,cocina,bar,comedor,estación_de_entregas,todos,no_aplica',
            'descripcion_proceso' => 'required|string|max:2000',
            'tiempo_proceso' => 'required|string|regex:/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/',
            'fecha_proceso' => 'required|regex:/^\d{4}\-\d{2}\-\d{2}$/',
        ]);

        // INSTANCIAMOS EL MODELO DE LA TABLA "procesos"
        $proceso = new Proceso;

        // GENERAR CODIGO ALEATORIO
        $codigoAlt = rand(1000,9999);
        $codigoProces = "PR-".$codigoAlt;

        // CAPTURAR EL ID PARA EL TIPO DE PROCESO
        $arrayProcesos = [
            "planificacion" => 1,
            "gestion_recursos" => 2,
            "produccion" => 3,
            "medicion" => 4,
        ];
        // ASIGNAMOS EL TIPO DE PROCESO
        $tipoProceso = $request->post('tipo_proceso');
        if (array_key_exists($tipoProceso, $arrayProcesos)) {
            $proceso->fk_tipoProces = $arrayProcesos[$tipoProceso];
        }
        
        // CAPTURAR LOS DATOS DEL FORMULARIO
        $proceso->codigo_proces = $codigoProces;
        $proceso->asunto_proceso = $request->post('asunto_proceso'); 
        $proceso->descripcion_proces = $request->post('descripcion_proceso'); 
        $proceso->tiempo_duracion = $request->post('tiempo_proceso'); 
        $proceso->fecha_proceso = $request->post('fecha_proceso'); 
        $proceso->save();

        if($proceso->save()){

            // INSTANCIAR EL MODELO DE LA TABLA "espacios_x_procesos" Y CAPTURAR EL ULTIMO ID DE LA TABLA "procesos
            $ultimoIdProceso = Proceso::orderBy('id_proceso', 'desc')->first();
            $espaProces = new EspaciosXProceso; 
            $espaProces->fk_proceso = $ultimoIdProceso->id_proceso;

            // CAPTURAR EL ID DEL ESPACIO
            $arrayEspacios = [
                "almacen" => 1,
                "servicio" => 2,
                "cocina" => 3,
                "bar" => 4,
                "comedor" => 5,
                "estación_de_entregas" => 6,
                "todos" => 7,
                "no_aplica" => 8,
            ];
            // ASIGANMOS EL ESPACIO DEL PROCESO
            $espacioProceso = $request->post('espacios_procesos');
            if (array_key_exists($espacioProceso, $arrayEspacios)) {
                $espaProces->fk_espacio = $arrayEspacios[$espacioProceso];
            }
            // INSERT EN LA TABLA "espacios_x_procesos"
            $espaProces->save();

            if($espaProces->save()){
                return redirect()->route('procesos.index')->with("success", "¡Proceso Creado con Éxito!");
            }
        }
    }

    // IR A LA VISTA CON EL FROMULARIOD E ACTUALIZACION
    public function edit($id_proceso)
    {
        $espacios = Espacio::select("nombre_espacio")->get();
        $unProceso = Proceso::select("id_proceso","nombre_espacio","asunto_proceso",
                "codigo_proces","descripcion_proces","tiempo_duracion",
                "fecha_proceso","nombre_tipoProces")
        ->join("espacios_x_procesos","espacios_x_procesos.fk_proceso","=","procesos.id_proceso")
        ->join("espacios","espacios_x_procesos.fk_espacio","=","espacios.id_espacio")
        ->join("tipos_procesos","tipos_procesos.id_tipoProces","=","procesos.fk_tipoProces")
        ->where("id_proceso",$id_proceso)
        ->first();

        return view("viewsProcesos.procesosUpdate",compact("unProceso","espacios"));
    }

    // LOGICA PARA ACTUALIZAR EL PROCESO
    public function update(Request $request, $id_proceso)
    {
        $request->validate([
            'tipo_proceso' => 'required|in:planificacion,gestion_recursos,produccion,medicion',
            'asunto_proceso' => 'required|string|max:500',
            'espacios_procesos' => 'required|in:almacen,servicio,cocina,bar,comedor,estación_de_entregas,todos,no_aplica',
            'descripcion_proceso' => 'required|string|max:2000',
            'tiempo_proceso' => 'required|string|regex:/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/',
            'fecha_proceso' => 'required|regex:/^\d{4}\-\d{2}\-\d{2}$/',
        ]);

        // INSTANCIAMOS EL MODELO DE LA TABLA "procesos"
        $proceso = Proceso::find($id_proceso);

        // CAPTURAR EL ID PARA EL TIPO DE PROCESO
        $arrayProcesos = [
            "planificacion" => 1,
            "gestion_recursos" => 2,
            "produccion" => 3,
            "medicion" => 4,
        ];
        // ASIGNAMOS EL TIPO DE PROCESO
        $tipoProceso = $request->post('tipo_proceso');
        if (array_key_exists($tipoProceso, $arrayProcesos)) {
            $proceso->fk_tipoProces = $arrayProcesos[$tipoProceso];
        }
        
        // CAPTURAR LOS DATOS DEL FORMULARIO
        $proceso->asunto_proceso = $request->post('asunto_proceso'); 
        $proceso->descripcion_proces = $request->post('descripcion_proceso'); 
        $proceso->tiempo_duracion = $request->post('tiempo_proceso'); 
        $proceso->fecha_proceso = $request->post('fecha_proceso'); 
        $proceso->save();

        if($proceso->save()){

            // INSTANCIAR EL MODELO DE LA TABLA "espacios_x_procesos" Y CAPTURAR EL ULTIMO ID DE LA TABLA "procesos
            $idEspaProces = EspaciosXProceso::select('id_espaProces')
            ->where("fk_proceso",$id_proceso)
            ->first();

            $espaProces = EspaciosXProceso::find($idEspaProces->id_espaProces); 

            // CAPTURAR EL ID DEL ESPACIO
            $arrayEspacios = [
                "almacen" => 1,
                "servicio" => 2,
                "cocina" => 3,
                "bar" => 4,
                "comedor" => 5,
                "estación_de_entregas" => 6,
                "todos" => 7,
                "no_aplica" => 8,
            ];
            // ASIGANMOS EL ESPACIO DEL PROCESO
            $espacioProceso = $request->post('espacios_procesos');
            if (array_key_exists($espacioProceso, $arrayEspacios)) {
                $espaProces->fk_espacio = $arrayEspacios[$espacioProceso];
            }
            // INSERT EN LA TABLA "espacios_x_procesos"
            $espaProces->save();

            if($espaProces->save()){
                return redirect()->route('procesos.index')->with("success", "¡Proceso Actualizado con Éxito!");
            }
        }
    }

    // IR A LA VISTA DE ELIMINACION DE PROCESOS
    public function delete($id_proceso)
    {
        $deleteProceso = Proceso::select("id_proceso","nombre_espacio","asunto_proceso",
                                    "codigo_proces","descripcion_proces","tiempo_duracion",
                                    "fecha_proceso","nombre_tipoProces")
        ->join("espacios_x_procesos","espacios_x_procesos.fk_proceso","=","procesos.id_proceso")
        ->join("espacios","espacios_x_procesos.fk_espacio","=","espacios.id_espacio")
        ->join("tipos_procesos","tipos_procesos.id_tipoProces","=","procesos.fk_tipoProces")
        ->where("id_proceso",$id_proceso)
        ->first();

        return view("viewsProcesos.procesosDelete",compact("deleteProceso"));
    }

    // LOGICA PARA ELIMINAR UN PROCESO DE LA BASE DE DATOS
    public function destroy($id_proceso)
    {
        // CAPTURANMOS LOS ID DEL REGISTRO A ELIMINAR
        $espaProces = EspaciosXProceso::where("fk_proceso",$id_proceso);
        $procesoDelet = Proceso::find($id_proceso);

        $notasProces = EvaluacionesXItemsproceso::select("id_eval_itemProceso")
        ->join("evaluaciones","evaluaciones_x_itemsProcesos.fk_evaluacion","=","evaluaciones.id_evaluacion")
        ->join("procesos_x_evaluaciones","procesos_x_evaluaciones.fk_evaluacion","=","evaluaciones.id_evaluacion")
        ->where("fk_proceso", $id_proceso);

        $procesEvals = ProcesosXEvaluacione::select("id_procesEval")
        ->where("fk_proceso", $id_proceso);

        $evaluacionesProces = Evaluacione::select("id_evaluacion")
        ->join("procesos_x_evaluaciones","procesos_x_evaluaciones.fk_evaluacion","=","evaluaciones.id_evaluacion")
        ->where("fk_proceso", $id_proceso);
        
        //GENERAMOS EL DELETE
        $notasProces->delete();
        $procesEvals->delete();
        $evaluacionesProces->delete();
        $espaProces->delete();
        $procesoDelet->delete();

        // SI TODO SALE BIEN VOLVER A "RESUMEN DE PROCESOS"
        return redirect()->route('procesos.index')->with("success", "¡Proceso Eliminado con Éxito!");
    }

    // LOGICA PARA BUSCAR PROCESO POR CODIGO O POR FECHA
    public function show(Request $request)
    {
        $bolean = FALSE;
        $codigProces = $request->post("buscarCodigo");
        $fechaProces = $request->post("fecha_proceso");

        if (preg_match('/^PR-\d{4}$/', $codigProces) || preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $fechaProces)){

            $procesos = Proceso::select("id_proceso","nombre_espacio","asunto_proceso",
                                        "codigo_proces","descripcion_proces","tiempo_duracion",
                                        "fecha_proceso","nombre_tipoProces")
            ->join("espacios_x_procesos","espacios_x_procesos.fk_proceso","=","procesos.id_proceso")
            ->join("espacios","espacios_x_procesos.fk_espacio","=","espacios.id_espacio")
            ->join("tipos_procesos","tipos_procesos.id_tipoProces","=","procesos.fk_tipoProces")
            ->where("codigo_proces",$codigProces)
            ->orWhere("fecha_proceso",$fechaProces)
            ->get();

            if($procesos->isNotEmpty()){
                return view("viewsProcesos.procesosResumen",compact("bolean","procesos"));
            }else{
                return redirect()->route('procesos.index')->withErrors([
                    'buscarCodigo' => '¡No se Encontraron Procesos con el Código ni con la Fecha Indicadas!'
                ]);
            }
        }
        else{
            return redirect()->route('procesos.index')->withErrors([
                'buscarCodigo' => '¡El Código o La Fecha no conicide con el Formato Requerido!'
            ]);
        }
    }

    // VER UN SOLO PROCESO DESDE LA VISTA DE EVALUACIONES DE PROCESOS
    public function unProceso($id_proceso)
    {
        $bolean = "evaluado";
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
}
