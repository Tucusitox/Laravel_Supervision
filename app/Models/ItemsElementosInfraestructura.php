<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemsElementosInfraestructura
 * 
 * @property int $id_itemElement
 * @property string $item_Elemento
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|EvaluacionesXItemselementosinfra[] $evaluaciones_x_itemselementosinfras
 *
 * @package App\Models
 */
class ItemsElementosInfraestructura extends Model
{
	protected $table = 'items_elementos_infraestructuras';
	protected $primaryKey = 'id_itemElement';

	protected $fillable = [
		'item_Elemento'
	];

	public function evaluaciones_x_itemselementosinfras()
	{
		return $this->hasMany(EvaluacionesXItemselementosinfra::class, 'fk_itemElement');
	}
}
