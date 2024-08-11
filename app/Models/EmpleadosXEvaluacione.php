<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadosXEvaluacione
 * 
 * @property int $id_empEval
 * @property int $fk_empleado
 * @property int $fk_evaluacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Empleado $empleado
 * @property Evaluacione $evaluacione
 *
 * @package App\Models
 */
class EmpleadosXEvaluacione extends Model
{
	protected $table = 'empleados_x_evaluaciones';
	protected $primaryKey = 'id_empEval';

	protected $casts = [
		'fk_empleado' => 'int',
		'fk_evaluacion' => 'int'
	];

	protected $fillable = [
		'fk_empleado',
		'fk_evaluacion'
	];

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'fk_empleado');
	}

	public function evaluacione()
	{
		return $this->belongsTo(Evaluacione::class, 'fk_evaluacion');
	}
}
