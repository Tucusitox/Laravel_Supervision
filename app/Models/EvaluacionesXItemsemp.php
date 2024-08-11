<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EvaluacionesXItemsemp
 * 
 * @property int $id_eval_itemEmp
 * @property int $fk_evaluacion
 * @property int $fk_itemEmp
 * @property int $nota_itemEmpleado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Evaluacione $evaluacione
 * @property ItemsEmp $items_emp
 *
 * @package App\Models
 */
class EvaluacionesXItemsemp extends Model
{
	protected $table = 'evaluaciones_x_itemsemps';
	protected $primaryKey = 'id_eval_itemEmp';

	protected $casts = [
		'fk_evaluacion' => 'int',
		'fk_itemEmp' => 'int',
		'nota_itemEmpleado' => 'int'
	];

	protected $fillable = [
		'fk_evaluacion',
		'fk_itemEmp',
		'nota_itemEmpleado'
	];

	public function evaluacione()
	{
		return $this->belongsTo(Evaluacione::class, 'fk_evaluacion');
	}

	public function items_emp()
	{
		return $this->belongsTo(ItemsEmp::class, 'fk_itemEmp');
	}
}
