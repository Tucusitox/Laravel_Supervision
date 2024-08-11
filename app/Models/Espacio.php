<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Espacio
 * 
 * @property int $id_espacio
 * @property string $nombre_espacio
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Cargo[] $cargos
 * @property Collection|ElementosInfraestructura[] $elementos_infraestructuras
 * @property Collection|Evaluacione[] $evaluaciones
 * @property Collection|Eventualidade[] $eventualidades
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class Espacio extends Model
{
	protected $table = 'espacios';
	protected $primaryKey = 'id_espacio';

	protected $fillable = [
		'nombre_espacio'
	];

	public function cargos()
	{
		return $this->hasMany(Cargo::class, 'fk_espacio');
	}

	public function elementos_infraestructuras()
	{
		return $this->hasMany(ElementosInfraestructura::class, 'fk_espacio');
	}

	public function evaluaciones()
	{
		return $this->belongsToMany(Evaluacione::class, 'espacios_x_evaluaciones', 'fk_espacio', 'fk_evaluacion')
					->withPivot('id_espaEval')
					->withTimestamps();
	}

	public function eventualidades()
	{
		return $this->belongsToMany(Eventualidade::class, 'espacios_x_eventualidades', 'fk_espacio', 'fk_eventualidad')
					->withPivot('id_espaEvent')
					->withTimestamps();
	}

	public function procesos()
	{
		return $this->belongsToMany(Proceso::class, 'espacios_x_procesos', 'fk_espacio', 'fk_proceso')
					->withPivot('id_espaProces')
					->withTimestamps();
	}
}
