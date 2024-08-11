<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposIdentificacione
 * 
 * @property int $id_tipoIde
 * @property string $tipo_identificacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class TiposIdentificacione extends Model
{
	protected $table = 'tipos_identificaciones';
	protected $primaryKey = 'id_tipoIde';

	protected $fillable = [
		'tipo_identificacion'
	];

	public function personas()
	{
		return $this->hasMany(Persona::class, 'fk_tipoIde');
	}
}
