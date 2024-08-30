<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemsEmp
 * 
 * @property int $id_itemEmp
 * @property string $item_empleado
 * 
 * @property Collection|EvaluacionesXItemsemp[] $evaluaciones_x_itemsemps
 *
 * @package App\Models
 */
class ItemsEmp extends Model
{
	protected $table = 'items_emps';
	protected $primaryKey = 'id_itemEmp';
	public $timestamps = false;

	protected $fillable = [
		'item_empleado'
	];

	public function evaluaciones_x_itemsemps()
	{
		return $this->hasMany(EvaluacionesXItemsemp::class, 'fk_itemEmp');
	}
}
