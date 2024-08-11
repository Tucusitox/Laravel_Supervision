<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadosXEventualidade
 * 
 * @property int $id_empleadoEvent
 * @property int $fk_empleado
 * @property int $fk_eventualidad
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Empleado $empleado
 * @property Eventualidade $eventualidade
 *
 * @package App\Models
 */
class EmpleadosXEventualidade extends Model
{
	protected $table = 'empleados_x_eventualidades';
	protected $primaryKey = 'id_empleadoEvent';
	public $incrementing = false;

	protected $casts = [
		'id_empleadoEvent' => 'int',
		'fk_empleado' => 'int',
		'fk_eventualidad' => 'int'
	];

	protected $fillable = [
		'fk_empleado',
		'fk_eventualidad'
	];

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'fk_empleado');
	}

	public function eventualidade()
	{
		return $this->belongsTo(Eventualidade::class, 'fk_eventualidad');
	}
}
