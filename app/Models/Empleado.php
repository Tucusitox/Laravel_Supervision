<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 * 
 * @property int $id_empleado
 * @property int $fk_persona
 * @property int $fk_tipo_emp
 * @property int $fk_cargo
 * @property string $estado_laboral
 * @property Carbon $fecha_ingreso
 * @property Carbon|null $fecha_egreso
 * 
 * @property Cargo $cargo
 * @property Persona $persona
 * @property TiposEmp $tipos_emp
 * @property Collection|Asistencia[] $asistencias
 * @property Collection|Evaluacione[] $evaluaciones
 * @property Collection|Eventualidade[] $eventualidades
 * @property Collection|Horario[] $horarios
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class Empleado extends Model
{
	protected $table = 'empleados';
	protected $primaryKey = 'id_empleado';
	public $timestamps = false;

	protected $casts = [
		'fk_persona' => 'int',
		'fk_tipo_emp' => 'int',
		'fk_cargo' => 'int',
		'fecha_ingreso' => 'datetime',
		'fecha_egreso' => 'datetime'
	];

	protected $fillable = [
		'fk_persona',
		'fk_tipo_emp',
		'fk_cargo',
		'estado_laboral',
		'fecha_ingreso',
		'fecha_egreso'
	];

	public function cargo()
	{
		return $this->belongsTo(Cargo::class, 'fk_cargo');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'fk_persona');
	}

	public function tipos_emp()
	{
		return $this->belongsTo(TiposEmp::class, 'fk_tipo_emp');
	}

	public function asistencias()
	{
		return $this->hasMany(Asistencia::class, 'fk_empleado');
	}

	public function evaluaciones()
	{
		return $this->belongsToMany(Evaluacione::class, 'empleados_x_evaluaciones', 'fk_empleado', 'fk_evaluacion')
					->withPivot('id_empEval');
	}

	public function eventualidades()
	{
		return $this->belongsToMany(Eventualidade::class, 'empleados_x_eventualidades', 'fk_empleado', 'fk_eventualidad')
					->withPivot('id_empleadoEvent');
	}

	public function horarios()
	{
		return $this->belongsToMany(Horario::class, 'horarios_x_empleados', 'fk_empleado', 'fk_horario')
					->withPivot('id_horarioEmp');
	}

	public function procesos()
	{
		return $this->belongsToMany(Proceso::class, 'procesos_x_empleados', 'fk_empleado', 'fk_proceso')
					->withPivot('id_procesoEmp');
	}
}
