<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cargo
 * 
 * @property int $id_cargo
 * @property int $fk_espacio
 * @property string $nombre_car
 * 
 * @property Espacio $espacio
 * @property Collection|Empleado[] $empleados
 *
 * @package App\Models
 */
class Cargo extends Model
{
	protected $table = 'cargos';
	protected $primaryKey = 'id_cargo';
	public $timestamps = false;

	protected $casts = [
		'fk_espacio' => 'int'
	];

	protected $fillable = [
		'fk_espacio',
		'nombre_car'
	];

	public function espacio()
	{
		return $this->belongsTo(Espacio::class, 'fk_espacio');
	}

	public function empleados()
	{
		return $this->hasMany(Empleado::class, 'fk_cargo');
	}
}
