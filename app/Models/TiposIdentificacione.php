<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposIdentificacione
 * 
 * @property int $id_tipoIde
 * @property string $tipo_identificacion
 * 
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class TiposIdentificacione extends Model
{
	protected $table = 'tipos_identificaciones';
	protected $primaryKey = 'id_tipoIde';
	public $timestamps = false;

	protected $fillable = [
		'tipo_identificacion'
	];

	public function personas()
	{
		return $this->hasMany(Persona::class, 'fk_tipoIde');
	}
}
