<?php

use App\Http\Controllers\ViewsController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\AsistenciasController;
use App\Http\Controllers\EventualidadesController;
use Illuminate\Support\Facades\Route;

// RUTAS PARA REDIRECCIONAR ENTRE LAS INTERFACERS Y SECCIONES:

Route::get("/",[ViewsController::class,"index"])->name("welcome.index");
Route::get("/resumen/empelados",[ViewsController::class,"viewEmp"])->name("emp.viewEmp");
Route::get("/resumen/empeladosInactivos",[ViewsController::class,"empsInactivos"])->name("emps.inactivos");
Route::post("/resumen/un/empelado",[ViewsController::class,"findUnEmp"])->name("unEmp.findUnEmp");
Route::get('/delete/{id_persona}', [ViewsController::class,'viewDleteEmp'])->name('empleado.delete');
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
Route::put('/update/{id_persona}', [EmpleadosController::class,'update'])->name('empleado.update');
Route::put('/changeEstatus/{id_persona}', [EmpleadosController::class,'changeEstatus'])->name('empleado.estatus');
Route::delete('/destroyEmp/{id_persona}', [EmpleadosController::class,'destroy'])->name('empleado.destroy');
Route::put('/devolverEstatus/{id_persona}', [EmpleadosController::class,'statusActivo'])->name('empleado.cambioActivo');

// RUTAS PARA CONTROLADOR DE EVENTUALIDADES:

Route::get('/permisos/empleados', [EventualidadesController::class,'index'])->name('eventualidades.index');
Route::get('/permiso/crear', [EventualidadesController::class,'create'])->name('eventualidades.create');
Route::post('/permiso/store', [EventualidadesController::class,'store'])->name('eventualidades.store');
Route::get('/permiso/{id_persona}', [EventualidadesController::class,'show'])->name('eventualidades.show');

