<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Eventualidade;
use App\Models\EmpleadosXEventualidade;
use Illuminate\Http\Request;

class EventualidadesController
{
    public function index()
    {
        $permisos = Eventualidade::select("codigo_event","identificacion","asunto_event","descripcion_event",
                                          "fecha_inicioEvent","fecha_finEvent")
        ->selectRaw("CONCAT(nombre,' ',apellido) AS Nombre_Apellido")
        ->join("empleados_x_eventualidades","empleados_x_eventualidades.fk_eventualidad","=","eventualidades.id_eventualidad")
        ->join("empleados","empleados.id_empleado","=","empleados_x_eventualidades.fk_empleado")
        ->join("personas","personas.id_persona","=","empleados.fk_persona")
        ->get();

        return view("viewsEmps.permisosResumen", compact("permisos"));
    }

    public function show($id_persona)
    {
        $ciEmp = Persona::select("id_persona","identificacion")
        ->where("id_persona",$id_persona)
        ->get();

        return view("viewsEmps.crearPermiso", compact("ciEmp"));       
    }

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
            "permiso_asunto" => "required|string",
            "permiso_descripcion" => "required|string",
            "fecha_inicioEvent" => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',
            "fecha_finEvent" => 'required|string|regex:/^\d{4}\-\d{2}\-\d{2}$/',
        ]);

        // CREAR EL CODIGO DEL PERMISO
        $numeroAleatorio = rand(100000, 999999);
        $codigoEvent = "P-".$numeroAleatorio;
        
        // CAPTURAR EL ID DEL EMPLEADO

        $cedulaEmp = $request->post("identificacion");
        $idEmp = Persona::select("id_persona")
            ->where("identificacion","=",$cedulaEmp)
            ->get();
        
        if($idEmp->isNotEmpty()){

            $permiso = new Eventualidade;
            $permiso->fk_tipoEvent = 1;
            $permiso->fk_tipoEstatusEvent = 5;
            $permiso->codigo_event = $codigoEvent;
            $permiso->asunto_event = $request->post("permiso_asunto");
            $permiso->descripcion_event = $request->post("permiso_descripcion");
            $permiso->fecha_inicioEvent = $request->post("fecha_inicioEvent");
            $permiso->fecha_finEvent = $request->post("fecha_finEvent");
            $permiso->save();

            if($permiso->save()){

                // CAPTURAR EL ULTIMO ID GENERADO EN LA TABLA PERSONAS
                $ultimoRegistro = Eventualidade::latest()->first();
                $idEvent = $ultimoRegistro->id_eventualidad;

                // INSERT EN LA TABLA "empleados_x_eventualidades"
                $empXevent = new EmpleadosXEventualidade;
                $empXevent->fk_empleado = $idEmp->first()->id_persona;
                $empXevent->fk_eventualidad = $idEvent;
                $empXevent->save();

                return redirect()->route('eventualidades.index')->with("success", "¡Permiso Registrado con Éxito!");
            }
        }
        else{
            return redirect()->route('eventualidades.index')->withErrors([
                'empNoExiste' => '¡Este Empleado no existe en el Sistema!'
            ]);
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
