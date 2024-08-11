<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Horario
 * 
 * @property int $id_horario
 * @property string $nombre_horario
 * @property string $descripcion_horario
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Empleado[] $empleados
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class Horario extends Model
{
	protected $table = 'horarios';
	protected $primaryKey = 'id_horario';

	protected $fillable = [
		'nombre_horario',
		'descripcion_horario'
	];

	public function empleados()
	{
		return $this->belongsToMany(Empleado::class, 'horarios_x_empleados', 'fk_horario', 'fk_empleado')
					->withPivot('id_horarioEmp')
					->withTimestamps();
	}

	public function procesos()
	{
		return $this->belongsToMany(Proceso::class, 'procesos_x_horarios', 'fk_horario', 'fk_proceso')
					->withPivot('id_procesoHorario')
					->withTimestamps();
	}
}
