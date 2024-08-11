<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HorariosXEmpleado
 * 
 * @property int $id_horarioEmp
 * @property int $fk_horario
 * @property int $fk_empleado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Empleado $empleado
 * @property Horario $horario
 *
 * @package App\Models
 */
class HorariosXEmpleado extends Model
{
	protected $table = 'horarios_x_empleados';
	protected $primaryKey = 'id_horarioEmp';

	protected $casts = [
		'fk_horario' => 'int',
		'fk_empleado' => 'int'
	];

	protected $fillable = [
		'fk_horario',
		'fk_empleado'
	];

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'fk_empleado');
	}

	public function horario()
	{
		return $this->belongsTo(Horario::class, 'fk_horario');
	}
}
