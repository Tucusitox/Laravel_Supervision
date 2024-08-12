<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Asistencia;

class AsistenciasController
{

    public function index()
    {
        $empAsis = Asistencia::select("fecha_asistencia","identificacion","hora_llegada","hora_salida")
        ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
        ->selectRaw("SEC_TO_TIME(ABS(TIME_TO_SEC(TIMEDIFF(hora_llegada, hora_salida)))) as HorasTotales_Dia")
        ->join("empleados", "empleados.id_empleado","=","asistencias.fk_empleado")
        ->join("personas", "personas.id_persona","=","empleados.fk_persona")
        ->orderBy("fecha_asistencia","desc")
        ->get();

        $bolean = TRUE;
        return view("viewsEmps.asistencias", compact("empAsis","bolean"));
    }

    public function fecha(Request $request)
    {
        $request->validate([
            'fecha_asistencia' => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',
        ]);

        $fechaIngresada = $request->post("fecha_asistencia");

        $fechaAsis = Asistencia::select("fecha_asistencia","identificacion","hora_llegada","hora_salida")
        ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
        ->selectRaw("SEC_TO_TIME(ABS(TIME_TO_SEC(TIMEDIFF(hora_llegada, hora_salida)))) as HorasTotales_Dia")
        ->join("empleados", "empleados.id_empleado","=","asistencias.fk_empleado")
        ->join("personas", "personas.id_persona","=","empleados.fk_persona")
        ->where("fecha_asistencia","=",$fechaIngresada)
        ->orderBy("fecha_asistencia","desc")
        ->get();

        if($fechaAsis->isEmpty()){
            return redirect()->route('asistencias.index')->withErrors([
                'identificacion' => '¡No exixte ninguna asistencia en la fecha Ingresada!'
            ]);
        }
        else{
            $bolean = FALSE;
            return view("viewsEmps.asistencias", compact("fechaAsis","bolean"));
        }
    }

    // REGISTRAR LA ASISTENCIA EN LA TABLA "asistencias"

    public function store(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|string|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',
            'tipo_hora' => 'required|in:Hora de Entrada,Hora de Salida',
        ]);

        // CAPTURAR LA CÉDULA DEL EMPLEADO
        $cedulaEmp = $request->post("identificacion");

        // INVOCAR AL MODELO PERSONA PARA HAYAR AL EMPELADO
        $infoEmp = Persona::select("id_persona")
                ->where("identificacion","=",$cedulaEmp)
                ->get();

        // VALIDAR SI LA CONSULTA EXISTE
        if($infoEmp->isEmpty()){
            return redirect()->route('asistencias.index')->withErrors([
                'identificacion' => '¡Este Empleado no existe en el Sistema!'
            ]);
        }
        else{     
            // CAPTURAR EL ID DEL EMPLEADO
            $id_infoEmp =  $infoEmp->first()->id_persona;
        }

        // CAPTURAR LA HORA DE ENTRADA Y REALIZAR EL REGISTRO EN LA TABLA "asistencias"

        if($request->post("tipo_hora") == "Hora de Entrada"){

            // CAPTURAR LA FECHA ACTUAL
            $fechaActual = now()->setTimezone('America/Caracas')->format('Y-m-d');

            // VALIDAR SI YA EXISTE UN REGISTRO EN EL DÍA EN CURSO
            $asisExis = Asistencia::where("fk_empleado","=",$id_infoEmp)
                                ->where("fecha_asistencia","=",$fechaActual)
                                ->first();

            if($asisExis){
                return redirect()->route('asistencias.index')->withErrors([
                    'identificacion' => '¡La hora de entrada del empleado ya fue registrada en el sistema el día de hoy!'
                ]);
            }
            else{ 
                $asistEmp = new Asistencia;
                $asistEmp->fk_empleado = $id_infoEmp;
                $asistEmp->fecha_asistencia = $fechaActual;
                $asistEmp->hora_llegada = now()->setTimezone('America/Caracas')->format('H:i:s');
                $asistEmp->hora_salida = NULL;
                $asistEmp->save();
    
                return redirect()->route('asistencias.index')->with("success", "¡Hora de Entrada Registrada con Éxito!");
            }
        }

        if($request->post("tipo_hora") == "Hora de Salida"){

            // CAPTURAR LA FECHA ACTUAL
            $fechaActual = now()->setTimezone('America/Caracas')->format('Y-m-d');

            $salidaEmp = Asistencia::where("fk_empleado","=",$id_infoEmp)
                                    ->where("hora_salida","!=",NULL)
                                    ->where("fecha_asistencia","=",$fechaActual)
                                    ->get();

            if($salidaEmp->isEmpty()){

                // CAPTURANDO EL ID DE LA ASISTENCIA GENERADA CON LA HORA DE ENTRADA
                
                $idAsisEmp = Asistencia::select("id_asistencia")
                                        ->where("fk_empleado","=",$id_infoEmp)
                                        ->where("fecha_asistencia","=",$fechaActual)
                                        ->get();

                if(!$idAsisEmp->isEmpty()){
                    
                    $asistEmp = Asistencia::find($idAsisEmp)->first();
                    $asistEmp->hora_salida = now()->setTimezone('America/Caracas')->format('H:i:s');
                    $asistEmp->save();

                    return redirect()->route('asistencias.index')->with("success", "¡Hora de Salida Registrada con Éxito!");
        
                }
                else{
                    return redirect()->route('asistencias.index')->withErrors([
                        'identificacion' => '¡La hora de entrada de este empleado no ha sido registrada en el sistema en el día de hoy!'
                    ]);
                }
            }
            else{
                return redirect()->route('asistencias.index')->withErrors([
                    'identificacion' => '¡La hora de salida de este empleado ya ha sido registrada en el sistema el día de hoy!'
                ]);
            }
        }
    }

    // VISTA PARA BUSCAR ASISTENCIA ENTRE DOS FECHAS

    public function horasTotales(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|string|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',
            'fecha_primera' => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',
            'fecha_segunda' => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',
        ]);

        // VARIABLES A UTILIZAR

        $cedula = $request->post("identificacion");
        $fechaN1 = $request->post("fecha_primera");
        $fechaN2 = $request->post("fecha_segunda");

        // CAPTURAR EL ID DEL EMPLEADO

        $infoEmpleado = Persona::select("id_empleado","identificacion")
            ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
            ->join("empleados", "empleados.fk_persona","=","personas.id_persona")
            ->where("identificacion","=",$cedula)
            ->get();

        // SI LA CONSULTA NO ES VACIA

        if($infoEmpleado->isNotEmpty()){

            $horaSalida = Asistencia::select("hora_salida")
            ->where("fk_empleado","=",$infoEmpleado->first()->id_empleado)
            ->get();

            if($horaSalida->first()->hora_salida == NULL){
                return redirect()->route('asistencias.index')->withErrors([
                    'identificacion' => '¡Complete la asistencia del día del empleado antes de calcular sus Horas Totales!'
                ]);
            }
            else{
                //CALCULAR LAS HORAS TRABAJADAS ENTRE DOS FECHAS
                $horasTotales = Asistencia::select("fk_empleado")
                    ->selectRaw("SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(hora_llegada, hora_salida))))) as Horas_Totales")
                    ->whereBetween("fecha_asistencia",[$fechaN1,$fechaN2])
                    ->where("fk_empleado","=",$infoEmpleado->first()->id_empleado)
                    ->groupBy("fk_empleado")
                    ->get();

                // SI LA CONSULTA NO ES VACIA

                if($horasTotales->isNotEmpty()){
                    return view("viewsEmps.asistenciasXhorasTotales", compact("horasTotales","infoEmpleado","fechaN1","fechaN2"));
                }
                else {
                    return redirect()->route('asistencias.index')->withErrors([
                        'identificacion' => '¡No existen asistencias en el rango de días indicado!'
                    ]);
                }
            } 
        }
        else{
            return redirect()->route('asistencias.index')->withErrors([
                'identificacion' => '¡Este Empleado no existe en el Sistema!'
            ]);
        }

    }

}
