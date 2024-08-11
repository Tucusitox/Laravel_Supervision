<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 * 
 * @property int $id_persona
 * @property int $fk_genero
 * @property int $fk_tipoIde
 * @property int $identificacion
 * @property string $foto
 * @property string $nombre
 * @property string $apellido
 * @property Carbon $fecha_nacimiento
 * @property string $direccion
 * @property string $tlf_celular
 * @property string $tlf_local
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Genero $genero
 * @property TiposIdentificacione $tipos_identificacione
 * @property Collection|Empleado[] $empleados
 *
 * @package App\Models
 */
class Persona extends Model
{
	protected $table = 'personas';
	protected $primaryKey = 'id_persona';

	protected $casts = [
		'fk_genero' => 'int',
		'fk_tipoIde' => 'int',
		'identificacion' => 'int',
		'fecha_nacimiento' => 'datetime'
	];

	protected $fillable = [
		'fk_genero',
		'fk_tipoIde',
		'identificacion',
		'foto',
		'nombre',
		'apellido',
		'fecha_nacimiento',
		'direccion',
		'tlf_celular',
		'tlf_local'
	];

	public function genero()
	{
		return $this->belongsTo(Genero::class, 'fk_genero');
	}

	public function tipos_identificacione()
	{
		return $this->belongsTo(TiposIdentificacione::class, 'fk_tipoIde');
	}

	public function empleados()
	{
		return $this->hasMany(Empleado::class, 'fk_persona');
	}
}
