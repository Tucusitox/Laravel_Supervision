<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemsEspacio
 * 
 * @property int $id_itemEspa
 * @property string $item_espacio
 * 
 * @property Collection|EvaluacionesXItemsespacio[] $evaluaciones_x_itemsespacios
 *
 * @package App\Models
 */
class ItemsEspacio extends Model
{
	protected $table = 'items_espacios';
	protected $primaryKey = 'id_itemEspa';
	public $timestamps = false;

	protected $fillable = [
		'item_espacio'
	];

	public function evaluaciones_x_itemsespacios()
	{
		return $this->hasMany(EvaluacionesXItemsespacio::class, 'fk_itemEspa');
	}
}
