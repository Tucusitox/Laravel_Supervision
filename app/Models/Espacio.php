<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Espacio
 * 
 * @property int $id_espacio
 * @property string $nombre_espacio
 * 
 * @property Collection|Cargo[] $cargos
 * @property Collection|ElementosInfraestructura[] $elementos_infraestructuras
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class Espacio extends Model
{
	protected $table = 'espacios';
	protected $primaryKey = 'id_espacio';
	public $timestamps = false;

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

	public function procesos()
	{
		return $this->belongsToMany(Proceso::class, 'espacios_x_procesos', 'fk_espacio', 'fk_proceso')
					->withPivot('id_espaProces');
	}
}
