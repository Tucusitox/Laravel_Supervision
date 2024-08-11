<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EvaluacionesXItemselementosinfra
 * 
 * @property int $eval_itemElement
 * @property int $fk_evaluacion
 * @property int $fk_itemElement
 * @property int $nota_itemElemento
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Evaluacione $evaluacione
 * @property ItemsElementosInfraestructura $items_elementos_infraestructura
 *
 * @package App\Models
 */
class EvaluacionesXItemselementosinfra extends Model
{
	protected $table = 'evaluaciones_x_itemselementosinfra';
	protected $primaryKey = 'eval_itemElement';

	protected $casts = [
		'fk_evaluacion' => 'int',
		'fk_itemElement' => 'int',
		'nota_itemElemento' => 'int'
	];

	protected $fillable = [
		'fk_evaluacion',
		'fk_itemElement',
		'nota_itemElemento'
	];

	public function evaluacione()
	{
		return $this->belongsTo(Evaluacione::class, 'fk_evaluacion');
	}

	public function items_elementos_infraestructura()
	{
		return $this->belongsTo(ItemsElementosInfraestructura::class, 'fk_itemElement');
	}
}
