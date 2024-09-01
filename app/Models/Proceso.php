<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proceso
 * 
 * @property int $id_proceso
 * @property int $fk_tipoProces
 * @property string $codigo_proces
 * @property string $asunto_proceso
 * @property string $descripcion_proces
 * @property Carbon $tiempo_duracion
 * @property Carbon $fecha_proceso
 * 
 * @property TiposProceso $tipos_proceso
 * @property Collection|Espacio[] $espacios
 * @property Collection|Empleado[] $empleados
 * @property Collection|Evaluacione[] $evaluaciones
 * @property Collection|Eventualidade[] $eventualidades
 * @property Collection|Horario[] $horarios
 *
 * @package App\Models
 */
class Proceso extends Model
{
	protected $table = 'procesos';
	protected $primaryKey = 'id_proceso';
	public $timestamps = false;

	protected $casts = [
		'fk_tipoProces' => 'int',
		'tiempo_duracion' => 'datetime',
		'fecha_proceso' => 'datetime'
	];

	protected $fillable = [
		'fk_tipoProces',
		'codigo_proces',
		'asunto_proceso',
		'descripcion_proces',
		'tiempo_duracion',
		'fecha_proceso'
	];

	public function tipos_proceso()
	{
		return $this->belongsTo(TiposProceso::class, 'fk_tipoProces');
	}

	public function espacios()
	{
		return $this->belongsToMany(Espacio::class, 'espacios_x_procesos', 'fk_proceso', 'fk_espacio')
					->withPivot('id_espaProces');
	}

	public function empleados()
	{
		return $this->belongsToMany(Empleado::class, 'procesos_x_empleados', 'fk_proceso', 'fk_empleado')
					->withPivot('id_procesoEmp');
	}

	public function evaluaciones()
	{
		return $this->belongsToMany(Evaluacione::class, 'procesos_x_evaluaciones', 'fk_proceso', 'fk_evaluacion')
					->withPivot('id_procesEval');
	}

	public function eventualidades()
	{
		return $this->belongsToMany(Eventualidade::class, 'procesos_x_eventualidades', 'fk_proceso', 'fk_eventualidad')
					->withPivot('id_procesEvent');
	}

	public function horarios()
	{
		return $this->belongsToMany(Horario::class, 'procesos_x_horarios', 'fk_proceso', 'fk_horario')
					->withPivot('id_procesoHorario');
	}
}
