<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\AsistenciasController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\EvaluacionesEmpsController;
use App\Http\Controllers\ProcesosController;


// RUTAS PARA REDIRECCIONAR ENTRE LAS INTERFACERS Y SECCIONES:

Route::get("/",[ViewsController::class,"index"])->name("welcome.index");
Route::get("/resumen/empelados",[ViewsController::class,"viewEmp"])->name("emp.viewEmp");
Route::get("/resumen/empeladosInactivos",[ViewsController::class,"empsInactivos"])->name("emps.inactivos");
Route::post("/resumen/un/empelado",[ViewsController::class,"findUnEmp"])->name("unEmp.findUnEmp");
Route::get('/activo/{id_persona}', [ViewsController::class,'activo'])->name('empleado.activo');

// RUTAS PARA REDIRECCIONAR ENTRE LAS ASISTENCIAS Y CALCULO DE HORAS TOTALES:

Route::get('/asistencias/empleados', [AsistenciasController::class,'index'])->name('asistencias.index');
Route::post('/asistencia/crear', [AsistenciasController::class,'store'])->name('asistencias.store');
Route::post('/asistencia/fecha', [AsistenciasController::class,'fecha'])->name('asistencias.fecha');
Route::post('/asistencias/horasTotales', [AsistenciasController::class,'horasTotales'])->name('asistencias.horasTotales');

// RUTAS PARA CRUD DE EMPELADOS:

Route::get("/crear/empleado",[EmpleadosController::class,"index"])->name("crearEmp.index");
Route::post("/store",[EmpleadosController::class,"store"])->name("empleado.store");
Route::get('/show/{id_persona}',[EmpleadosController::class,"show"])->name("empleado.show");
Route::get('/edit/{id_persona}',[EmpleadosController::class,"edit"])->name("empleado.edit");
Route::get('/edit/resume/{id_persona}',[EmpleadosController::class,"editDesdeResum"])->name("empleado.editDesdeResum");
Route::put('/update/{id_persona}', [EmpleadosController::class,'update'])->name('empleado.update');
Route::put('/changeEstatus/{id_persona}', [EmpleadosController::class,'changeEstatus'])->name('empleado.estatus');
Route::get('/delete/1{id_persona}', [EmpleadosController::class,'viewDeleteEmp1'])->name('empleado.delete1');
Route::get('/delete/2{id_persona}', [EmpleadosController::class,'viewDeleteEmp2'])->name('empleado.delete2');
Route::delete('/destroyEmp/{id_persona}', [EmpleadosController::class,'destroy'])->name('empleado.destroy');
Route::put('/devolverEstatus/{id_persona}', [EmpleadosController::class,'statusActivo'])->name('empleado.cambioActivo');

// RUTAS PARA CONTROLADOR DE PERMISOS:

Route::get('/permisos/empleados', [PermisosController::class,'index'])->name('permisos.index');
Route::post('un/permiso/', [PermisosController::class,'buscarCodigo'])->name('permisos.buscarCodigo');
Route::get('/permiso/crear', [PermisosController::class,'create'])->name('permisos.create');
Route::post('/permiso/store', [PermisosController::class,'store'])->name('permisos.store');
Route::get('/permiso/{id_persona}', [PermisosController::class,'show'])->name('permisos.show');
Route::get("/empleado/permiso/{id_persona}",[PermisosController::class,"permisoEmp"])->name("permisos.permisoEmp");

// RUTAS PARA EVALUACIONES

Route::get("/evaluacion/index",[EvaluacionesEmpsController::class,"index"])->name("evaluaciones.index");
Route::get("/evaluacion/crear",[EvaluacionesEmpsController::class,"create"])->name("evaluaciones.create");
Route::post("/evaluacion/store",[EvaluacionesEmpsController::class,"store"])->name("evaluaciones.store");
Route::get("/evaluacion/show/{id_persona}",[EvaluacionesEmpsController::class,"show"])->name("evaluaciones.show");
Route::post("/evaluacion/find/",[EvaluacionesEmpsController::class,"find"])->name("evaluaciones.find");
Route::get("/empleado/evaluacion/{id_persona}",[EvaluacionesEmpsController::class,"showEmp"])->name("evaluaciones.showEmp");
Route::get("/empelados/destacados/",[EvaluacionesEmpsController::class,"empsDest"])->name("evaluaciones.empsDest");
Route::get("/empleado/destacado/detalles/{id_persona}",[EvaluacionesEmpsController::class,"empDestac"])->name("evaluaciones.empDestac");

// RUTAS PARA CRUD DE LOS PROCESOS

Route::get('/procesos/resumen', [ProcesosController::class,'index'])->name('procesos.index');
Route::get('/procesos/create', [ProcesosController::class,'create'])->name('procesos.create');
Route::post('/procesos/store', [ProcesosController::class,'store'])->name('procesos.store');
Route::get('/procesos/edit/{id_proceso}', [ProcesosController::class,'edit'])->name('procesos.edit');
Route::put('/procesos/update/{id_proceso}', [ProcesosController::class,'update'])->name('procesos.update');
Route::get('/procesos/delete/{id_proceso}', [ProcesosController::class,'delete'])->name('procesos.delete');
Route::delete('/procesos/destroy/{id_proceso}', [ProcesosController::class,'destroy'])->name('procesos.destroy');
Route::post('/procesos/show', [ProcesosController::class,'show'])->name('procesos.show');
