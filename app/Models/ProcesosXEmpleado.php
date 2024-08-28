<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcesosXEmpleado
 * 
 * @property int $id_procesoEmp
 * @property int $fk_proceso
 * @property int $fk_empleado
 * 
 * @property Empleado $empleado
 * @property Proceso $proceso
 *
 * @package App\Models
 */
class ProcesosXEmpleado extends Model
{
	protected $table = 'procesos_x_empleados';
	protected $primaryKey = 'id_procesoEmp';
	public $timestamps = false;

	protected $casts = [
		'fk_proceso' => 'int',
		'fk_empleado' => 'int'
	];

	protected $fillable = [
		'fk_proceso',
		'fk_empleado'
	];

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'fk_empleado');
	}

	public function proceso()
	{
		return $this->belongsTo(Proceso::class, 'fk_proceso');
	}
}
