<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemsEmp
 * 
 * @property int $id_itemEmp
 * @property string $item_Empleado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|EvaluacionesXItemsemp[] $evaluaciones_x_itemsemps
 *
 * @package App\Models
 */
class ItemsEmp extends Model
{
	protected $table = 'items_emps';
	protected $primaryKey = 'id_itemEmp';

	protected $fillable = [
		'item_Empleado'
	];

	public function evaluaciones_x_itemsemps()
	{
		return $this->hasMany(EvaluacionesXItemsemp::class, 'fk_itemEmp');
	}
}
