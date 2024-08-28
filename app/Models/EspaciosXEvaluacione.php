<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EspaciosXEvaluacione
 * 
 * @property int $id_espaEval
 * @property int $fk_espacio
 * @property int $fk_evaluacion
 * 
 * @property Espacio $espacio
 * @property Evaluacione $evaluacione
 *
 * @package App\Models
 */
class EspaciosXEvaluacione extends Model
{
	protected $table = 'espacios_x_evaluaciones';
	protected $primaryKey = 'id_espaEval';
	public $timestamps = false;

	protected $casts = [
		'fk_espacio' => 'int',
		'fk_evaluacion' => 'int'
	];

	protected $fillable = [
		'fk_espacio',
		'fk_evaluacion'
	];

	public function espacio()
	{
		return $this->belongsTo(Espacio::class, 'fk_espacio');
	}

	public function evaluacione()
	{
		return $this->belongsTo(Evaluacione::class, 'fk_evaluacion');
	}
}
