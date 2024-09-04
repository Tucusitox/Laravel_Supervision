<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TiposElemento;
use App\Models\Espacio;
use App\Models\ElementosInfraestructura;
use App\Models\ElementosXEventalidade;
use App\Models\Eventualidade;

class InfraestructuraController
{
    // IR A LA VISTA DE RESUMEN DE INFRAESTRUCTURA
    public function index()
    {
        $bolean = TRUE;
        $tipoElement = TiposElemento::select("tipo_elemento")->get();
        $elementosInfras = ElementosInfraestructura::select("id_elementInfra","tipo_elemento","nombre_espacio",
                                                            "nombre_element","descripcion_element")
        ->join("tipos_elementos","tipos_elementos.id_tipoElement","=","elementos_infraestructuras.fk_tipoElement")                                                    
        ->join("espacios","espacios.id_espacio","=","elementos_infraestructuras.fk_espacio")
        ->get();                                                    

        return view("viewsInfraestructura.infraestructuraResumen",compact("elementosInfras","tipoElement","bolean"));
    }

    // IR A LA VISTA CON EL FORMULARIO DE CREACION DE EQUIPOS
    public function create()
    {
        $espacios = Espacio::select("nombre_espacio")->get();
        $tipoElement = TiposElemento::select("tipo_elemento")->get();
        return view("viewsInfraestructura.infraestructuraCreate",compact("tipoElement","espacios"));
    }

    // LOGICA PARA CREAR UN NUEVO EQUIPO DE INFRAESTRUCTURA
    public function store(Request $request)
    {
        $request->validate([
            'tipo_elemento' => 'required|in:físico,tecnológicos,mobiliarios,seguridad,salud',
            "espacios_infraestructura" => 'required|in:almacen,servicio,cocina,bar,comedor,estación_de_entregas,todos,no_aplica',
            "nombre_equipo" => 'required|string|max:100',
            "descripcion_equipo" => 'required|string|max:2000',
        ]);

        // INSTANCIAMOS EL MODELO PARA HACER EL REGISTRO EN LA TABLA
        $elementInfra = new ElementosInfraestructura;

        // CAPTURAR ID DEL TIPO DE ELEMENTO
        $arrayTiposElement = [
            "físico" => 1,
            "tecnológicos" => 2,
            "mobiliarios" => 3,
            "seguridad" => 4,
            "salud" => 5,
        ];
        // ASIGNACION DEL TIPO DE EQUIPO
        $tipoElemento = $request->post("tipo_elemento");
        if (array_key_exists($tipoElemento, $arrayTiposElement)) {
            $elementInfra->fk_tipoElement = $arrayTiposElement[$tipoElemento];
        }

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
        // ASIGANMOS EL ESPACIO DEL EQUIPO
        $espacioElemento = $request->post('espacios_infraestructura');
        if (array_key_exists($espacioElemento, $arrayEspacios)) {
            $elementInfra->fk_espacio = $arrayEspacios[$espacioElemento];
        }

        $elementInfra->nombre_element = $request->post('nombre_equipo');
        $elementInfra->descripcion_element = $request->post('descripcion_equipo');
        $elementInfra->save();

        return redirect()->route('infraestructura.index')->with("success", "¡Equipo Registrado con Éxito!");
    }

    // IR A LA VISTA CON EL FORMULARIO DE ACTUAlIZACION DE EQUIPOS
    public function edit($id_elementInfra)
    {
        $espacios = Espacio::select("nombre_espacio")->get();
        $tipoElement = TiposElemento::select("tipo_elemento")->get();
        $elementUpdate = ElementosInfraestructura::select("id_elementInfra","tipo_elemento","nombre_espacio",
                                                            "nombre_element","descripcion_element")
        ->join("tipos_elementos","tipos_elementos.id_tipoElement","=","elementos_infraestructuras.fk_tipoElement")                                                    
        ->join("espacios","espacios.id_espacio","=","elementos_infraestructuras.fk_espacio")
        ->where("id_elementInfra",$id_elementInfra)
        ->first();     

        return view("viewsInfraestructura.infraestructuraUpdate",compact("tipoElement","espacios","elementUpdate"));
    }

    // LOGICA PARA ACTUALIZAR EQUIPO DE INFRAESTRUCTURA
    public function update(Request $request, $id_elementInfra)
    {
        $request->validate([
            'tipo_elemento' => 'required|in:físico,tecnológicos,mobiliarios,seguridad,salud',
            "espacios_infraestructura" => 'required|in:almacen,servicio,cocina,bar,comedor,estación_de_entregas,todos,no_aplica',
            "nombre_equipo" => 'required|string|max:100',
            "descripcion_equipo" => 'required|string|max:2000',
        ]);

        // INSTANCIAMOS EL MODELO PARA HACER EL REGISTRO EN LA TABLA
        $elementInfra = ElementosInfraestructura::find($id_elementInfra);

        // CAPTURAR ID DEL TIPO DE ELEMENTO
        $arrayTiposElement = [
            "físico" => 1,
            "tecnológicos" => 2,
            "mobiliarios" => 3,
            "seguridad" => 4,
            "salud" => 5,
        ];
        // ASIGNACION DEL TIPO DE EQUIPO
        $tipoElemento = $request->post("tipo_elemento");
        if (array_key_exists($tipoElemento, $arrayTiposElement)) {
            $elementInfra->fk_tipoElement = $arrayTiposElement[$tipoElemento];
        }

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
        // ASIGANMOS EL ESPACIO DEL EQUIPO
        $espacioElemento = $request->post('espacios_infraestructura');
        if (array_key_exists($espacioElemento, $arrayEspacios)) {
            $elementInfra->fk_espacio = $arrayEspacios[$espacioElemento];
        }

        $elementInfra->nombre_element = $request->post('nombre_equipo');
        $elementInfra->descripcion_element = $request->post('descripcion_equipo');
        $elementInfra->save();

        return redirect()->route('infraestructura.index')->with("success", "¡Equipo Actualizado con Éxito!");
    }

    // IR A LA VISTA PARA ELIMINAR EQUIPOS
    public function delete($id_elementInfra)
    {
        $elementDelete = ElementosInfraestructura::select("id_elementInfra","tipo_elemento","nombre_espacio",
                                                          "nombre_element","descripcion_element")
        ->join("tipos_elementos","tipos_elementos.id_tipoElement","=","elementos_infraestructuras.fk_tipoElement")                                                    
        ->join("espacios","espacios.id_espacio","=","elementos_infraestructuras.fk_espacio")
        ->where("id_elementInfra",$id_elementInfra)
        ->first();     

        return view("viewsInfraestructura.infraestructuraDelete",compact("elementDelete"));
    }

    // LOGICA PARA ELIMINAR EQUIPOS DEL SISTEMA
    public function destroy($id_elementInfra)
    {
        // CAPTURAMOS LOS IDS DE LOS REGISTROS A ELIMINAR
        $elementDestroy = ElementosInfraestructura::find($id_elementInfra);     
        $elementXevent = ElementosXEventalidade::select("id_elementEvent")
        ->where("fk_elementInfra",$id_elementInfra);
        $elementXfalla = Eventualidade::select("id_eventualidad")
        ->join("elementos_x_eventalidades","elementos_x_eventalidades.fk_eventualidad","=","eventualidades.id_eventualidad")
        ->where("fk_elementInfra",$id_elementInfra);

        // REALIZAMOS LOS DELETES EN LAS TABLAS
        $elementXevent->delete();
        $elementXfalla->delete();
        $elementDestroy->delete();
        return redirect()->route('infraestructura.index')->with("success", "¡Equipo Elminado con Éxito!");
    }

    // LOGICA PARA BUSCAR POR TIPO DE ELEMENTO
    public function show(Request $request)
    {
        $bolean = False;
        $elementTipo = $request->post("tipo_elemento");
        $tipoElement = TiposElemento::select("tipo_elemento")->get();
        $elementosInfras = ElementosInfraestructura::select("id_elementInfra","tipo_elemento","nombre_espacio",
                                                            "nombre_element","descripcion_element")
        ->join("tipos_elementos","tipos_elementos.id_tipoElement","=","elementos_infraestructuras.fk_tipoElement")                                                    
        ->join("espacios","espacios.id_espacio","=","elementos_infraestructuras.fk_espacio")
        ->where("tipo_elemento",$elementTipo)
        ->get();  
        
        if($elementosInfras->isNotEmpty()){
            return view("viewsInfraestructura.infraestructuraResumen",compact("elementosInfras","tipoElement","bolean"));
        }
        else{
            return redirect()->back()->withErrors([
                'tipo_elemento' => '¡No Existen Equipos de este Tipo en el Sistema Actualmente!'
            ]);
        }
    }
}
