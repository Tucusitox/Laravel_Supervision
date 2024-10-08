<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemsProceso
 * 
 * @property int $id_itemProceso
 * @property string $item_Proceso
 * 
 * @property Collection|EvaluacionesXItemsproceso[] $evaluaciones_x_itemsprocesos
 *
 * @package App\Models
 */
class ItemsProceso extends Model
{
	protected $table = 'items_procesos';
	protected $primaryKey = 'id_itemProceso';
	public $timestamps = false;

	protected $fillable = [
		'item_Proceso'
	];

	public function evaluaciones_x_itemsprocesos()
	{
		return $this->hasMany(EvaluacionesXItemsproceso::class, 'fk_itemProceso');
	}
}
