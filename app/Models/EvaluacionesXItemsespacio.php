<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EvaluacionesXItemsespacio
 * 
 * @property int $id_eval_itemEspa
 * @property int $fk_evaluacion
 * @property int $fk_itemEspa
 * @property int $nota_itemEspacio
 * 
 * @property Evaluacione $evaluacione
 * @property ItemsEspacio $items_espacio
 *
 * @package App\Models
 */
class EvaluacionesXItemsespacio extends Model
{
	protected $table = 'evaluaciones_x_itemsespacios';
	protected $primaryKey = 'id_eval_itemEspa';
	public $timestamps = false;

	protected $casts = [
		'fk_evaluacion' => 'int',
		'fk_itemEspa' => 'int',
		'nota_itemEspacio' => 'int'
	];

	protected $fillable = [
		'fk_evaluacion',
		'fk_itemEspa',
		'nota_itemEspacio'
	];

	public function evaluacione()
	{
		return $this->belongsTo(Evaluacione::class, 'fk_evaluacion');
	}

	public function items_espacio()
	{
		return $this->belongsTo(ItemsEspacio::class, 'fk_itemEspa');
	}
}
