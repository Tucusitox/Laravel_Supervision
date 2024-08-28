<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ElementosXEvaluacione
 * 
 * @property int $id_evalElement
 * @property int $fk_elementInfra
 * @property int $fk_evaluacion
 * 
 * @property ElementosInfraestructura $elementos_infraestructura
 * @property Evaluacione $evaluacione
 *
 * @package App\Models
 */
class ElementosXEvaluacione extends Model
{
	protected $table = 'elementos_x_evaluaciones';
	protected $primaryKey = 'id_evalElement';
	public $timestamps = false;

	protected $casts = [
		'fk_elementInfra' => 'int',
		'fk_evaluacion' => 'int'
	];

	protected $fillable = [
		'fk_elementInfra',
		'fk_evaluacion'
	];

	public function elementos_infraestructura()
	{
		return $this->belongsTo(ElementosInfraestructura::class, 'fk_elementInfra');
	}

	public function evaluacione()
	{
		return $this->belongsTo(Evaluacione::class, 'fk_evaluacion');
	}
}
