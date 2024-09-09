<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventualidade;
use App\Models\ElementosInfraestructura;
use App\Models\ElementosXEventalidade;
use App\Models\TiposElemento;

class MantenimientosController
{
    // IR A LA VISTA DE MANTENIMIENTOS RESUMEN
    public function index()
    {
        $bolean = TRUE;
        $fallas = Eventualidade::select("id_eventualidad","id_elementInfra","codigo_event","asunto_event",
                                          "descripcion_event","fecha_inicioEvent","fecha_finEvent",
                                          "tipo_estatu","fechaCreacion_event")
        ->join("elementos_x_eventalidades","elementos_x_eventalidades.fk_eventualidad","=","eventualidades.id_eventualidad")
        ->join("elementos_infraestructuras","elementos_infraestructuras.id_elementInfra","=","elementos_x_eventalidades.fk_elementInfra")
        ->join("tipos_estatusEvent","tipos_estatusEvent.id_tipoEstatusEvent","=","eventualidades.fk_tipoEstatusEvent")
        ->orderBy("fechaCreacion_event","desc")
        ->get();

        return view("viewsInfraestructura.mantenimientosResumen",compact("fallas","bolean"));
    }

    // IR AL FORMULARIO PARA CREAR UN MANTENIMIENTO
    public function create()
    {
        $numElement = TRUE;
        return view("viewsInfraestructura.mantenimientosCreate",compact("numElement"));
    }

    // IR AL FORMULARIO PARA CREAR UN MANTENIMIENTO DESDE RESUMEN
    public function createResum($id_elementInfra)
    {
        $numElement = FALSE;
        $numEquipo = ElementosInfraestructura::select("id_elementInfra","nombre_element")
        ->where("id_elementInfra",$id_elementInfra)
        ->first();

        return view("viewsInfraestructura.mantenimientosCreate",compact("numElement","numEquipo"));
    }

    // LOGICA PARA CREAR EL MANTENIMIENTO
    public function store(Request $request)
    {
        $request->validate([
            'id_elemento' => 'required|numeric|min:1',
            'mantenimiento_asunto' => 'required|string|regex:/^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/',
            "mantenimiento_descripcion" => "required|string",
            "fecha_inicioEvent" => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',
        ]);
        // VALIDAR QUE EL EQUIPO EXISTA EN EL SISTEMA
        $elementExist = ElementosInfraestructura::select("id_elementInfra")
        ->where("id_elementInfra",$request->post("id_elemento"))
        ->get();

        if($elementExist->isNotEmpty()){
            // CREAR EL CODIGO DE LA FALLA
            $numeroAleatorio = rand(1000, 9999);
            $codigoFalla = "F-".$numeroAleatorio;

            // INSTANCIAMOS EL MODELO PARA INSERT LA FALLA EN LA BASE DE DATOS
            $falla = new Eventualidade;
            $falla->fk_tipoEvent = 3;
            $falla->fk_tipoEstatusEvent = 1;
            $falla->codigo_event = $codigoFalla;
            $falla->asunto_event = $request->post("mantenimiento_asunto");
            $falla->descripcion_event = $request->post("mantenimiento_descripcion");
            $falla->fecha_inicioEvent = $request->post("fecha_inicioEvent");
            $falla->fecha_finEvent = NULL;
            $falla->fechaCreacion_event = now()->setTimezone('America/Caracas');
            $falla->save();

            if($falla->save()){
                // CAPTURAR EL ULTIMO ID GENERADO DE LA FALLA EN LA TABLA "eventualidades"
                $idEventualidad = Eventualidade::orderBy('id_eventualidad','desc')->first();
                $elementXfalla = new ElementosXEventalidade;
                $elementXfalla->fk_elementInfra = $elementExist->first()->id_elementInfra;
                $elementXfalla->fk_eventualidad = $idEventualidad->id_eventualidad;
                $elementXfalla->save();

                toastr()->success("¡Falla Reportada con Éxito!");
                return redirect()->route('mantenimientos.index');
            }
        }
        else{
            toastr()->error("¡Este Equipo no Existe en el Sistema Actualmente!");
            return redirect()->back();
        }
    }

    // IR A LA VISTA PARA CAMBIAR ESTATUS DE LA FALLA
    public function edit($id_eventualidad)
    {
        $falla = Eventualidade::select("id_eventualidad","codigo_event")
        ->where("id_eventualidad",$id_eventualidad)
        ->first();

        return view("viewsInfraestructura.mantenimientosUpdate",compact("falla"));
    }

    // LOGICA PARA CAMBIAR EL ESTATUS DE LA FALLA
    public function update(Request $request, $id_eventualidad)
    {
        $request->validate([
            'tipo_estatus' => 'required|in:Iniciada,En Proceso,Solucionada',
        ]);

        $fallaUpdate = Eventualidade::find($id_eventualidad);

        $arrayEstatus = [
            "Iniciada" => 1,
            "En Proceso" => 2,
            "Solucionada" => 3,
        ];

        $estatus = $request->post('tipo_estatus');
        if (array_key_exists($estatus, $arrayEstatus)) {
            $fallaUpdate->fk_tipoEstatusEvent = $arrayEstatus[$estatus];
        }

        if($estatus === "Solucionada"){
            $fallaUpdate->fecha_finEvent = now()->setTimezone("America/Caracas");
            $fallaUpdate->save();
            toastr()->success("¡Estatus Actualizado con Éxito!");
            return redirect()->route('mantenimientos.index');
        }
        else{
            $fallaUpdate->save();
            toastr()->success("¡Estatus Actualizado con Éxito!");
            return redirect()->route('mantenimientos.index');
        }
    }

    // VER UN EQUIPO DESDE MANTENIMIENTOS
    public function show($id_elementInfra)
    {
        $bolean = "mantenimiento";
        $tipoElement = TiposElemento::select("tipo_elemento")->get();
        $elementosInfras = ElementosInfraestructura::select("id_elementInfra","tipo_elemento","nombre_espacio",
                                                            "nombre_element","descripcion_element")
        ->join("tipos_elementos","tipos_elementos.id_tipoElement","=","elementos_infraestructuras.fk_tipoElement")                                                    
        ->join("espacios","espacios.id_espacio","=","elementos_infraestructuras.fk_espacio")
        ->where("id_elementInfra",$id_elementInfra)
        ->get();  

        return view("viewsInfraestructura.infraestructuraResumen",compact("elementosInfras","tipoElement","bolean"));
    }

    // LOGICA PARA BUSCAR MANTENIMIENTO POR CODIGO O POR FECHA
    public function find(Request $request)
    {
        $bolean = FALSE;
        $codigProces = $request->post("buscarCodigo");
        $fechaProces = $request->post("fecha_falla");

        if (preg_match('/^F-\d{4}$/', $codigProces) || preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $fechaProces)){

            $fallas = Eventualidade::select("id_eventualidad","id_elementInfra","codigo_event","asunto_event",
                                              "descripcion_event","fecha_inicioEvent","fecha_finEvent",
                                              "tipo_estatu","fechaCreacion_event")
            ->join("elementos_x_eventalidades","elementos_x_eventalidades.fk_eventualidad","=","eventualidades.id_eventualidad")
            ->join("elementos_infraestructuras","elementos_infraestructuras.id_elementInfra","=","elementos_x_eventalidades.fk_elementInfra")
            ->join("tipos_estatusEvent","tipos_estatusEvent.id_tipoEstatusEvent","=","eventualidades.fk_tipoEstatusEvent")
            ->orderBy("fechaCreacion_event","desc")
            ->where("codigo_event",$codigProces)
            ->orWhere("fechaCreacion_event",$fechaProces)
            ->get();

            if($fallas->isNotEmpty()){
                return view("viewsInfraestructura.mantenimientosResumen",compact("fallas","bolean"));
            }else{
                toastr()->info("¡No se Encontraron Mantenimientos con el Código ni con la Fecha Indicadas!");
                return redirect()->back();
            }
        }
        else{
            toastr()->warning("¡El Código o La Fecha no conicide con el Formato Requerido!");
            return redirect()->back();
        }
    }
}
