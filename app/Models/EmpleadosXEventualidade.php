<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadosXEventualidade
 * 
 * @property int $id_empleadoEvent
 * @property int $fk_empleado
 * @property int $fk_eventualidad
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
	public $timestamps = false;

	protected $casts = [
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
