<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evaluacione
 * 
 * @property int $id_evaluacion
 * @property string $codigo_eval
 * @property float $calificacion_eval
 * @property Carbon $fecha_evaluacion
 * 
 * @property Collection|ElementosXEvaluacione[] $elementos_x_evaluaciones
 * @property Collection|Empleado[] $empleados
 * @property Collection|EvaluacionesXItemselementosinfra[] $evaluaciones_x_itemselementosinfras
 * @property Collection|EvaluacionesXItemsemp[] $evaluaciones_x_itemsemps
 * @property Collection|EvaluacionesXItemsproceso[] $evaluaciones_x_itemsprocesos
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class Evaluacione extends Model
{
	protected $table = 'evaluaciones';
	protected $primaryKey = 'id_evaluacion';
	public $timestamps = false;

	protected $casts = [
		'calificacion_eval' => 'float',
		'fecha_evaluacion' => 'datetime'
	];

	protected $fillable = [
		'codigo_eval',
		'calificacion_eval',
		'fecha_evaluacion'
	];

	public function elementos_x_evaluaciones()
	{
		return $this->hasMany(ElementosXEvaluacione::class, 'fk_evaluacion');
	}

	public function empleados()
	{
		return $this->belongsToMany(Empleado::class, 'empleados_x_evaluaciones', 'fk_evaluacion', 'fk_empleado')
					->withPivot('id_empEval');
	}

	public function evaluaciones_x_itemselementosinfras()
	{
		return $this->hasMany(EvaluacionesXItemselementosinfra::class, 'fk_evaluacion');
	}

	public function evaluaciones_x_itemsemps()
	{
		return $this->hasMany(EvaluacionesXItemsemp::class, 'fk_evaluacion');
	}

	public function evaluaciones_x_itemsprocesos()
	{
		return $this->hasMany(EvaluacionesXItemsproceso::class, 'fk_evaluacion');
	}

	public function procesos()
	{
		return $this->belongsToMany(Proceso::class, 'procesos_x_evaluaciones', 'fk_evaluacion', 'fk_proceso')
					->withPivot('id_procesEval');
	}
}
