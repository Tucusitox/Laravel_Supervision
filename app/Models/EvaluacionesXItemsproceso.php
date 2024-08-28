<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EvaluacionesXItemsproceso
 * 
 * @property int $eval_itemProceso
 * @property int $fk_evaluacion
 * @property int $fk_itemProceso
 * @property int $nota_itemProceso
 * 
 * @property Evaluacione $evaluacione
 * @property ItemsProceso $items_proceso
 *
 * @package App\Models
 */
class EvaluacionesXItemsproceso extends Model
{
	protected $table = 'evaluaciones_x_itemsprocesos';
	protected $primaryKey = 'eval_itemProceso';
	public $timestamps = false;

	protected $casts = [
		'fk_evaluacion' => 'int',
		'fk_itemProceso' => 'int',
		'nota_itemProceso' => 'int'
	];

	protected $fillable = [
		'fk_evaluacion',
		'fk_itemProceso',
		'nota_itemProceso'
	];

	public function evaluacione()
	{
		return $this->belongsTo(Evaluacione::class, 'fk_evaluacion');
	}

	public function items_proceso()
	{
		return $this->belongsTo(ItemsProceso::class, 'fk_itemProceso');
	}
}
