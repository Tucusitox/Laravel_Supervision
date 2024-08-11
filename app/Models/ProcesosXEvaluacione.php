<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcesosXEvaluacione
 * 
 * @property int $id_procesEval
 * @property int $fk_proceso
 * @property int $fk_evaluacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Evaluacione $evaluacione
 * @property Proceso $proceso
 *
 * @package App\Models
 */
class ProcesosXEvaluacione extends Model
{
	protected $table = 'procesos_x_evaluaciones';
	protected $primaryKey = 'id_procesEval';

	protected $casts = [
		'fk_proceso' => 'int',
		'fk_evaluacion' => 'int'
	];

	protected $fillable = [
		'fk_proceso',
		'fk_evaluacion'
	];

	public function evaluacione()
	{
		return $this->belongsTo(Evaluacione::class, 'fk_evaluacion');
	}

	public function proceso()
	{
		return $this->belongsTo(Proceso::class, 'fk_proceso');
	}
}
