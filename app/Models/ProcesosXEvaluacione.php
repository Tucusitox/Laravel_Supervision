<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcesosXEvaluacione
 * 
 * @property int $id_procesEval
 * @property int $fk_proceso
 * @property int $fk_evaluacion
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
	public $timestamps = false;

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
