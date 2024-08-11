<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Asistencia
 * 
 * @property int $id_asistencia
 * @property int $fk_empleado
 * @property Carbon $fecha_asistencia
 * @property Carbon $hora_llegada
 * @property Carbon|null $hora_salida
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Empleado $empleado
 *
 * @package App\Models
 */
class Asistencia extends Model
{
	protected $table = 'asistencias';
	protected $primaryKey = 'id_asistencia';

	protected $casts = [
		'fk_empleado' => 'int',
		'fecha_asistencia' => 'datetime',
		'hora_llegada' => 'datetime',
		'hora_salida' => 'datetime'
	];

	protected $fillable = [
		'fk_empleado',
		'fecha_asistencia',
		'hora_llegada',
		'hora_salida'
	];

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'fk_empleado');
	}
}
