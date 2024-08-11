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
 * @property int $calificacion_total
 * @property Carbon $fecha_eval
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ElementosXEvaluacione[] $elementos_x_evaluaciones
 * @property Collection|Empleado[] $empleados
 * @property Collection|Espacio[] $espacios
 * @property Collection|EvaluacionesXItemselementosinfra[] $evaluaciones_x_itemselementosinfras
 * @property Collection|EvaluacionesXItemsemp[] $evaluaciones_x_itemsemps
 * @property Collection|EvaluacionesXItemsespacio[] $evaluaciones_x_itemsespacios
 * @property Collection|EvaluacionesXItemsproceso[] $evaluaciones_x_itemsprocesos
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class Evaluacione extends Model
{
	protected $table = 'evaluaciones';
	protected $primaryKey = 'id_evaluacion';

	protected $casts = [
		'calificacion_total' => 'int',
		'fecha_eval' => 'datetime'
	];

	protected $fillable = [
		'codigo_eval',
		'calificacion_total',
		'fecha_eval'
	];

	public function elementos_x_evaluaciones()
	{
		return $this->hasMany(ElementosXEvaluacione::class, 'fk_evaluacion');
	}

	public function empleados()
	{
		return $this->belongsToMany(Empleado::class, 'empleados_x_evaluaciones', 'fk_evaluacion', 'fk_empleado')
					->withPivot('id_empEval')
					->withTimestamps();
	}

	public function espacios()
	{
		return $this->belongsToMany(Espacio::class, 'espacios_x_evaluaciones', 'fk_evaluacion', 'fk_espacio')
					->withPivot('id_espaEval')
					->withTimestamps();
	}

	public function evaluaciones_x_itemselementosinfras()
	{
		return $this->hasMany(EvaluacionesXItemselementosinfra::class, 'fk_evaluacion');
	}

	public function evaluaciones_x_itemsemps()
	{
		return $this->hasMany(EvaluacionesXItemsemp::class, 'fk_evaluacion');
	}

	public function evaluaciones_x_itemsespacios()
	{
		return $this->hasMany(EvaluacionesXItemsespacio::class, 'fk_evaluacion');
	}

	public function evaluaciones_x_itemsprocesos()
	{
		return $this->hasMany(EvaluacionesXItemsproceso::class, 'fk_evaluacion');
	}

	public function procesos()
	{
		return $this->belongsToMany(Proceso::class, 'procesos_x_evaluaciones', 'fk_evaluacion', 'fk_proceso')
					->withPivot('id_procesEval')
					->withTimestamps();
	}
}
